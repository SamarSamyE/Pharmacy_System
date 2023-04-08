<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class MedicineOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'order_id',
        'medicine_id',
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function medicine(){
        return $this->hasMany(Medicine::class);
    }
}


