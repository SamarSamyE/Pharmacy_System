<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\MedicineOrder;
use App\Models\Order;
use App\Models\OrderImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::factory(10)->create();
        $medicines=Medicine::factory(10)->create();
    foreach ($orders as $order) {
        foreach ($medicines as $medicine) {
        $order->image()->save(OrderImage::factory()->create(['order_id' => $order->id]));
        // $order->medicineOrder()->save(MedicineOrder::factory()->create(['order_id' => $order->id]));
        // $medicine->medicineOrder()->save(MedicineOrder::factory()->create(['medicine_id' => $medicine->id]));

    }


    }



    }
}
