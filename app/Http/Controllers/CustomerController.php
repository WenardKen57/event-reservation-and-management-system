<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;
use Auth;

class CustomerController extends Controller
{
    public function dashboard() {
        $reservations = EventReservation::where('user_id', Auth::id())->with('package')->get();
        return view('customer.dashboard', compact('reservations'));
    }

}
