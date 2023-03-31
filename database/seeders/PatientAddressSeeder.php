<?php

namespace Database\Seeders;

use App\Models\PatientAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PatientAddress::factory()
        ->count(10)
        ->create();
    }
}
