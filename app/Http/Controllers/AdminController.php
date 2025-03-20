<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventPackage;

class AdminController extends Controller
{
    public function dashboard() {
        $packages = EventPackage::all();
        return view('admin.dashboard', compact('packages'));
    }
}
