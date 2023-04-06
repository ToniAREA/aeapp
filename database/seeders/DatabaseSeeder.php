<?php

namespace Database\Seeders;

use App\Models\BoatsType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            PriorityTableSeeder::class,
            EmployeesSeeder::class,
            MarinasSeeder::class,
            ClientsSeeder::class,
            BoatsSeeder::class,
            BoatTypeSeeder::class,            
        ]);
    }
}
