<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);
        $this->call(PharmacySeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(PatientAddressSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(AssignRoleSeeder::class);
        $this->call(MedicineSeeder::class);
    }
}
