<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientAddress>
 */
class PatientAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'patient_id' => fake()->numberBetween($min = 1, $max = 10),
            'area_id' => fake()->numberBetween($min = 1, $max = 5),
            'street_name' => fake()->name(),
            'build_number' => fake()->numberBetween(1,100),
            'floor_number' => fake()->numberBetween(1,100),
            'flat_number' => fake()->numberBetween(1,100),
            'is_main' => fake()->boolean,

        ];
    }
}
