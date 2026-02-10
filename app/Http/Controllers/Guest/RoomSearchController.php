<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = RoomType::withCount(['rooms' => function($q) {
            $q->where('status', 'available');
        }]);

        // Filter by check-in and check-out dates
        $checkIn = $request->check_in ? Carbon::parse($request->check_in) : Carbon::today();
        $checkOut = $request->check_out ? Carbon::parse($request->check_out) : Carbon::tomorrow();

        // Filter by capacity
        if ($request->has('capacity') && $request->capacity != '') {
            $query->where('capacity', '>=', $request->capacity);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price_per_night', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        $roomTypes = $query->having('rooms_count', '>', 0)->paginate(9);

        return view('guest.rooms.index', compact('roomTypes', 'checkIn', 'checkOut'));
    }

    public function show($id, Request $request)
    {
        $roomType = RoomType::with(['rooms' => function($q) {
            $q->where('status', 'available');
        }])->findOrFail($id);

        $checkIn = $request->check_in ? Carbon::parse($request->check_in) : Carbon::today();
        $checkOut = $request->check_out ? Carbon::parse($request->check_out) : Carbon::tomorrow();

        // Get available rooms for the dates
        $availableRooms = $roomType->rooms->filter(function($room) use ($checkIn, $checkOut) {
            return $room->isAvailable($checkIn, $checkOut);
        });

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $roomType->price_per_night * $nights;

        return view('guest.rooms.show', compact('roomType', 'availableRooms', 'checkIn', 'checkOut', 'nights', 'totalPrice'));
    }
}
