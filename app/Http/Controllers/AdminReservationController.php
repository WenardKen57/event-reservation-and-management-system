<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;

class AdminReservationController extends Controller
{
    public function approve($id)
    {
        $reservation = EventReservation::findOrFail($id);

        // Ensure only pending reservations can be approved
        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending reservations can be approved.');
        }

        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation approved successfully.');
    }
}
