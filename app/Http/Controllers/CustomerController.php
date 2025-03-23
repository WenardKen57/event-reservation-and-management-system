<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;
use Auth;

class CustomerController extends Controller
{
    public function dashboard() {
        $reservations = EventReservation::where('user_id', auth()->id())
        ->with(['package', 'mealPackage', 'rentalItems'])
        ->get();
        return view('customer.dashboard', compact('reservations'));
    }

}
