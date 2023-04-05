<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
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
        $Admin = Role::create(['name' => 'admin']);
        $Doctor = Role::create(['name' => 'doctor']);
        $Patient = Role::create(['name' => 'patient']);
        $Pharmacy = Role::create(['name' => 'pharmacy']);


        Permission::create(['name' => 'manage pharmacies']); //crud on pharmacy
        Permission::create(['name' => 'manage doctors']);
        Permission::create(['name' => 'manage patients']);
        Permission::create(['name' => 'manage areas']);
        Permission::create(['name' => 'manage addresses']);
        Permission::create(['name' => 'manage medicines']);
        Permission::create(['name' => 'manage orders']);


        Permission::create(['name' => 'manage own doctors']); //crud on own doctors
        Permission::create(['name' => 'update own pharmacy']); //edit own pharmacy info except area and priority

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'update order status']);

        Permission::create(['name' => 'manage own addresses']);
        Permission::create(['name' => 'manage own orders']);
        Permission::create(['name' => 'update own user info']); //edit own info except email

        $Doctor->givePermissionTo('update order status');
        $Patient->givePermissionTo(['manage own addresses', 'manage own orders', 'update own user info']);
        $Pharmacy->givePermissionTo(['manage own doctors', 'update own pharmacy', 'view orders', 'edit orders', 'delete orders']);
        $Admin->syncPermissions(Permission::all());

        $user=User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
        ])->assignRole('admin');
    }
}
/////////////////////////////////
// if(auth()->user()->can('manage-doctors'){
//     //this means that the auth user is an admin
//     elseif(auth()->user()->can('manage-own-doctors')){
//     //this means that it's not an admin and that it is a pharmacy
//     }
//     })
