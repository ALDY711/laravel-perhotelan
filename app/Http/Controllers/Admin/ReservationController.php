<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['guest', 'room.roomType', 'payment']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhereHas('guest', function($gq) use ($search) {
                      $gq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $reservations = $query->latest()->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['guest', 'room.roomType', 'payment']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::with('roomType')->where('status', 'available')->get();
        return view('admin.reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'room_id' => 'sometimes|exists:rooms,id',
            'special_requests' => 'nullable|string',
        ]);

        // Update room status based on reservation status
        if ($validated['status'] === 'checked_in') {
            $reservation->room->update(['status' => 'occupied']);
        } elseif (in_array($validated['status'], ['checked_out', 'cancelled'])) {
            $reservation->room->update(['status' => 'available']);
        }

        $reservation->update($validated);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Status reservasi berhasil diperbarui!');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->room->update(['status' => 'available']);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil dihapus!');
    }

    public function checkin(Reservation $reservation)
    {
        $reservation->update(['status' => 'checked_in']);
        $reservation->room->update(['status' => 'occupied']);

        return redirect()->back()->with('success', 'Check-in berhasil!');
    }

    public function checkout(Reservation $reservation)
    {
        $reservation->update(['status' => 'checked_out']);
        $reservation->room->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Check-out berhasil!');
    }
}
