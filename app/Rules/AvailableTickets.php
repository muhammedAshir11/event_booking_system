<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Event;

class AvailableTickets implements Rule
{
    protected $eventId;
    protected $message;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    // This method checks if the validation rule passes
    public function passes($attribute, $value)
    {
        $event = Event::find($this->eventId);
        if (!$event) {
            $this->message = 'Invalid event selected.';
            return false;
        }

        if ($value > $event->available_seats) {
            $this->message = "Only {$event->available_seats} tickets available.";
            return false;
        }

        return true;
    }

    // This method returns the validation message
    public function message()
    {
        return $this->message ?? 'The number of tickets exceeds availability.';
    }
}

