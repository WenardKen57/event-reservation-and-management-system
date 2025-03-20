<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Str;

class CustomerTransactionController extends Controller
{
    
    public function create() {
        return view('customer.transaction');
    }

    public function store(Request $request) {

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->reference_id = Str::uuid();
        $transaction->save();

        $validated = $request->validate([
            'event_name' => 'required',
            'event_date' => [
                'required',
                'date',
                'after_or_equal:' . now()->toDateString(), // Ensures today or future dates
                'before_or_equal:' . now()->endOfMonth()->toDateString(), // Ensures within this month
            ],
            'event_time' => 'required',
            'event_location' => 'required',
            'event_package_id' => 'required',
        ]);
        $validated['total_price'] = 100;

        $validated['transaction_id'] = $transaction->id; // Assign transaction ID before saving
        $reservation = EventReservation::create($validated);

        // Adding the total amount to pay
        $transaction = Transaction::find($transaction->id);
        $transaction->total_amount += $reservation->total_price;
        $transaction->save();

        return redirect(route('customer.dashboard'));
    }
}
