<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'order_id',
        'medicine_id',
    ];

    public function medicine(){
        return $this->belongsToMany(Medicine::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }

    public function address(){
        return $this->belongsTo(PatientAddress::class);
    }

    public function image(){
        return $this->hasOne(OrderImage::class);
    }
}
