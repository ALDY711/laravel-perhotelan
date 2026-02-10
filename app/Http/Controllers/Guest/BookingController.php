<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Request $request, $roomTypeId)
    {
        $roomType = RoomType::findOrFail($roomTypeId);
        
        $checkIn = $request->check_in ? Carbon::parse($request->check_in) : Carbon::today();
        $checkOut = $request->check_out ? Carbon::parse($request->check_out) : Carbon::tomorrow();
        
        // Get available rooms
        $availableRooms = Room::where('room_type_id', $roomTypeId)
            ->where('status', 'available')
            ->get()
            ->filter(function($room) use ($checkIn, $checkOut) {
                return $room->isAvailable($checkIn, $checkOut);
            });

        if ($availableRooms->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada kamar yang tersedia untuk tanggal tersebut.');
        }

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $roomType->price_per_night * $nights;

        return view('guest.booking.create', compact('roomType', 'availableRooms', 'checkIn', 'checkOut', 'nights', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'total_guests' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'id_card_number' => 'nullable|string|max:50',
            'special_requests' => 'nullable|string',
            'payment_method' => 'required|in:cash,credit_card,debit_card,bank_transfer,e_wallet',
        ]);

        $room = Room::with('roomType')->findOrFail($validated['room_id']);
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);

        // Verify room is still available
        if (!$room->isAvailable($checkIn, $checkOut)) {
            return redirect()->back()->with('error', 'Kamar sudah tidak tersedia. Silakan pilih kamar lain.');
        }

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->roomType->price_per_night * $nights;

        DB::beginTransaction();
        try {
            // Create or update guest
            $guest = Guest::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'user_id' => Auth::id(),
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'id_card_number' => $validated['id_card_number'],
                ]
            );

            // Create reservation
            $reservation = Reservation::create([
                'guest_id' => $guest->id,
                'room_id' => $room->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_guests' => $validated['total_guests'],
                'total_price' => $totalPrice,
                'special_requests' => $validated['special_requests'],
                'status' => 'pending',
            ]);

            // Create payment
            Payment::create([
                'reservation_id' => $reservation->id,
                'amount' => $totalPrice,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('booking.success', $reservation->booking_code)
                ->with('success', 'Reservasi berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function success($bookingCode)
    {
        $reservation = Reservation::with(['guest', 'room.roomType', 'payment'])
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return view('guest.booking.success', compact('reservation'));
    }
}
