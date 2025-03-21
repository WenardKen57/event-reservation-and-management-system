<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/create-event-package.css') }}"> <!-- Link to external CSS -->
    
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
