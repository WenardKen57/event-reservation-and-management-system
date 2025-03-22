<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mealPackage->name }} - Details</title>
    <link rel="stylesheet" href="{{ asset('css/meal-package-details.css') }}"> <!-- Adjust your CSS path -->
</head>
<body>

    <div class="container">
        <div class="meal-card">
            <h2>{{ $mealPackage->name }}</h2>
            <p class="price">Price: ₱{{ number_format($mealPackage->total_price, 2) }}</p>

            <h3>Inclusions:</h3>
            <ul>
                @foreach ($mealPackage->inclusions as $inclusion)
                    <li>{{ $inclusion->item_name }}</li>
                @endforeach
            </ul>

            <a href="{{ route('customer.event.packages') }}" class="back-button">Back to Packages</a>
            <a href="{{ route('customer.dashboard') }}" class="back-button">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
