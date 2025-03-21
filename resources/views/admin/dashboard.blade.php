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

            

        </main>
    </div>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</x-app-layout>

