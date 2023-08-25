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
                'name' => 'Urgent',
                'slug' => 'urgent',
                'weight' => 10,
                'created_at' => now()
            ],
            [
                'id'    => 2,
                'name' => 'High',
                'slug' => 'high',
                'weight' => 8,
                'created_at' => now()
            ],
            [
                'id'    => 3,
                'name' => 'Normal',
                'slug' => 'normal',
                'weight' => 5,
                'created_at' => now()
            ],
            [
                'id'    => 4,
                'name' => 'Low',
                'slug' => 'low',
                'weight' => 3,
                'created_at' => now()
            ]
        ];

        Priority::insert($priorities);
    }
}
