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
            BoatTypeSeeder::class,
            MarinasSeeder::class,
            /* EmployeesSeeder::class,
            ClientsSeeder::class,
            BoatsSeeder::class, */
        ]);
    }
}
