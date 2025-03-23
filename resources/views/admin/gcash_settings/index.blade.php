<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload GCash QR Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        h2 {
            color: #007BFF;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .form-label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #333;
        }
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
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
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .qr-container {
            margin: 15px 0;
        }
        img {
            border: 2px solid #007BFF;
            border-radius: 10px;
            padding: 5px;
            width: 200px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Upload GCash QR Code</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.gcash.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="qr-container">
                <label class="form-label">Current QR Code:</label>
                @if($gcashSetting && $gcashSetting->qr_code)
                    <img src="{{ asset('storage/' . $gcashSetting->qr_code) }}" alt="GCash QR Code">
                @else
                    <p>No QR code uploaded</p>
                @endif
            </div>

            <label for="qr_code" class="form-label">Upload New QR Code</label>
            <input type="file" name="qr_code" accept="image/*">

            <button type="submit">Upload</button>
        </form>

        <a href="{{ route('admin.dashboard') }}">Go back to dashboard</a>
    </div>

</body>
</html>
