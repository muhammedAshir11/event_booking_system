<?php

namespace App\Repositories;
use App\Models\Booking;

class BookingRepository
{
    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function getBookingsByUser($userId, $perPage = 10)
    {
        return Booking::where('user_id', $userId)
            ->with('event')  // Eager load the related event details (name, venue, etc.)
            ->orderBy('id','desc')
            ->paginate($perPage);
    }
}
