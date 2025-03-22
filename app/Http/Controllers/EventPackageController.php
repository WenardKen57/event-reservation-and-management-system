<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventPackageInclusion;
use App\Models\EventPackage;
use App\Models\MealPackage;
use Storage;

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
            'quantities' => 'nullable|array',  // Must be an array
            'quantities.*' => 'nullable|integer|min:1', // Each quantity must be a number
            'event_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = strtotime($value);
                    $start = strtotime('23:00'); // 11 PM
                    $end = strtotime('06:00');  // 6 AM

                    if ($time >= $start || $time < $end) {
                        $fail('The event time cannot be between 11 PM and 6 AM.');
                    }
                },
            ],
        ]);

        // Handle Image Upload
        if ($request->hasFile('package_image')) {
            $imagePath = $request->file('package_image')->store('package_images', 'public');
        } else {
            $imagePath = null;
        }

        // Create the Event Package
        $package = EventPackage::create([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'event_type' => $request->event_type,
            'image' => $imagePath,
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

        // Handle image upload
        if ($request->hasFile('image')) {

            
            // Delete old image if exists
            if ($package->image) {
                Storage::delete('public/' . $package->image);
            }

            // Store new image and update path
            $imagePath = $request->file('image')->store('package_images', 'public');
            $package->image = $imagePath;
        }

        $package->update([
            'package_name' => $request->package_name,
            'description' => $request->description,
            'total_price' => $request->total_price,
            'event_type' => $request->event_type,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Package updated successfully!');
    }


    public function customerPackages() {
        $packages = EventPackage::all(); // Get all event packages
        $mealPackages = MealPackage::all();
        return view('customer.event-packages', compact('packages', 'mealPackages'));
    }

    public function showPackageDetails($id) {
        $package = EventPackage::with('inclusions')->findOrFail($id);
        return view('customer.package-details', compact('package'));
    }
    
    
}
