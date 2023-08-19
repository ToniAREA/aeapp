<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2023-04-06 15:34:12',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'AreaElectronica',
                'email'              => 'AreaElectronica@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2023-03-23 10:08:16',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'Luiso',
                'email'              => 'Luiso@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 0,
                'verified'           => 1,
                'verified_at'        => '2023-03-23 10:08:16',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 4,
                'name'               => 'Rodolfo',
                'email'              => 'Rodolfo@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 0,
                'verified'           => 1,
                'verified_at'        => '2023-03-23 10:08:16',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 5,
                'name'               => 'Carmen',
                'email'              => 'Carmen@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 0,
                'verified'           => 1,
                'verified_at'        => '2023-03-23 10:08:16',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
            [
                'id'                 => 6,
                'name'               => 'Johans',
                'email'              => 'Johans@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 0,
                'verified'           => 1,
                'verified_at'        => '2023-03-23 10:08:16',
                'two_factor_code'    => '',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
