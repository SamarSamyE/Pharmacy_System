<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'=> fake()->unique()->randomNumber(8,true),
            'type'=> fake()->randomElement(['bones', 'Heart','sugare','pressure','ear drops','depressant','narcotic','capsule']),
            'name'=> fake()->randomElement([' Acebutolol','Glimepiride','Entresto','chlorthalidone','feocucort','golgofag','fucideine','mebo']),
            'price'=>0,
            'quantity'=>fake()->numberBetween($min = 1, $max = 10)
        ];
    }
}
