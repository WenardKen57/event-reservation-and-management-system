<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-blue-600 p-4 rounded-lg shadow-md">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-8">
        <ul class="bg-white p-6 rounded-lg shadow-md w-96 text-center">
            <li>
                <a href="{{ route('customer.reservation.create') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Make an Event Reservation
                </a>
            </li>
        </ul>
    </div>

    <div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Your Reservations</h3>

        @if ($reservations->isEmpty())
            <p class="text-gray-500">No reservations found.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Event Name</th>
                        <th class="border p-2">Date</th>
                        <th class="border p-2">Package</th>
                        <th class="border p-2">Guests</th>
                        <th class="border p-2">Total Price</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="border p-2">{{ $reservation->event_name }}</td>
                            <td class="border p-2">{{ $reservation->event_date }}</td>
                            <td class="border p-2">{{ $reservation->package->package_name }}</td>
                            <td class="border p-2">{{ $reservation->guest }}</td>
                            <td class="border p-2">${{ number_format($reservation->total_price, 2) }}</td>
                            <td class="border p-2 text-blue-600 font-semibold">{{$reservation->status}}</td>
                            <td class="border p-2">
                                @if ($reservation->status !== 'cancelled')
                                    <form action="{{ route('customer.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
