<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'reference_id',
        'meal_reservation_id',
        'event_reservation_id',
        'rental_reservation_id',
    ];
}
