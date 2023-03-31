<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
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
              // 'id' => $faker->unique($reset = true)->buildingNumber,
              'national_id' => fake()->unique()->randomNumber(8,true),
              'area_id' => fake()->numberBetween($min = 1, $max = 5),
              'priority' => fake()->numberBetween($min = 1, $max = 3),


        ];
    }
}
