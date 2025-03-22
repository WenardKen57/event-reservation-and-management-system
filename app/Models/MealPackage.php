<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MealPackage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total_price'];

    public function inclusions()
    {
        return $this->hasMany(MealPackageInclusion::class);
    }
}
