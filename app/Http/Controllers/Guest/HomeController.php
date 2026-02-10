<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_rooms' => Room::where('status', 'available')->count(),
            'room_types' => RoomType::count(),
        ];

        return view('guest.home', compact('stats'));
    }
}

