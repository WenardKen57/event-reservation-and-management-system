<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_package_id',
        'event_name',
        'event_date',
        'event_time',
        'event_location',
        'guest',
        'event_package_id',
        'total_price',
        'status',
    ];

    // Define relationship with User (Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function package()
    {
        return $this->belongsTo(EventPackage::class, 'event_package_id');
    }

}
