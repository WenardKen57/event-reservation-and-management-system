<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #inclusions-container {
            margin-top: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        #new-inclusion {
            background-color: #28a745;
        }

        #new-inclusion:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>


    <div id="container">
        <h1>Create new event package</h1>
        <form id="event-package-form" action="{{ route('admin.store-event-package') }}" method='post' >
            @csrf
            <label for="package_name">Package name:</label>
            <input type="text" name="package_name"><br>

            <label for="description">Package description:</label>
            <input type="text" name="description"><br>

            <label for="total_price">Package total price:</label>
            <input type="number" name="total_price"><br>

            <label for="event_type">Select event type:</label>
            <select name="event_type" id="event_type">
                <option value="wedding">Wedding</option>
                <option value="birthday">Birthday</option>
                <option value="others">Others</option>
            </select>

            <div id="inclusions-container">
                <button type="button" id="new-inclusion">Add inclusion</button>
            </div>

            <button type="submit">Submit</button>
        </form>
        <a href="{{ route('admin.dashboard') }}">Go home</a>
    </div>

    <script src="{{ asset('js/create-event-package.js') }}"></script>
</body>
</html>
