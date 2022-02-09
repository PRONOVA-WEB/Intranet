<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('cl_regions')->delete();

        \DB::table('cl_regions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Arica y Parinacota',
                'id_minsal' => 'XV',
                'region_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Tarapacá',
                'id_minsal' => 'I',
                'region_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Antofagasta',
                'id_minsal' => 'II',
                'region_id' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Atacama',
                'id_minsal' => 'III',
                'region_id' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Coquimbo',
                'id_minsal' => 'IV',
                'region_id' => 5,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Valparaiso',
                'id_minsal' => 'V',
                'region_id' => 6,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Metropolitana de Santiago',
                'id_minsal' => 'RM',
                'region_id' => 7,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Libertador General Bernardo O\'Higgins',
                'id_minsal' => 'VI',
                'region_id' => 8,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Maule',
                'id_minsal' => 'VII',
                'region_id' => 9,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Ñuble',
                'id_minsal' => 'XVI',
                'region_id' => 10,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Biobío',
                'id_minsal' => 'VIII',
                'region_id' => 11,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'La Araucanía',
                'id_minsal' => 'IX',
                'region_id' => 12,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Los Ríos',
                'id_minsal' => 'XIV',
                'region_id' => 13,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Los Lagos',
                'id_minsal' => 'X',
                'region_id' => 14,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Aisén del General Carlos Ibáñez del Campo',
                'id_minsal' => 'XI',
                'region_id' => 15,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Magallanes y de la Antártica Chilena',
                'id_minsal' => 'XII',
                'region_id' => 16,
            ),
        ));


    }
}
