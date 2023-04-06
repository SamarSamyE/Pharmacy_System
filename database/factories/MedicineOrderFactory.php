<?php

namespace Database\Factories;
use App\Models\OrderMedicine;
use App\Models\Order;
use App\Models\Medicine;
use App\Models\MedicineOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicineOrder>
 */
class MedicineOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween($min = 1, $max = 20),
         ];

     }
}
