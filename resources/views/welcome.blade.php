<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Caezelle Event Reservation</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar">
            <h1 class="logo">Caezelle Event Reservation</h1>
            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-button">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-button">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="register-button">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <!-- Hero Section -->
        <section class="hero">
            <h2>Plan Your Perfect Event</h2>
            <p>Have an upcoming birthday, wedding, or party? We’re here to help you manage your event smoothly.</p>
            <a href="{{ route('customer.reservation.create') }}" class="reserve-button">Make a Reservation</a>
        </section>

        <!-- Footer -->
        <footer class="footer">
            &copy; {{ date('Y') }} Caezelle Event Reservation. All rights reserved.
        </footer>
    </div>
</body>
</html>
