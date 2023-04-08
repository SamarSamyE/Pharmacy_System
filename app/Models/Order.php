<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public static function createOrderMedicine($order, $quantity, $orderMedicine)
    {
        for ($i = 0; $i < count($orderMedicine); $i++) {
            $medicine_order=new MedicineOrder();
            $medicine_order->medicine_id=$orderMedicine[$i];
            $medicine_order->quantity=$quantity[$i];
            $medicine_order->order()->associate($order);
            $medicine_order->save();
         }
    }

    public static function updateOrderMedicine($order, $editedQuantity, $editedOrderMedicine)
    {

        for ($i = 0; $i < count($editedOrderMedicine); $i++) {
            $medicine_order=MedicineOrder::where('order_id', $order->id)
                    ->where('medicine_id', $editedOrderMedicine[$i])
                    ->update([
                        'medicine_id' => $editedOrderMedicine[$i],
                        'quantity' => $editedQuantity[$i],
                    ]);

        }

    }
    public static function totalPrice( $quantity ,$MedicineOreder){
        $totalPrice = 0;
        for ($i = 0; $i < count($MedicineOreder  ?? []); $i++){
            $price = Medicine::where('id',$MedicineOreder[$i])->first()->price;
            $totalPrice += $price * $quantity[$i];
        }

            //dd($totalPrice);

        return $totalPrice;
    }

    // public function medicineOrder(){
    //     return $this->belongsToMany(MedicineOrder::class);
    // }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => intval($value) * 100,

        );
    }


}
