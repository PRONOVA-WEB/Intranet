<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Parameters\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Place::create([ 'name' => 'Oficina 1',
                        'description' => 'Oficina Principal',
                        'location_id' => 2]);
        Place::create([ 'name' => 'Oficina 2',
                        'description' => 'Oficina Secundaria',
                        'location_id' => 2]);
    }
}
