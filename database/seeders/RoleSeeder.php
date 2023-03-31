<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $Super_Admin = Role::create(['name' => 'super_admin',]);
        $Admin = Role::create(['name' => 'admin']);
        $Doctor = Role::create(['name' => 'doctor']);
        $Patient = Role::create(['name' => 'patient']);
        $Pharmacy = Role::create(['name' => 'pharmacy']);

        $user=User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
        ])->assignRole('admin');



    }
}
