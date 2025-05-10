<?php

namespace App\Repositories;
use App\Models\Event;
use App\Interfaces\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
/**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

        public function getAllEvents()
    {
        return Event::orderBy('event_date', 'asc')->get();
    }

    public function getEventById($eventId)
    {
        return Event::find($eventId);
    }
}

