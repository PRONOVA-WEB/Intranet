<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Rrhh\OrganizationalUnit;


class OrganizationalUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ou0 = OrganizationalUnit::create(['name' => 'Dirección', 'level' => 1, 'organizational_unit_id' => NULL,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Pediatría', 'level' => 2, 'organizational_unit_id' => 1, 'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Planificación y Control de Gestión', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Relaciones Públicas y Comunicaciones', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Participación Social, Gestión al usuario y Gobernanza', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Secretaría y Oficina de Partes', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Gestión del Riesgo en Emergencias y Desastres', 'level' => 2 , 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Relaciones Laborales', 'level' => 2 , 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Calidad y Seguridad del Paciente', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            // $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Relación Asistencial Docente', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);

    }
}
