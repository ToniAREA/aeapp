<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'User',
            ],
            [
                'id'    => 3,
                'title' => 'Guest',
            ],
            [
                'id'    => 4,
                'title' => 'Employee',
            ],
            [
                'id'    => 5,
                'title' => 'Office',
            ],
            [
                'id'    => 6,
                'title' => 'Technician',
            ],
        ];

        Role::insert($roles);
    }
}
