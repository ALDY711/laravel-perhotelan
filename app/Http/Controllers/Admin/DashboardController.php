<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Reservation;
use App\Models\Guest;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'occupied_rooms' => Room::where('status', 'occupied')->count(),
            'total_room_types' => RoomType::count(),
            'total_guests' => Guest::count(),
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'today_checkins' => Reservation::whereDate('check_in', Carbon::today())->count(),
            'today_checkouts' => Reservation::whereDate('check_out', Carbon::today())->count(),
            'monthly_revenue' => Payment::where('payment_status', 'paid')
                ->whereMonth('payment_date', Carbon::now()->month)
                ->sum('amount'),
        ];

        $recent_reservations = Reservation::with(['guest', 'room.roomType'])
            ->latest()
            ->take(5)
            ->get();

        $upcoming_checkins = Reservation::with(['guest', 'room'])
            ->where('status', 'confirmed')
            ->whereDate('check_in', '>=', Carbon::today())
            ->orderBy('check_in')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations', 'upcoming_checkins'));
    }
}
