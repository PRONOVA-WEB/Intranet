<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Establishment;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Establishment::Create(['name'=>'Hospital El Pino','type'=>'Hospital','deis'=>'002','commune_id' => 1]);
    }
}
