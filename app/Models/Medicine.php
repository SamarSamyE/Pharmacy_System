<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'is_deleted',
        'type',
        'price'
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => intval($value) * 100,

        );
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function medicineOrder(){
        return $this->belongsToMany(MedicineOrder::class);
    }
}
