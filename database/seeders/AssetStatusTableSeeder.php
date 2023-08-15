<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusTableSeeder extends Seeder
{
    public function run()
    {
        $assetStatuses = [
            [
                'id'         => 1,
                'name'       => 'Available',
            ],
            [
                'id'         => 2,
                'name'       => 'Not Available',
            ],
            [
                'id'         => 3,
                'name'       => 'Broken',
            ],
            [
                'id'         => 4,
                'name'       => 'Out for Repair',
            ],
        ];

        AssetStatus::insert($assetStatuses);
    }
}
