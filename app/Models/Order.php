<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_insured',
        'status',
        'creator_type',
        'creator_id',
        'pharmacy_id',
        'doctor_id',
        'patient_id',
        'patient_address_id',
        'price',
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

    public function medicineOrder(){
        return $this->hasOne(MedicineOrder::class);
    }
    public static function totalPrice( $quantity ,$MedicineOreder){
        $totalPrice = 0;
        $price = Medicine::where('id',$MedicineOreder)->first()->price;
            $totalPrice += $price * $quantity;

        return $totalPrice;
    }
}
