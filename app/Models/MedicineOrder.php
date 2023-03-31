<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineOrder extends Model
{
    use HasFactory;
    protected $fillable = [

        'quantity',
        'order_id',
        'medicine_id',

    ];
}
