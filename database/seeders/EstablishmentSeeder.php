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
        Establishment::Create(['name'=>'Servicio de Salud','type'=>'Hospital','deis'=>'111300','commune_id' => 1]);
        Establishment::Create(['name'=>'Félix Bulnes','type'=>'Hospital','deis'=>'102-100','commune_id' => 26]);
    }
}
