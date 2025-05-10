<?php

namespace App\Services;
use App\Repositories\EventRepository;


class EventService
{
    /**
     * Create a new class instance.
     */
    protected $eventRepository;
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;

    }
    public function getEvents()
    {
        return $this->eventRepository->getAllEvents();
    }
}
