<div class="container">
    <h2>Upload GCash QR Code</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.gcash.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label class="form-label">Current QR Code:</label><br>
            @if($gcashSetting && $gcashSetting->qr_code)
                <img src="{{ asset('storage/' . $gcashSetting->qr_code) }}" alt="GCash QR Code" width="200">
            @else
                <p>No QR code uploaded</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="qr_code" class="form-label">Upload New QR Code</label>
            <input type="file" name="qr_code" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="{{ route('admin.dashboard') }}">Go back to dashboard</a>
    </form>
</div>