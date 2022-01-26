<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Pharmacies\Supplier;

class PharmacySuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
           'name' => 'Drogueria 1',
           'rut' => '1234123-4',
           'pharmacy_id' => '1',
        ]);
    }
}
