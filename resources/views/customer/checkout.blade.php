<div class="container">
    <h2>Checkout</h2>
    <p>To confirm your reservation, please pay the deposit by scanning the GCash QR code below.</p>

    <div class="mb-3">
        <h4>GCash QR Code</h4>
        @if($gcashSetting && $gcashSetting->qr_code)
            <img src="{{ asset('storage/' . $gcashSetting->qr_code) }}" alt="GCash QR Code" width="250">
        @else
            <p>No QR code available. Please contact support.</p>
        @endif
    </div>

    <p>After making the payment, please upload your proof of payment.</p>

    <a href="{{ route('customer.upload-proof') }}" class="btn btn-primary">Upload Proof of Payment</a>
</div>