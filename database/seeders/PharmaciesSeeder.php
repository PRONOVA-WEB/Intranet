<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Pharmacies\Pharmacy;

class PharmaciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pharmacy::create([
            'name' => 'Principal',
            'address' => '',
        ]);
    }
}
