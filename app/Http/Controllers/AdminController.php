<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard() {
        $transactions = Transaction::all();
        return view('admin.dashboard', compact('transactions'));
    }
}
