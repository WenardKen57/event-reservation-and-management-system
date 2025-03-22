<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProof;
use App\Models\EventReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    public function showUploadForm()
    {
        $reservations = EventReservation::where('user_id', Auth::id())->where('status', 'pending')->get();
        return view('customer.upload_proof', compact('reservations'));
    }

    public function storeProof(Request $request)
    {
        $request->validate([
            'event_reservation_id' => 'required|exists:event_reservations,id',
            'proof_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $request->file('proof_image')->store('payment_proofs', 'public');

        PaymentProof::create([
            'user_id' => Auth::id(),
            'event_reservation_id' => $request->event_reservation_id,
            'proof_image' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.checkout')->with('success', 'Proof of payment uploaded successfully. Please wait for admin approval.');
    }
}
