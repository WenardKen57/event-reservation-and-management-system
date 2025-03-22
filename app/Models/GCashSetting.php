<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCashSetting extends Model
{
    use HasFactory;

    protected $table = 'gcash_settings';
    protected $fillable = ['qr_code'];
}
