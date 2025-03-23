
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Packages</title>
<link rel="stylesheet" href="{{ asset('css/event-packages.css') }}"> <!-- Adjust your CSS path -->


<nav class="navbar">
    <h1 class="logo">Caezelle Event Reservation</h1>
    @if (Route::has('login'))
        <div class="nav-links">
            @auth
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-button">Dashboard</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="nav-button">Dashboard</a>
                @endif
                
            @else
                <a href="./about" class="nav-button">About</a>
                <a href="{{ route('login') }}" class="nav-button">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="register-button">Register</a>
                @endif
            @endauth
        </div>
    @endif
</nav>
<header>
    <h1>Our Offered Services</h1>
</header>

<main>
    <div class="container">

        <h1>Event Packages</h1>

        @php
            $eventTypes = ['wedding' => 'Wedding', 'birthday' => 'Birthday', 'others' => 'Other Events'];
        @endphp

        @foreach ($eventTypes as $typeKey => $typeName)
            @php
                $filteredPackages = $packages->where('event_type', $typeKey);
            @endphp

            @if ($filteredPackages->isNotEmpty())
                <h2>{{ $typeName }}</h2>
                <div class="package-container">
                    @foreach ($filteredPackages as $package)
                        <div class="package-card">
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}">
                            <h2>{{ $package->package_name }}</h2>
                            <p>Price: ${{ number_format($package->total_price, 2) }}</p>
                            <a href="{{ route('package.details', $package->id) }}">View Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

        <h1>Meal Packages</h1>
        <div class="package-container">
            @foreach ($mealPackages as $mealPackage)
                <div class="package-card">
                    <h3>{{ $mealPackage->name }}</h3>
                    <p>Price: ₱{{ number_format($mealPackage->total_price, 2) }}</p>
                    <a href="{{ route('meal.details', $mealPackage->id) }}">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
</main>
