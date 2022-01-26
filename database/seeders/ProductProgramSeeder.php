<?php

namespace Database\Seeders;

use App\Pharmacies\Program;
use Illuminate\Database\Seeder;

class ProductProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::Create([
            'name' => 'Programa 1',
        ]);
        Program::Create([
            'name' => 'Programa 2',
        ]);
    }
}
