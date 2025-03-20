<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Package</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background: #0056b3;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Event Package</h1>

        <form action="{{ route('admin.update-event-package', $package->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="package_name">Package Name:</label>
            <input type="text" name="package_name" value="{{ $package->package_name }}" required>

            <label for="description">Description:</label>
            <input type="text" name="description" value="{{ $package->description }}" required>

            <label for="total_price">Total Price:</label>
            <input type="number" name="total_price" value="{{ $package->total_price }}" required>

            <label for="event_type">Event Type:</label>
            <select name="event_type">
                <option value="wedding" {{ $package->event_type == 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="birthday" {{ $package->event_type == 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="others" {{ $package->event_type == 'others' ? 'selected' : '' }}>Others</option>
            </select>

            <button type="submit">Update Package</button>
        </form>

        <a href="{{ route('admin.dashboard') }}" class="back-link">Back to Dashboard</a>
    </div>

</body>
</html>
