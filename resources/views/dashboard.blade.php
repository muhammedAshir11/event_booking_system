<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-4">Available Events</h3>

                @foreach($events as $event)
                    <div class="border p-4 rounded mb-4 shadow-sm">
                        <h4 class="text-xl font-semibold">{{ $event->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $event->venue }} — {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                        <p class="mt-2">Price: ₹{{ $event->ticket_price }} | Available Seats: {{ $event->available_seats }}</p>

                        <a href="" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Book Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
