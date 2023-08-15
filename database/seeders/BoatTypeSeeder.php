<?php

namespace Database\Seeders;

use App\Models\BoatsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $boat_types = [
            [
                'id'    => 1,
                'type' => 'XX',
            ],
            [
                'id'    => 2,
                'type' => 'MY',
            ],
            [
                'id'    => 3,
                'type' => 'SY',
            ],
            [
                'id'    => 4,
                'type' => 'TT',
            ]
        ];

        BoatsType::insert($boat_types);
    }
}
