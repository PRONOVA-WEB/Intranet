<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class HepUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            0 => array('id' => '17257007', 'dv' => '0', 'name' => 'EVELYN', 'fathers_family' => 'MARTINEZ', 'mothers_family' => 'VINEZ', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            1 => array('id' => '17599541', 'dv' => '2', 'name' => 'VALENTINA', 'fathers_family' => 'QUEZADA', 'mothers_family' => 'LARA', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            2 => array('id' => '13234876', 'dv' => '6', 'name' => 'CAROLINA', 'fathers_family' => 'PEREZ', 'mothers_family' => 'SALINAS', 'position' => 'enfermera jefe', 'organizational_units_id' => '2'),
            3 => array('id' => '15721464', 'dv' => '0', 'name' => 'AGUEDA', 'fathers_family' => 'GAETE', 'mothers_family' => 'GODOY', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            4 => array('id' => '16121518', 'dv' => 'K', 'name' => 'STEPHANIE', 'fathers_family' => 'TORRES', 'mothers_family' => 'URZUA', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            5 => array('id' => '17765033', 'dv' => '1', 'name' => 'CINDY', 'fathers_family' => 'NUÑEZ', 'mothers_family' => 'GUERRERO', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            6 => array('id' => '25023573', 'dv' => '9', 'name' => 'MARTHA', 'fathers_family' => 'BARRANTES', 'mothers_family' => 'SANCHEZ', 'position' => 'enfermera', 'organizational_units_id' => '2'),
            7 => array('id' => '10965708', 'dv' => '5', 'name' => 'MARTA', 'fathers_family' => 'BARRIA', 'mothers_family' => 'GONZALEZ', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            8 => array('id' => '11683784', 'dv' => '6', 'name' => 'CAROLYN', 'fathers_family' => 'CASTRO ', 'mothers_family' => 'CARTES', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            9 => array('id' => '16264670', 'dv' => '2', 'name' => 'ELGA', 'fathers_family' => 'DIAMOND', 'mothers_family' => 'BOLBARAN', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            10 => array('id' => '11230494', 'dv' => '0', 'name' => 'LUIS', 'fathers_family' => 'FLORES', 'mothers_family' => 'VALDES', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            11 => array('id' => '11063790', 'dv' => 'K', 'name' => 'MARIA', 'fathers_family' => 'GALLARDO', 'mothers_family' => 'GONZALEZ', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            12 => array('id' => '15621578', 'dv' => '3', 'name' => 'LAURA', 'fathers_family' => 'LAGOS', 'mothers_family' => 'ROJAS', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            13 => array('id' => '14312225', 'dv' => '5', 'name' => 'ANGELICA', 'fathers_family' => 'MESA', 'mothers_family' => 'PEREZ', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            14 => array('id' => '17464390', 'dv' => '3', 'name' => 'NICOLE', 'fathers_family' => 'TORRES', 'mothers_family' => 'PEÑAILILLO', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            15 => array('id' => '17609961', 'dv' => '5', 'name' => 'ESTEFANIA', 'fathers_family' => 'PALMA', 'mothers_family' => 'LAGOS', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            16 => array('id' => '9501433', 'dv' => '6', 'name' => 'P', 'fathers_family' => 'V', 'mothers_family' => 'T', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            17 => array('id' => '17490641', 'dv' => '6', 'name' => 'CAMILA', 'fathers_family' => 'JORQUERA', 'mothers_family' => 'BONTA', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            18 => array('id' => '18498584', 'dv' => '5', 'name' => 'GUILLERMO', 'fathers_family' => 'ROJAS', 'mothers_family' => 'MORALES', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            19 => array('id' => '10956793', 'dv' => '0', 'name' => 'SANDRA', 'fathers_family' => 'TORDECILLA', 'mothers_family' => 'GONZALEZ', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            20 => array('id' => '19115129', 'dv' => '1', 'name' => 'TAMARA', 'fathers_family' => 'ZUÑIGA', 'mothers_family' => 'FERNANDEZ', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            21 => array('id' => '19733529', 'dv' => '7', 'name' => 'BASTIAN', 'fathers_family' => 'CHACON', 'mothers_family' => 'ACUÑA', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            22 => array('id' => '23368105', 'dv' => '9', 'name' => 'JORDAN', 'fathers_family' => 'MUÑOZ', 'mothers_family' => 'ACUÑA', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            23 => array('id' => '20597036', 'dv' => '3', 'name' => 'PIERINA', 'fathers_family' => 'OBREGON', 'mothers_family' => 'LUENGO', 'position' => 'tecnico de enfermeria', 'organizational_units_id' => '2'),
            24 => array('id' => '7724745', 'dv' => '9', 'name' => 'RUTH', 'fathers_family' => 'MORALES', 'mothers_family' => 'CABELLO', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            25 => array('id' => '9661964', 'dv' => '2', 'name' => 'ELSA', 'fathers_family' => 'SILVA', 'mothers_family' => 'PAVEZ', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            26 => array('id' => '17228122', 'dv' => '2', 'name' => 'RODRIGO', 'fathers_family' => 'URRA', 'mothers_family' => 'BULNES', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            27 => array('id' => '12678242', 'dv' => 'K', 'name' => 'MARJORIE', 'fathers_family' => 'HERMOSILLA', 'mothers_family' => 'FUENTEALBA', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            28 => array('id' => '16904142', 'dv' => '3', 'name' => 'KAROL', 'fathers_family' => 'PINO', 'mothers_family' => 'VILLABLANCA', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            29 => array('id' => '20984763', 'dv' => '9', 'name' => 'ESCARLET', 'fathers_family' => 'ROJAS', 'mothers_family' => 'BUSTAMANTE', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            30 => array('id' => '12422205', 'dv' => '2', 'name' => 'EDGARDO', 'fathers_family' => 'SILVA', 'mothers_family' => 'FERNANDEZ', 'position' => 'auxiliar', 'organizational_units_id' => '2'),
            31 => array('id' => '19429402', 'dv' => '5', 'name' => 'J', 'fathers_family' => 'P', 'mothers_family' => 'G', 'position' => 'secretaria', 'organizational_units_id' => '2'),
        );

        foreach($users as $user)
        {
            $usuario = New User();
            $usuario->id = $user['id'];
            $usuario->dv = $user['dv'];
            $usuario->name = $user['name'];
            $usuario->fathers_family = $user['fathers_family'];
            $usuario->mothers_family = $user['mothers_family'];
            $usuario->position = ucfirst($user['position']);
            $usuario->organizational_unit_id = '2';
            $usuario->email = $user['id'].'@gmail.com';
            $usuario->password =  bcrypt($user['id']);

            $usuario->save();

            $usuario->assignRole('RRHH: shift view');
        }
    }
}
