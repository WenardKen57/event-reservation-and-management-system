<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    

    <h1>Pick a transaction:</h1>
        
    <div id="service-type">
        <button id="event-btn">Make an event reservation</button>
        <button id="rental-btn">Make a rental reservation</button>
        <button id="meal-btn">Make a meal reservation</button>
    </div>

    <form action="" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="event">
            <h1>Event reservation</h1>

            <label for="event_name">Event name:</label>
            <input type="text" name="event_name" value="{{ old('event_name') }}" required>
            @error('event_name') <p style="color:red;">{{ $message }}</p> @enderror
            <br>

            <label for="event_date">Event date:</label>
            <input type="date" name="event_date" value="{{ old('event_date') }}" required>
            @error('event_date') <p style="color:red;">{{ $message }}</p> @enderror
            <br>

            <label for="event_time">Event time:</label>
            <input type="time" name="event_time" value="{{ old('event_time') }}" required>
            @error('event_time') <p style="color:red;">{{ $message }}</p> @enderror
            <br>

            <label for="event_location">Event location:</label>
            <input type="text" name="event_location" value="{{ old('event_location') }}" required>
            @error('event_location') <p style="color:red;">{{ $message }}</p> @enderror
            <br>

            <label for="event_package_id">Select an event package:</label>
            <select name="event_package_id" id="event_package_id">
                <option value="1" {{ old('event_package_id') == 1 ? 'selected' : '' }}>Package A</option>
                <option value="2" {{ old('event_package_id') == 2 ? 'selected' : '' }}>Package B</option>
                <option value="3" {{ old('event_package_id') == 3 ? 'selected' : '' }}>Package C</option>
            </select>
            @error('event_package_id') <p style="color:red;">{{ $message }}</p> @enderror
            <br>

            <button type="submit">Submit</but>
        </div>
        <div id="rental">
            <h1>Rental reservation</h1>
        </div>
        <div id="meal">
            <h1>Meal reservation</h1>
        </div>

    </form>

    <script src="{{ asset('js/transaction.js') }}" defer></script>
</body>
</html>

