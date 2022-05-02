<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Documents\Summaries\Fiscal;

class FiscalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fiscal = Fiscal::Create(['user_id'=>12345678]);
    }
}
