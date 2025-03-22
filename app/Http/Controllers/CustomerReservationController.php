<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;
use App\Models\EventPackage;
use App\Models\AvailableDate;
use App\Models\MealPackage;

class CustomerReservationController extends Controller
{
    public function create()
    {
        $availableDates = AvailableDate::pluck('date')->toArray();
        $packages = EventPackage::all(); // Fetch all packages
        $mealPackages = MealPackage::all();
        return view('customer.reservation.create', compact('mealPackages','availableDates', 'packages'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:event_packages,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'guests' => 'required|integer|min:1|max:100',
            'event_type' => 'required|string',
            'special_requests' => 'nullable|string',
            'event_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $hour = (int) date('H', strtotime($value)); // Get hour (24-hour format)
                    if ($hour >= 23 || $hour < 6) {
                        $fail('The event time cannot be between 11 PM and 6 AM.');
                    }
                },
            ],
            'package_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validate image
            'meal_package_id' => 'nullable|exists:meal_packages,id', // Optional meal package
            ]);

        $package = EventPackage::findOrFail($request->package_id);
        $mealPackage = $request->meal_package_id ? MealPackage::find($request->meal_package_id) : null;

        EventReservation::create([
            'user_id' => auth()->user()->id,
            'event_package_id' => $request->package_id,
            'total_price' => $package->total_price + ($mealPackage ? $mealPackage->total_price : 0),
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'event_location' => $request->event_location,
            'guest' => $request->guests,
            'event_type' => $request->event_type,
            'special_requests' => $request->special_requests,
            'meal_package_id' => $request->meal_package_id,
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Reservation created successfully!');
    }


    public function cancel($id)
    {
        $reservation = EventReservation::findOrFail($id);

        //dd($reservation);

        // Update the status to "Cancelled"
        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('customer.dashboard')->with('success', 'Reservation cancelled successfully.');
    }


    public function destroy($id)
    {
        $reservation = EventReservation::findOrFail($id);
        
        // Ensure only canceled reservations can be deleted
        if ($reservation->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Only canceled reservations can be deleted.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation deleted successfully.');
    }
}
