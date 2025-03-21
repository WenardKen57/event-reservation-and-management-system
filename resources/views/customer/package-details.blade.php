<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->package_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/package-details.css') }}">
</head>
<body>

    <header>
        <h1>Event Package Details</h1>
    </header>

    <main class="container">
        <div class="package-details">
            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->package_name }}">

            <div class="details">
                <h2>{{ $package->package_name }}</h2>
                <p class="price">Price: ${{ number_format($package->total_price, 2) }}</p>
                <p class="description">{{ $package->description }}</p>

                <h3>Inclusions:</h3>
                <ul>
                    @foreach($package->inclusions as $inclusion)
                        <li>{{ $inclusion->item_name }} - <strong>{{ $inclusion->quantity }}</strong></li>
                    @endforeach
                </ul>

                <a href="{{ route('customer.event.packages') }}" class="back-button">Back to Packages</a>
            </div>
        </div>
    </main>

</body>
</html>
