<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Package</title>
</head>
<body>
    <h1>Edit Event Package</h1>

    <form action="{{ route('admin.update-event-package', $package->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="package_name">Package Name:</label>
        <input type="text" name="package_name" value="{{ $package->package_name }}" required><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="{{ $package->description }}" required><br>

        <label for="total_price">Total Price:</label>
        <input type="number" name="total_price" value="{{ $package->total_price }}" required><br>

        <label for="event_type">Event Type:</label>
        <select name="event_type">
            <option value="wedding" {{ $package->event_type == 'wedding' ? 'selected' : '' }}>Wedding</option>
            <option value="birthday" {{ $package->event_type == 'birthday' ? 'selected' : '' }}>Birthday</option>
            <option value="others" {{ $package->event_type == 'others' ? 'selected' : '' }}>Others</option>
        </select><br>

        <button type="submit">Update Package</button>
    </form>

    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>

</body>
</html>
