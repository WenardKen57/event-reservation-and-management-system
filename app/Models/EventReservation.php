<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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
        'meal_package_id',
    ];

    // Define relationship with User (Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function mealPackage()
    {
        return $this->belongsTo(MealPackage::class, 'meal_package_id');
    }

    public function package()
    {
        return $this->belongsTo(EventPackage::class, 'event_package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming user_id is the foreign key
    }

    protected static function booted()
    {
        static::updated(function ($reservation) {
            // Only proceed if the status was changed to 'approved'
            if ($reservation->status === 'approved') {
                // Count reservations with 'approved' status for the same date
                $count = self::where('event_date', $reservation->event_date)
                    ->where('status', 'approved')
                    ->count();

                // If 3 approved reservations exist, remove the date from available_dates
                if ($count >= 3) {
                    DB::table('available_dates')->where('date', $reservation->event_date)->delete();
                }
            }
        });
    }

}
