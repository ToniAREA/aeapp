<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Priority;
use Illuminate\Database\Seeder;

class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $priorities = [
            [
                'id'    => 1,
                'level' => 'Urgent',
            ],
            [
                'id'    => 2,
                'level' => 'High',
            ],
            [
                'id'    => 3,
                'level' => 'Normal',
            ],
            [
                'id'    => 4,
                'level' => 'Low',
            ]
        ];

        Priority::insert($priorities);
    }
}
