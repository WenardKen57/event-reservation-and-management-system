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

        <div id="event">
            <h1>Event reservation</h1>

            <label for="event_name">Event name:</label>
            <input type="text" name="event_name" required>
            
            <label for="event_name">Event name:</label>
            <input type="text" name="event_name" required>
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

