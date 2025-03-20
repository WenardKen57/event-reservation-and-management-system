<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'event_name',
        'event_date',
        'event_time',
        'event_location',
        'event_package_id',
        'total_price',
    ];
}
