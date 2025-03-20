<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventPackageInclusion;
use App\Models\EventPackage;

class EventPackageController extends Controller
{
    public function create() {
        return view('admin.create-event-package');
    }

    public function store(Request $request) {
       // Validate the request
        $request->validate([
            'package_name' => 'required|string|max:255',
            'inclusions' => 'required|array', // Ensure it's an array
            'inclusions.*' => 'required|string|max:255', // Each inclusion must be a string
            'quantities' => 'required|array',  // Must be an array
            'quantities.*' => 'required|integer|min:1', // Each quantity must be a number
        ]);

        // Create the Event Package
        $package = EventPackage::create([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'event_type' => $request->event_type,

        ]);

        // Save the inclusions
        foreach ($request->inclusions as $index => $inclusionText) {
            EventPackageInclusion::create([
                'event_package_id' => $package->id,
                'item_name' => $inclusionText,
                'quantity' => $request->quantities[$index], // Get matching quantity

            ]);
        } 
        return redirect(route('admin.dashboard'));
    }

    public function destroyEventPackage($id)
    {
        $package = EventPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Package deleted successfully!');
    }

    public function editEventPackage($id)
    {
        $package = EventPackage::findOrFail($id);
        return view('admin.edit-event-package', compact('package'));
    }

    public function updateEventPackage(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'description' => 'required|string',
            'total_price' => 'required|numeric',
            'event_type' => 'required|string|in:wedding,birthday,others',
        ]);

        $package = EventPackage::findOrFail($id);
        $package->update([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'event_type' => $request->event_type,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Package updated successfully!');
    }
}
