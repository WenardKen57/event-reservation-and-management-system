<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;
use App\Models\EventPackage;

class CustomerReservationController extends Controller
{
    public function create()
    {
        $packages = EventPackage::all(); // Fetch all packages
        return view('customer.reservation.create', compact('packages'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:event_packages,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'guests' => 'required|integer|min:1',
            'event_type' => 'required|string',
            'special_requests' => 'nullable|string',
        ]);

        $package = EventPackage::findOrFail($request->package_id);

        EventReservation::create([
            'user_id' => auth()->user()->id,
            'event_package_id' => $request->package_id,
            'total_price' => $package->total_price,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'event_location' => $request->event_location,
            'guests' => $request->guests,
            'event_type' => $request->event_type,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Reservation created successfully!');
    }
}
