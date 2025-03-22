<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPackage;

class MealPackageController extends Controller
{
    public function index()
    {
        $mealPackages = MealPackage::with('inclusions')->get();
        return view('admin.meal-packages.index', compact('mealPackages'));
    }

    public function create()
    {
        return view('admin.meal-packages.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'inclusions.*.item_name' => 'required|string',
            'total_price' => 'required|integer',
        ]);

        /*
        $totalPrice = collect($request->inclusions)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
        */

        $mealPackage = MealPackage::create([
            'name' => $request->name,
            'total_price' => $request->total_price,
        ]);

        foreach ($request->inclusions as $inclusion) {
            $mealPackage->inclusions()->create($inclusion);
        }

        return redirect()->route('meal-packages.index')->with('success', 'Meal package created successfully.');
    }
}
