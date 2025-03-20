<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPackageInclusion extends Model
{
    protected $fillable = ['item_name', 'quantity', 'event_package_id'];
}
