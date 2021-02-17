<?php

namespace Database\Seeders;

use App\Models\DonationType;
use Illuminate\Database\Seeder;

class DonationTypesTableSeeder extends Seeder
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
                'name'           => 'Only Animals',
            ],
            [
                'id'             => 2,
                'name'           => 'Only Peoples',
            ],
            [
                'id'             => 3,
                'name'           => 'Both',
            ]
        ];

        DonationType::insert($data);
    }
}
