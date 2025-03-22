<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Packages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .package {
            border-left: 5px solid #007bff;
            background: #e9f2ff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 6px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
        .package h3 {
            color: #0056b3;
            margin: 0;
            font-size: 1.2em;
        }
        .price {
            color: #333;
            font-weight: bold;
            font-size: 0.9em;
        }
        .inclusions {
            margin-top: 10px;
            padding-left: 20px;
        }
        .inclusions li {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Meal Packages</h2>

        @foreach($mealPackages as $package)
            <div class="package">
                <h3>{{ $package->name }} <span class="price">(₱{{ number_format($package->total_price, 2) }})</span></h3>
                <ul class="inclusions">
                    @foreach($package->inclusions as $inclusion)
                        <li>{{ $inclusion->item_name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
</body>
</html>
