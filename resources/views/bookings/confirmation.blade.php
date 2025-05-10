<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-md rounded-lg">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-green-600">Booking Confirmed!</h2>
                    <p class="text-gray-600 mt-2">Thank you for your purchase. Your booking details are below.</p>
                </div>

                <div class="border-t pt-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Event:</h3>
                        <p class="text-gray-700">{{ $booking->event->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Date & Venue:</h3>
                        <p class="text-gray-700">
                            {{ \Carbon\Carbon::parse($booking->event->event_date)->format('F j, Y') }} <br>
                            at {{ $booking->event->venue }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Tickets Booked:</h3>
                        <p class="text-gray-700">{{ $booking->number_of_tickets }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Total Price:</h3>
                        <p class="text-gray-700">₹{{ number_format($booking->total_price, 2) }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Booking Reference:</h3>
                        <p class="text-gray-700 text-sm bg-gray-100 px-3 py-2 rounded">{{ $booking->booking_reference }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                        Browse More Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
