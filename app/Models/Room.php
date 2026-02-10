<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type_id',
        'floor',
        'status',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($checkIn, $checkOut)
    {
        if ($this->status !== 'available') {
            return false;
        }

        return !$this->reservations()
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                          ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'available' => '<span class="badge bg-success">Available</span>',
            'occupied' => '<span class="badge bg-danger">Occupied</span>',
            'maintenance' => '<span class="badge bg-warning">Maintenance</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}
