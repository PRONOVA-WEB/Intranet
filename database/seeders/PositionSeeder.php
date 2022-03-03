<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('positions')->delete();

        \DB::table('positions')->insert(
            array(
                0 => array('name' => 'Director'),
                1 => array('name' => 'Directora'),
                2 => array('name' => 'Director (S)'),
                3 => array('name' => 'Directora (S)'),
                4 => array('name' => 'Subdirector'),
                5 => array('name' => 'Subdirectora'),
                6 => array('name' => 'Subdirector (S)'),
                7 => array('name' => 'Subdirectora (S)'),
                8 => array('name' => 'Jefe'),
                9 => array('name' => 'Jefa'),
                10 => array('name' => 'Jefe (S)'),
                11 => array('name' => 'Jefa (S)'),
                12 => array('name' => 'Encargado'),
                13 => array('name' => 'Encargada'),
                14 => array('name' => 'Encargado (S)'),
                15 => array('name' => 'Encargada (S)'),
                16 => array('name' => 'Secretario'),
                17 => array('name' => 'Secretaria'),
                18 => array('name' => 'Secretario (S)'),
                19 => array('name' => 'Secretaria (S)'),
            )
        );
    }
}
