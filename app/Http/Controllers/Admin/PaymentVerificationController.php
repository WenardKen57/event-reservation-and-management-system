<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProof;
use App\Models\EventReservation;

class PaymentVerificationController extends Controller
{
    public function index()
    {
        $paymentProofs = PaymentProof::where('status', 'pending')->get();
        return view('admin.payment_verifactions.index', compact('paymentProofs'));
    }

    public function verify($id)
    {
        $paymentProof = PaymentProof::findOrFail($id);
        $paymentProof->update(['status' => 'verified']);

            // Debugging
        if (!$paymentProof->eventReservation) {
            return redirect()->route('admin.payment-verifications')->with('error', 'Event reservation not found.');
        }    
        
        // Update deposit_status and reservation status
        $paymentProof->eventReservation->update([
            'deposit_status' => 'deposit_paid',
            'status' => 'approved',
        ]);

        // Check if eventReservation exists before updating
        if ($paymentProof->eventReservation) {
            $paymentProof->eventReservation->update(['deposit_status' => 'deposit_paid']);
            $paymentProof->eventReservation->update(['status' => 'approved']);
        } else {
            return redirect()->route('admin.payment-verifications')->with('error', 'Event reservation not found.');
        }

        return redirect()->route('admin.payment-verifications')->with('success', 'Payment verified successfully.');
    }


    public function reject($id)
    {
        $paymentProof = PaymentProof::findOrFail($id);
        $paymentProof->update(['status' => 'rejected']);

        return redirect()->route('admin.payment-verifications')->with('error', 'Payment proof rejected. Please ask the customer to re-upload.');
    }
}
