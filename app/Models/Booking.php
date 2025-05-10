<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'number_of_tickets',
        'total_price',
        'booking_reference',
    ];
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
