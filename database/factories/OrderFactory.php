<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'patient_id' => fake()->numberBetween($min = 1, $max = 10),
            'doctor_id' => fake()->numberBetween($min = 1, $max = 10),
            'pharmacy_id' => fake()->numberBetween($min = 1, $max = 10),
            'area_id' => fake()->numberBetween(1, 5),
            'is_insured'=>fake()->boolean,
            'status'=>'new',
            'creator_type'=>fake()->randomElement(['admin','patient','pharmacy','doctor']),
            'patient_address_id'=>fake()->numberBetween($min = 1, $max = 10),
            'price'=>rand(10,100),

        ];
    }
}
