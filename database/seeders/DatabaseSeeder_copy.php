<?php

namespace Database\Seeders;

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
            BoatTypeSeeder::class,
            BoatsSeeder::class,
        ]);
    }
}
