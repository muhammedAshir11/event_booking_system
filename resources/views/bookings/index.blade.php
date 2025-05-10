<x-app-layout>
    <div class="container mx-auto p-6">
        @if ($bookings->count())
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto text-sm text-left text-gray-500">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 border-b">Booking Reference</th>
                            <th class="px-4 py-3 border-b">Event Name</th>
                            <th class="px-4 py-3 border-b">Venue</th>
                            <th class="px-4 py-3 border-b">Event Date</th>
                            <th class="px-4 py-3 border-b">Tickets Booked</th>
                            <th class="px-4 py-3 border-b">Total Paid</th>
                            <th class="px-4 py-3 border-b">Booking Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($bookings as $booking)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $booking->booking_reference }}</td>
                                <td class="px-4 py-2">{{ $booking->event->name }}</td>
                                <td class="px-4 py-2">{{ $booking->event->venue }}</td>
                                <td class="px-4 py-2">{{ date('Y-m-d H:i', strtotime($booking->event->event_date)) }}
                                </td>
                                <td class="px-4 py-2">{{ $booking->number_of_tickets }}</td>
                                <td class="px-4 py-2">${{ number_format($booking->total_price, 2) }}</td>
                                <td class="px-4 py-2">{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="p-4 flex justify-between items-center">
                    {{ $bookings->links() }}
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-500">You don't have any bookings yet.</p>
            </div>
        @endif
    </div>
</x-app-layout>
