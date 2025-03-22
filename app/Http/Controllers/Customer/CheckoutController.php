<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GCashSetting;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $gcashSetting = GCashSetting::first(); // Get the QR code

        return view('customer.checkout', compact('gcashSetting'));
    }
}
