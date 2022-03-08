<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drugs\Court;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $court = Court::Create(['name'=>'Fiscalía Local 1','address'=>'Santiago', 'commune'=>'Santiago','status'=>1]);
        $court = Court::Create(['name'=>'Fiscalía Local 2','address'=>'Santiago', 'commune'=>'Santiago','status'=>1]);
        $court = Court::Create(['name'=>'Fiscalía Local 3','address'=>'Santiago', 'commune'=>'Santiago','status'=>1]);

    }
}
