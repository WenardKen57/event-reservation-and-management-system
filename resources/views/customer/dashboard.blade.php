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
</x-app-layout>
