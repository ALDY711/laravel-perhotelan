<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::with('user');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $guests = $query->latest()->paginate(10);

        return view('admin.guests.index', compact('guests'));
    }

    public function show(Guest $guest)
    {
        $guest->load(['user', 'reservations.room.roomType', 'reservations.payment']);
        return view('admin.guests.show', compact('guest'));
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil dihapus!');
    }
}
