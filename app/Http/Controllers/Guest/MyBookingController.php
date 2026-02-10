<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MyBookingController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room.roomType', 'payment'])
            ->whereHas('guest', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('guest.my-bookings.index', compact('reservations'));
    }

    public function show($bookingCode)
    {
        $reservation = Reservation::with(['guest', 'room.roomType', 'payment'])
            ->where('booking_code', $bookingCode)
            ->whereHas('guest', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        return view('guest.my-bookings.show', compact('reservation'));
    }

    public function cancel($bookingCode)
    {
        $reservation = Reservation::where('booking_code', $bookingCode)
            ->whereHas('guest', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('status', 'pending')
            ->firstOrFail();

        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('my-bookings.index')
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
