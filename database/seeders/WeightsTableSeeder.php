<?php

namespace Database\Seeders;

use App\Models\Weight;
use Illuminate\Database\Seeder;

class WeightsTableSeeder extends Seeder
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
                'range'           => '1-10 Kg',
            ],
            [
                'id'             => 2,
                'range'           => '11-50 Kg',
            ],
            [
                'id'             => 3,
                'range'           => '51-100 Kg',
            ],
            [
                'id'             => 4,
                'range'           => '101-200 Kg',
            ]
        ];

        Weight::insert($data);
    }
}
