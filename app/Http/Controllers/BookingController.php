<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookTicketsRequest;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function store(BookTicketsRequest $request)
    {
        try {
            $userId = auth()->id();

            //Booking event ticket
            $booking = $this->bookingService->bookTickets(
                $userId,
                $request->event_id,
                $request->number_of_tickets
            );

            // return success confirmation view
            return view('bookings.confirmation', compact('booking'));
        } catch (\Exception $e) {
            return back()->withErrors(['booking_error' => $e->getMessage()]);
        }
    }
}
