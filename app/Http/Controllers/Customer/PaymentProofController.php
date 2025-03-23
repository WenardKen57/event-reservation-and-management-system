<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProof;
use App\Models\EventReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\GCashSetting;

class PaymentProofController extends Controller
{
    public function showUploadForm()
    {
        // Fetch the GCash QR code uploaded by admin
        $gcashSetting = GCashSetting::first();
        $reservations = EventReservation::where('user_id', Auth::id())->where('status', 'pending')->get();
        return view('customer.upload_proof', compact('reservations', 'gcashSetting'));
    }

    public function storeProof(Request $request)
    {
        $request->validate([
            'event_reservation_id' => [
                'required',
                Rule::exists('event_reservations', 'id'),
                Rule::unique('payment_proofs', 'event_reservation_id')->where(function ($query) {
                    return $query->where('status', '!=', 'rejected'); // Allow re-upload if previous proof was rejected
                })
            ],
            'proof_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'event_reservation_id.unique' => 'You have already uploaded proof for this reservation.',
        ]);

        $path = $request->file('proof_image')->store('payment_proofs', 'public');

        PaymentProof::create([
            'user_id' => Auth::id(),
            'event_reservation_id' => $request->event_reservation_id,
            'proof_image' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.checkout')->with('success', 'Proof of payment uploaded successfully.');
    }

}
