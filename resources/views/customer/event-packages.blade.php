<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Packages</title>
    <link rel="stylesheet" href="{{ asset('css/event-packages.css') }}"> <!-- Adjust your CSS path -->
</head>
<body>

    <header>
        <h1>Our Event Packages</h1>
    </header>

    <main>
        <div class="container">
            @foreach ($packages as $package)
                <div class="package-card">
                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}">
                    <h2>{{ $package->package_name }}</h2>
                    <p>Price: ${{ number_format($package->total_price, 2) }}</p>
                    <a href="{{ route('customer.package.details', $package->id) }}">View Details</a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('customer.dashboard') }}">Go back to dashboard</a>
    </main>
</body>
</html>
