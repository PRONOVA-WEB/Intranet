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
            $ou1 = OrganizationalUnit::create(['name' => 'Subdirección de Gestion Asistencial / Subdirección Médica', 'level' => 2, 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Red de Salud Mental', 'level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión de Establecimientos y Dispositivos', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión de Recursos de Salud Mental', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Modelo de Gestión de Salud Mental', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Redes Hospitalarias','level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Servicios y Unidades de Apoyo Clínico','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Gestión de Demanda','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión de Procesos Clínicos','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión de Recursos e Inversiones','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de APS y Redes', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Salud Familiar', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Planes y Programas', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Gestión de Recursos e Inversiones', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Red de Urgencias','level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'S.A.M.U.', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Establecimientos de Red de Urgencias', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Planificación y Control de Redes', 'level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Informática y Tecnología', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad Epidemiología', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Gestión de Información', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Gestión y Control', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Consultorio General Urbano Dr. Hector Reyno', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión Administrativa', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Coordinador Médico', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Gestión Clínica', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Oficina de Información, Reclamos y Sugerencias (O.I.R.S.)', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'P.E.S.P.I.', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                $ou2 = OrganizationalUnit::create(['name' => 'P.R.A.I.S.', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);

            $ou1 = OrganizationalUnit::create(['name' => 'Subdirección de Recursos Físicos y Financieros', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Gestión de Recursos Físicos e Inversiones de la Red', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Planificación de Análisis y Control de Equipos y Equipamiento de la Red', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Planificación de Análisis y Control de Infraestructura, Proyectos e Inversiones de la Red','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Gestión y Control de procesos y Administrativos de Inverciones','level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Inspección Técnicas de Obras', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Gestión de Abastecimiento y Logística', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Planificación de Ejecución y Control de Abastecimiento, Obras, Equipo y Equipamiento', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Servicios Generales', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Gestión Financiera','level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Planificación, Análisis y Control Financiera y Presupuestaria', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Cobranzas','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Sección de Contabilidad', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

            $ou1 = OrganizationalUnit::create(['name' => 'Subdirección de Recursos Humanos', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Gestión de Recursos Humanos', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Personal y Ciclo de Vida laboral','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad Formación y Capacitación','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Reclutamiento y Selección de Personal', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Remuneraciones','level' => 4 , 'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Calidad de Vida Laboral', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Bienestar', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Apoyo Social del Personal', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Clima Laboral', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Salud del Trabajador', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Departamento de Salud Ocupacional', 'level' => 3 , 'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Prevención de Riesgos', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Salud Ocupacional', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);
                    $ou3 = OrganizationalUnit::create(['name' => 'Unidad de Gestión Ambiental', 'level' => 4 ,'organizational_unit_id' => $ou2->id,'establishment_id' => 1 ]);

                $ou2 = OrganizationalUnit::create(['name' => 'Planificación y Control de Gestión de Recursos Humanos', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);

            $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Auditoria Interna','level' => 2 , 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Asesoría Jurídica', 'level' => 3 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
                $ou2 = OrganizationalUnit::create(['name' => 'Unidad de Drogas', 'level' => 3 ,'organizational_unit_id' => $ou1->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Planificación y Control de Gestión', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Relaciones Públicas y Comunicaciones', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Departamento de Participación Social, Gestión al usuario y Gobernanza', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Secretaría y Oficina de Partes', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Gestión del Riesgo en Emergencias y Desastres', 'level' => 2 , 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Relaciones Laborales', 'level' => 2 , 'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Calidad y Seguridad del Paciente', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);
            $ou1 = OrganizationalUnit::create(['name' => 'Unidad de Relación Asistencial Docente', 'level' => 2 ,'organizational_unit_id' => $ou0->id,'establishment_id' => 1 ]);

    }
}
