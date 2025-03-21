<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvailableDate;

class AvailableDateController extends Controller
{
    public function index()
    {
        $availableDates = AvailableDate::orderBy('date', 'asc')->get();
        return view('admin.available-dates.index', compact('availableDates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:available_dates,date',
        ]);

        AvailableDate::create(['date' => $request->date]);

        return redirect()->route('admin.available-dates.index')->with('success', 'Date added successfully.');
    }

    public function destroy($id)
    {
        AvailableDate::findOrFail($id)->delete();
        return redirect()->route('admin.available-dates.index')->with('success', 'Date removed successfully.');
    }
}
