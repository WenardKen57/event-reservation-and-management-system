<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPackage extends Model
{
    protected $fillable = ['package_name', 'description', 'total_price', 'event_type', 'image'];
    // Define the relationship correctly
    public function inclusions()
    {
        return $this->hasMany(EventPackageInclusion::class, 'event_package_id');
    }
}
