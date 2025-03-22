<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/customer-dashboard.css') }}">

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="logo">Customer Panel</h2>
            <ul class="nav-links">
                <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('customer.reservation.create') }}">Make a Reservation</a></li>
                <li><a href="{{ route('customer.event.packages') }}">View offered services</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <!-- Approved Reservations Section -->
            <h3 class="section-title">Approved Reservations</h3>

            @php
                $approvedReservations = $reservations->where('status', 'approved');
            @endphp

            @if ($approvedReservations->isEmpty())
                <p class="no-reservations">No approved reservations found.</p>
            @else
                <div class="table-container">
                    <table class="reservation-table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Package</th>
                                <th>Guests</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->event_name }}</td>
                                    <td>{{ $reservation->event_date }}</td>
                                    <td>{{ $reservation->event_time }}</td>
                                    <td>{{ $reservation->event_location }}</td>
                                    <td>{{ $reservation->package->package_name }}</td>
                                    <td>{{ $reservation->guest }}</td>
                                    <td class="price">${{ number_format($reservation->total_price, 2) }}</td>
                                    <td class="status approved">Approved</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Pending & Cancelled Reservations Section -->
            <h3 class="section-title">Pending & Cancelled Reservations</h3>

            @php
                $otherReservations = $reservations->whereIn('status', ['pending', 'cancelled']);
            @endphp

            @if ($otherReservations->isEmpty())
                <p class="no-reservations">No pending or cancelled reservations found.</p>
            @else
                <div class="table-container">
                    <table class="reservation-table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Event Package</th>
                                <th>Guests</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Meal package name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otherReservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->event_name }}</td>
                                    <td>{{ $reservation->event_date }}</td>
                                    <td>{{ $reservation->event_time }}</td>
                                    <td>{{ $reservation->event_location }}</td>
                                    <td>
                                        <a href="{{ route('customer.package.details', $reservation->event_package_id) }}">
                                            {{ $reservation->package->package_name }}
                                        </a>
                                    </td>
                                    <td>{{ $reservation->guest }}</td>
                                    <td class="price">${{ number_format($reservation->total_price, 2) }}</td>
                                    <td class="status {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</td>
                                    <td>
                                        @if($reservation->mealPackage)
                                            <a href="{{ route('customer.meal.details', $reservation->meal_package_id) }}">
                                                {{ $reservation->mealPackage->name }}
                                            </a>
                                            
                                        @else
                                            <em>No Meal Package</em>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->status === 'pending')
                                            <form action="{{ route('customer.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-red">
                                                    Cancel
                                                </button>
                                            </form>
                                        @elseif ($reservation->status === 'cancelled')
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
        </main>
    </div>
</x-app-layout>
