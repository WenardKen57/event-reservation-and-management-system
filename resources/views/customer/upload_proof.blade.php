<div class="container">
    <h2>Upload Proof of Payment</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customer.store-proof') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="event_reservation_id" class="form-label">Select Reservation</label>
            <select name="event_reservation_id" class="form-control" required>
                <option value="">-- Choose a reservation --</option>
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">Reservation #{{ $reservation->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="proof_image" class="form-label">Upload Proof of Payment</label>
            <input type="file" name="proof_image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>