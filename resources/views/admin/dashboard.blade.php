<x-app-layout>
    <div class="admin-dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="logo">Admin Panel</h2>
            <ul class="nav-links">
                <li><a href="#">Dashboard</a></li>
                <li><a href="{{ route('admin.create-event-package') }}">Create Event Package</a></li>
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

            <!--
            <section class="dashboard-content">
                <div class="card">
                    <h3>Total Packages</h3>
                    <p>10</p>
                </div>
                <div class="card">
                    <h3>New Orders</h3>
                    <p>5</p>
                </div>
                <div class="card">
                    <h3>Customers</h3>
                    <p>120</p>
                </div>
            </section>

-->
        </main>
    </div>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Layout */
        .admin-dashboard {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #007bff;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .sidebar .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar .nav-links {
            list-style: none;
            width: 100%;
        }

        .sidebar .nav-links li {
            margin-bottom: 15px;
            width: 100%;
        }

        .sidebar .nav-links a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            transition: background 0.3s;
        }

        .sidebar .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 20px;
        }

        .dashboard-header {
            background: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-actions {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Dashboard Content */
        .dashboard-content {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 150px;
        }

        .card h3 {
            font-size: 16px;
            color: #333;
        }

        .card p {
            font-size: 20px;
            font-weight: bold;
            margin-top: 5px;
            color: #007bff;
        }

        @media (max-width: 768px) {
            .admin-dashboard {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                text-align: center;
                padding: 15px;
            }
            .sidebar .nav-links {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }
            .sidebar .nav-links li {
                margin: 5px;
            }
        }
        
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        thead {
            background: #007bff;
            color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        tbody tr:hover {
            background: #e9ecef;
        }
    </style>
</x-app-layout>

