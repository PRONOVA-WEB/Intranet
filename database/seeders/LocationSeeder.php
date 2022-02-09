<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Parameters\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Location::create([  'name' => 'Central',
                            'address' => 'test #123']);
        Location::create([  'name' => 'Bodega',
                            'address' => 'test #456']);
    }
}
