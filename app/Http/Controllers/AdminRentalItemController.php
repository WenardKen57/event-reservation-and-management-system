<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalItem;

class AdminRentalItemController extends Controller
{
    public function index()
    {
        $rentalItems = RentalItem::all();
        return view('admin.rentals.index', compact('rentalItems'));
    }

    public function create()
    {
        return view('admin.rentals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',
        ]);

        RentalItem::create($request->all());

        return redirect()->route('admin.rentals.index')->with('success', 'Rental item added successfully!');
    }

    public function edit(RentalItem $rentalItem)
    {
        return view('admin.rentals.edit', compact('rentalItem'));
    }

    public function update(Request $request, RentalItem $rentalItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',
        ]);

        $rentalItem->update($request->all());

        return redirect()->route('admin.rentals.index')->with('success', 'Rental item updated successfully!');
    }

    public function destroy(RentalItem $rentalItem)
    {
        $rentalItem->delete();

        return redirect()->route('admin.rentals.index')->with('success', 'Rental item deleted successfully!');
    }
}
