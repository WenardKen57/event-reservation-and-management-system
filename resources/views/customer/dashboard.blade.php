<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/customer-dashboard.css') }}">

    <div class="dashboard-container">

        <!-- Button Section -->
        <div class="button-container">
            <ul class="button-list">
                <li>
                    <a href="{{ route('customer.reservation.create') }}" class="custom-button">
                        Make an Event Reservation
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.event.packages') }}" class="custom-button">
                        View Event Packages
                    </a>
                </li>
            </ul>
        </div>

        <h3 class="section-title">Your Reservations</h3>

        @if ($reservations->isEmpty())
            <p class="no-reservations">No reservations found.</p>
        @else
            <div class="table-container">
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Location</th>
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
                                <td>{{ $reservation->event_location }}</td>
                                <td>{{ $reservation->package->package_name }}</td>
                                <td>{{ $reservation->guest }}</td>
                                <td class="price">${{ number_format($reservation->total_price, 2) }}</td>
                                <td class="status">{{ ucfirst($reservation->status) }}</td>
                                <td>
                                    @if ($reservation->status !== 'cancelled')
                                        <!-- Cancel Button -->
                                        <form action="{{ route('customer.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-red">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <span class="cancelled">Cancelled</span>

                                        <!-- Delete Button -->
                                        <form action="{{ route('customer.reservation.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                Delete
                                            </button>
                                        </form>
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
