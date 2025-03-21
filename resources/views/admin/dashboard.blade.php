<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

    <div class="admin-dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="logo">Admin Panel</h2>
            <ul class="nav-links">
                <li><a href="#">Dashboard</a></li>
                <li><a href="{{ route('admin.create-event-package') }}">Create Event Package</a></li>
                <li><a href="{{ route('admin.available-dates.index') }}">Set available dates</a></li>
                <li><a href="#reservation-list">Pending reservations</a></li>
                <li><a href="#approved-reservation-list">Approved reservations</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <header class="dashboard-header">
                <h1>Welcome, Admin</h1>
            </header>

            <section class="dashboard-actions">
                <a href="{{ route('admin.create-event-package') }}" class="btn-primary">Create Event Package</a>
            </section>

            <!-- Event Packages List -->
            <section class="package-list">
                <h2>All Event Packages</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Description</th>
                            <th>Total Price</th>
                            <th>Event Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->package_name }}</td>
                            <td>{{ $package->description }}</td>
                            <td>${{ number_format($package->total_price, 2) }}</td>
                            <td>{{ ucfirst($package->event_type) }}</td>
                            <td>
                                <a href="{{ route('admin.edit-event-package', $package->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.delete-event-package', $package->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirmDelete()">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            
            <section id="reservation-list" class="reservation-list">
            <h2>Pending Reservations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
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
                    @foreach ($reservations->where('status', 'pending') as $reservation)
                    <tr>
                        <td>{{ $reservation->customer->name ?? 'N/A' }}</td>
                        <td>{{ $reservation->event_name }}</td>
                        <td>{{ $reservation->event_date }}</td>
                        <td>{{ $reservation->package->package_name }}</td>
                        <td>{{ $reservation->guest }}</td>
                        <td>${{ number_format($reservation->total_price, 2) }}</td>
                        <td class="status">{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <!-- Approve Button -->
                            <form action="{{ route('admin.approve-reservation', $reservation->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-approve">Approve</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="approved-reservation-list" class="approved-reservation-list">
            <h2>Approved Reservations</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Package</th>
                        <th>Guests</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations->where('status', 'approved') as $reservation)
                    <tr>
                        <td>{{ $reservation->customer->name ?? 'N/A' }}</td>
                        <td>{{ $reservation->event_name }}</td>
                        <td>{{ $reservation->event_date }}</td>
                        <td>{{ $reservation->package->package_name }}</td>
                        <td>{{ $reservation->guest }}</td>
                        <td>${{ number_format($reservation->total_price, 2) }}</td>
                        <td class="status-approved">Approved</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>


        </main>
    </div>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</x-app-layout>

