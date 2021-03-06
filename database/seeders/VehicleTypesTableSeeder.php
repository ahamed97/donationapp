<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'             => 1,
                'name'           => 'Bike',
            ],
            [
                'id'             => 2,
                'name'           => 'Car',
            ],
            [
                'id'             => 3,
                'name'           => '3 wheeler',
            ],
            [
                'id'             => 4,
                'name'           => 'Van',
            ],
            [
                'id'             => 5,
                'name'           => 'Truck',
            ]
        ];

        VehicleType::insert($data);
    }
}
