<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use Event;
use Illuminate\Http\Request;
use App\Models\EventPackage;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard() {
        $reservations = EventReservation::with(['customer', 'package'])
        ->whereIn('status', ['pending', 'approved']) // Fetch both pending & approved
        ->orderByRaw("FIELD(status, 'pending', 'approved')") // Sort pending first
        ->get();
        $users = User::all();
        $packages = EventPackage::with('inclusions')->get();

        return view('admin.dashboard', compact('packages', 'reservations', 'users'));

    }
}
