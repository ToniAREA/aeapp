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
                'type' => 'SY',
            ],
            [
                'id'    => 2,
                'type' => 'MY',
            ],
            [
                'id'    => 3,
                'type' => 'TT',
            ],
            [
                'id'    => 4,
                'type' => 'Other',
            ]
        ];

        BoatsType::insert($boat_types);
    }
}
