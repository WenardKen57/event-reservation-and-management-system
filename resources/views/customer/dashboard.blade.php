<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-blue-600 p-4 rounded-lg shadow-md">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .dashboard-container {
            max-width: 60rem;
            margin: 2rem auto;
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .reservation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .reservation-table th, .reservation-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .reservation-table th {
            background-color: #f3f4f6;
            color: #333;
            font-weight: bold;
        }

        .reservation-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-blue {
            background-color: #2563eb;
            color: white;
        }

        .btn-blue:hover {
            background-color: #1e40af;
        }

        .btn-red {
            background-color: #dc2626;
            color: white;
        }

        .btn-red:hover {
            background-color: #b91c1c;
        }
    </style>

    <div class="flex justify-center mt-8">
        <ul class="bg-white p-6 rounded-lg shadow-md w-96 text-center">
            <li>
                <a href="{{ route('customer.reservation.create') }}" class="btn btn-blue">
                    Make an Event Reservation
                </a>
            </li>
        </ul>
    </div>

    <div class="dashboard-container">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Your Reservations</h3>

        @if ($reservations->isEmpty())
            <p class="text-gray-500 text-center">No reservations found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Package</th>
                            <th>Guests</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->event_name }}</td>
                                <td>{{ $reservation->event_date }}</td>
                                <td>{{ $reservation->package->package_name }}</td>
                                <td>{{ $reservation->guest }}</td>
                                <td class="text-green-600 font-semibold">${{ number_format($reservation->total_price, 2) }}</td>
                                <td class="text-blue-600 font-semibold">{{ ucfirst($reservation->status) }}</td>
                                <td>
                                    @if ($reservation->status !== 'cancelled')
                                        <form action="{{ route('customer.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red">
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
            </div>
        @endif
    </div>
</x-app-layout>
