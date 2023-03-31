<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'avatar' => Str::random(10),
            'national_id' =>fake()->unique()->randomNumber(8,true),
            'gender' => fake()->randomElement(['male', 'female']),
            'birth_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'mobile'  => fake()->unique()->randomNumber(8,true),
        ];
    }
}
