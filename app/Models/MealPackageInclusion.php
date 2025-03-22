<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealPackageInclusion extends Model
{
    use HasFactory;

    protected $fillable = ['meal_package_id', 'item_name', 'quantity', 'price'];

    public function mealPackage()
    {
        return $this->belongsTo(MealPackage::class);
    }
}

