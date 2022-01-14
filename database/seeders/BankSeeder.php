<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cfg_banks')->delete();

        \DB::table('cfg_banks')->insert(
            array(
                0 => array('name' => 'Banco Estado', 'code' => '012'),
                1 => array('name' => 'Banco de Chile / Edwards', 'code' => '001'),
                2 => array('name' => 'Banco de Crédito e Inversiones (BCI)', 'code' => '016'),
                3 => array('name' => 'Banco Bice', 'code' => '028'),
                4 => array('name' => 'HSBC Bank', 'code' => '031'),
                5 => array('name' => 'Banco Santander', 'code' => '037'),
                6 => array('name' => 'Itaú / Corpbanca', 'code' => '039'),
                7 => array('name' => 'Banco Security', 'code' => '049'),
                8 => array('name' => 'Scotiabank', 'code' => '014'),
                9 => array('name' => 'Scotiabank Azul (Ex BBVA)', 'code' => '504'),
                10 => array('name' => 'Banco Falabella', 'code' => '051'),
                11 => array('name' => 'Banco Consorcio', 'code' => '055'),
                12 => array('name' => 'Banco BTG Pactual Chile', 'code' => '059'),
                13 => array('name' => 'Banco Internacional', 'code' => '009'),
            )
        );
    }
}
