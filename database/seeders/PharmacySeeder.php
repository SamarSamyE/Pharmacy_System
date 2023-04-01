<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Pharmacy::factory(10)->create()->each(function ($pharmacy) {
        $pharmacy->type()->save(User::factory()->create());
    });
    }
}
