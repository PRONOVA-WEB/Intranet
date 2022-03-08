<?php

namespace Database\Seeders;

use App\Models\Drugs\PoliceUnit;
use Illuminate\Database\Seeder;

class PoliceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $policeUnit = PoliceUnit::Create(['code'=>'1RACO','name'=>'1RA COMISARIA DE CARABINEROS','status'=>1]);
        $policeUnit = PoliceUnit::Create(['code'=>'2RACO','name'=>'2DA COMISARIA DE CARABINEROS','status'=>1]);
        $policeUnit = PoliceUnit::Create(['code'=>'3RACO','name'=>'3RA COMISARIA DE CARABINEROS','status'=>1]);

    }
}
