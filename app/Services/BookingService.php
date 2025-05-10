<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\BookingRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    protected $bookingRepo;

    public function __construct(BookingRepository $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }

    public function bookTickets($userId, $eventId, $numberOfTickets)
    {
        DB::beginTransaction();

        try {
            // Lock the event row to prevent race conditions
            $event = Event::where('id', $eventId)
                ->where('available_seats', '>=', $numberOfTickets)
                ->lockForUpdate() // This locks the row for the current transaction
                ->first();

            if (!$event) {
                throw ValidationException::withMessages([
                    'number_of_tickets' => 'Not enough available seats or event not found.',
                ]);
            }

            // Deduct available seats
            $event->available_seats -= $numberOfTickets;
            $event->save();

            // Generate a unique booking reference
            $bookingReference = Str::uuid();

            // Calculate total price (assuming a fixed ticket price for simplicity)
            $totalPrice = $event->ticket_price * $numberOfTickets;

            // Create the booking record
            $booking = $this->bookingRepo->create([
                'user_id' => $userId,
                'event_id' => $eventId,
                'number_of_tickets' => $numberOfTickets,
                'total_price' => $totalPrice,
                'booking_reference' => $bookingReference,
            ]);

            DB::commit();

            return $booking;
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'number_of_tickets' => 'Booking failed. Please try again later.',
            ]);
        }
    }

    public function getUserBookings($userId, $perPage = 10)
    {
        return $this->bookingRepo->getBookingsByUser($userId, $perPage);
    }
}
