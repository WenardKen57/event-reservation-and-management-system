<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-blue-600 p-4 shadow-md">
            {{ __('Make an Event Reservation') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('customer.reservation.store') }}" method="POST">
            @csrf

            <label class="block font-semibold mt-4">Select a Package:</label>
            <select name="package_id" class="w-full border-gray-300 p-2 rounded-md" required>
                <option value="">-- Select a Package --</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">
                        {{ $package->package_name }} - ${{ number_format($package->total_price, 2) }}
                    </option>
                @endforeach
            </select>
            
            <label class="block font-semibold mt-4">Event Name:</label>
            <input type="text" name="event_name" class="w-full border-gray-300 p-2 rounded-md" required>

            <label class="block font-semibold mt-4">Event Date:</label>
            <input type="date" name="event_date" class="w-full border-gray-300 p-2 rounded-md" required>

            <label class="block font-semibold mt-4">Event Time:</label>
            <input type="time" name="event_time" class="w-full border-gray-300 p-2 rounded-md" required>

            <label class="block font-semibold mt-4">Event Location:</label>
            <input type="text" name="event_location" class="w-full border-gray-300 p-2 rounded-md" required>

            <label class="block font-semibold mt-4">Number of Guests:</label>
            <input type="number" name="guests" class="w-full border-gray-300 p-2 rounded-md" required>

            <label class="block font-semibold mt-4">Event Type:</label>
            <select name="event_type" class="w-full border-gray-300 p-2 rounded-md">
                <option value="wedding">Wedding</option>
                <option value="birthday">Birthday</option>
                <option value="corporate">Corporate Event</option>
                <option value="others">Others</option>
            </select>

            <label class="block font-semibold mt-4">Special Requests:</label>
            <textarea name="special_requests" class="w-full border-gray-300 p-2 rounded-md"></textarea>

            <button type="submit" 
                class="mt-6 bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                Submit Reservation
            </button>
        </form>
    </div>
</x-app-layout>
