<?php
namespace Database\Seeders;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\MedicineOrder;

use Illuminate\Database\Seeder;

class MedicineOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $medicines = Medicine::all();
        $orders = Order::all();

        foreach ($medicines as $medicine) {
            foreach ($orders as $order) {
                // Create medicine order record with composite key
                MedicineOrder::create([
                    'medicine_id' => $medicine->id,
                    'order_id' => $order->id,
                    'quantity' => rand(1, 10),
                ]);
            }
        }
    }

    }


