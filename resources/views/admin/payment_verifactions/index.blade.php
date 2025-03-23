<link rel="stylesheet" href="{{ asset('css/admin/payment/payment-proof.css') }}">
<div class="container">
    <h2>Payment Proofs for Verification</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Reservation ID</th>
                <th>Proof</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentProofs as $proof)
                <tr>
                    <td>{{ $proof->id }}</td>
                    <td>{{ $proof->user->name }}</td>
                    <td>{{ $proof->event_reservation_id }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $proof->proof_image) }}" target="_blank">
                            <img src="{{ asset('storage/' . $proof->proof_image) }}" width="100">
                        </a>
                    </td>
                    <td><span class="badge bg-warning">{{ ucfirst($proof->status) }}</span></td>
                    <td>
                        <form action="{{ route('admin.verify-payment', $proof->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm">Verify</button>
                        </form>
                        <form action="{{ route('admin.reject-payment', $proof->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('customer.dashboard') }}">Go back to dashboard</a>
