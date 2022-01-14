<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commune;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('communes')->delete();

        \DB::table('communes')->insert(
            array(
                0 => array('name' => 'Santiago'),
                1 => array('name' => 'Cerrillos'),
                2 => array('name' => 'Cerro Navia'),
                3 => array('name' => 'Conchalí'),
                4 => array('name' => 'El Bosque'),
                5 => array('name' => 'Estación Central'),
                6 => array('name' => 'Huechuraba'),
                7 => array('name' => 'Independencia'),
                8 => array('name' => 'La Cisterna'),
                9 => array('name' => 'La Florida'),
                10 => array('name' => 'La Granja'),
                11 => array('name' => 'La Pintana'),
                12 => array('name' => 'La Reina'),
                13 => array('name' => 'Las Condes'),
                14 => array('name' => 'Lo Barnechea'),
                15 => array('name' => 'Lo Espejo'),
                16 => array('name' => 'Lo Prado'),
                17 => array('name' => 'Macul'),
                18 => array('name' => 'Maipú'),
                19 => array('name' => 'Ñuñoa'),
                20 => array('name' => 'Pedro Aguirre Cerda'),
                21 => array('name' => 'Peñalolén'),
                22 => array('name' => 'Providencia'),
                23 => array('name' => 'Pudahuel'),
                24 => array('name' => 'Quilicura'),
                25 => array('name' => 'Quinta Normal'),
                26 => array('name' => 'Recoleta'),
                27 => array('name' => 'Renca'),
                28 => array('name' => 'San Joaquín'),
                29 => array('name' => 'San Miguel'),
                30 => array('name' => 'San Ramón'),
                31 => array('name' => 'Vitacura'),
                32 => array('name' => 'Puente Alto'),
                33 => array('name' => 'Pirque'),
                34 => array('name' => 'San José De Maipo'),
                35 => array('name' => 'Colina'),
                36 => array('name' => 'Lampa'),
                37 => array('name' => 'Tiltil'),
                38 => array('name' => 'San Bernardo'),
                39 => array('name' => 'Buin'),
                40 => array('name' => 'Calera De Tango'),
                41 => array('name' => 'Paine'),
                42 => array('name' => 'Melipilla'),
                43 => array('name' => 'Alhué'),
                44 => array('name' => 'Curacaví'),
                45 => array('name' => 'María Pinto'),
                46 => array('name' => 'San Pedro'),
                47 => array('name' => 'Talagante'),
                48 => array('name' => 'El Monte'),
                49 => array('name' => 'Isla De Maipo'),
                50 => array('name' => 'Padre Hurtado'),
                51 => array('name' => 'Peñaflor'),
            )
        );
    }
}
