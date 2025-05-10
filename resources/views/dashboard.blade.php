<x-app-layout>
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-4">Available Events</h3>

                @foreach ($events as $event)
                    <div class="border p-4 rounded mb-4 shadow-sm">
                        <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $event->venue }} —
                            {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                        <p class="mt-2">Price: ₹{{ $event->ticket_price }} | Available Tickets:
                            <span class="availableTickets{{ $event->id }}">{{ $event->available_seats }}</span>
                        </p>

                        <a onclick="openBookingModal({{ $event }})"
                            class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Book Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="bookingModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-2xl w-full max-w-md relative">
            <button onclick="closeBookingModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Book Your Ticket</h3>
            <form action="{{ route('ticket.booking') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="event_id" id="eventId">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Event Name:</label>
                    <p id="eventName" class="text-base font-semibold text-gray-800">Loading...</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Available Tickets:</label>
                    <p class="text-base font-semibold text-green-700" id="availableTicketCount">--</p>
                </div>

                <div>
                    <label for="number_of_tickets" class="block text-sm font-medium text-gray-600">Number of
                        Tickets</label>
                    <input type="number" name="number_of_tickets" id="numberOfTickets" min="1" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter ticket count">
                </div>

                <div class="text-right">
                    <button type="submit" id="eventBookingButton"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md">
                        Book Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    const openBookingModal = (event) => {
        $('#eventId').val(event.id);
        $('#numberOfTickets').val('');
        $('#eventName').html(event.name);
        changeAvailableTicketCount(event.id, event.available_seats)
        document.getElementById('bookingModal').classList.remove('hidden');
    }

    const closeBookingModal = () => {
        document.getElementById('bookingModal').classList.add('hidden');
    }

    const changeAvailableTicketCount = (eventId, ticketCount = '--') => {
        $('#numberOfTickets').attr('max', ticketCount);
        $('#availableTicketCount').html(ticketCount);
        $('.availableTickets' + eventId).html(ticketCount);
    }
</script>
