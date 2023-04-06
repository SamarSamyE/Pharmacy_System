<?php

namespace Database\Seeders;

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
        foreach ($orders as $order) {
        $order->image()->save(OrderImage::factory()->create(['order_id' => $order->id]));
}

    }
}
