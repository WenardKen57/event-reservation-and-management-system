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
        <form id="event-package-form" action="{{ route('admin.store-event-package') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="package_name">Package Name:</label>
            <input type="text" name="package_name" value="{{ old('package_name') }}">
            @error('package_name')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <label for="description">Package Description:</label>
            <input type="text" name="description" value="{{ old('description') }}">
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <label for="total_price">Package Total Price:</label>
            <input type="number" name="total_price" value="{{ old('total_price') }}">
            @error('total_price')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <label for="event_type">Select Event Type:</label>
            <select name="event_type" id="event_type">
                <option value="wedding" {{ old('event_type') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="birthday" {{ old('event_type') == 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="others" {{ old('event_type') == 'others' ? 'selected' : '' }}>Others</option>
            </select>
            @error('event_type')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <div id="inclusions-container">
                <button type="button" id="new-inclusion">Add Inclusion</button>
            </div>

            <label for="package_image">Upload Package Image:</label>
            <input type="file" id="package_image" name="package_image" accept="image/*">
            @error('package_image')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <!-- Image Preview -->
            <img id="image-preview" src="#" alt="Package Image" style="display:none; width: 100%; max-height: 200px; margin-top: 10px;">

            <button type="submit">Submit</button>
        </form>

        <a href="{{ route('admin.dashboard') }}">Go home</a>
    </div>

    <script src="{{ asset('js/create-event-package.js') }}"></script>
</body>
</html>
