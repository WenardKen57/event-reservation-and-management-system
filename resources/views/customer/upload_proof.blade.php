<link rel="stylesheet" href="{{ asset('css/upload-proof-payment.css') }}">

<div class="container">

    <h1>Note:</h1>
    <p>
        * For any event reservation you make you need to pay for 5000 deposit in order for admin
        to approve it.
    </p>

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

    {{-- GCash QR Code Section --}}
    <div class="qr-code-section">
        <h4>Scan to Pay (GCash)</h4>
        @if($gcashSetting && $gcashSetting->qr_code)
            <img src="{{ asset('storage/' . $gcashSetting->qr_code) }}" alt="GCash QR Code" class="qr-code">
        @else
            <p>No QR code available. Please contact support.</p>
        @endif
    </div>

    <p>After making the payment, please upload your proof of payment below.</p>

    <form action="{{ route('customer.store-proof') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="event_reservation_id" class="form-label">Select Reservation</label>
            <select name="event_reservation_id" class="form-control" required>
                <option value="">-- Choose a reservation --</option>
                @foreach($reservations as $reservation)
                    @php
                        $proofExists = $reservation->paymentProof && $reservation->paymentProof->status !== 'rejected';
                    @endphp
                    <option value="{{ $reservation->id }}" {{ $proofExists ? 'disabled' : '' }}>
                        Reservation #{{ $reservation->event_name }} {{ $proofExists ? '(Proof Already Submitted)' : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="proof_image" class="form-label">Upload Proof of Payment</label>
            <input type="file" name="proof_image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <a href="{{ route('customer.dashboard') }}">Go back to dashboard</a>
</div>

<style>
    .qr-code-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .qr-code {
        width: 550px;
        height: auto;
        border: 2px solid #ddd;
        padding: 10px;
        border-radius: 10px;
        background: #fff;
    }
</style>
