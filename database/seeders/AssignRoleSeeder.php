<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pharmacies = User::where('typeable_type', Pharmacy::class)->get();
        foreach ($pharmacies as $pharmacy) {
            $pharmacy->assignRole('pharmacy');
        }

        $doctors = User::where('typeable_type', Doctor::class)->get();
        foreach ($doctors as $doctor) {
            $doctor->assignRole('doctor');
        }

        $patients = User::where('typeable_type', Patient::class)->get();
        foreach ($patients as $patient) {
            $patient->assignRole('patient');
        }

    }
}
