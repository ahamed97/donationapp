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
                'name'           => 'Van',
            ],
            [
                'id'             => 4,
                'name'           => 'Truck',
            ]
        ];

        VehicleType::insert($data);
    }
}
