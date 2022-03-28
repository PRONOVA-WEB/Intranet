<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use App\Rrhh\OrganizationalUnit;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ou = OrganizationalUnit::first();

        $user = new User();
        $user->id = 12345678;
        $user->dv = 9;
        $user->name = "Administrador";
        $user->fathers_family = "Paterno";
        $user->mothers_family = "Materno";
        $user->password = bcrypt('admin');
        $user->position = "Ingeniero Desarrollador";
        $user->email = "adiaz@pronova.cl";
        $user->organizationalUnit()->associate($ou);
        $user->save();
        $user->assignRole('superuser', 'dev','RRHH: admin','Replacement Staff: admin','Drugs: admin');
        $user->givePermissionTo(Permission::all());

        $user = new User();
        $user->id = 98765432;
        $user->dv = 1;
        $user->name = "Director";
        $user->fathers_family = "General";
        $user->mothers_family = "";
        $user->email = "director@pronova.cl";
        $user->password = bcrypt('admin');
        $user->position = "Ingeniero Desarrollador";
        $user->organizationalUnit()->associate($ou);
        $user->save();
        $user->assignRole('superuser', 'dev');
        $user->givePermissionTo(Permission::all());

        //44(Subdirección de Recursos Humanos) = para que sea líder de RRHH
        $user = User::Create(['id'=>56565656, 'dv'=>1, 'name'=>'Subdirección', 'fathers_family'=>'Recursos', 'mothers_family' => 'Humanos',
            'email'=>'rrhh@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente', 'organizational_unit_id'=>'44']);
        $user->assignRole('dev');
        $user->givePermissionTo(Permission::all());

        //48(Unidad de Reclutamiento y Selección de Personal) ->para asignar los requerimientos -> usuario tipo RYS (userrys)
        $user = User::Create(['id'=>32323232, 'dv'=>1, 'name'=>'Reclutamiento', 'fathers_family'=>'Reclutamiento', 'mothers_family' => 'Selección',
            'email'=>'rys@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente', 'organizational_unit_id'=>'48']);
        $user->givePermissionTo(['Replacement Staff: technical evaluation']);
        $user->assignRole('Replacement Staff: user rys');

        /* FIRMANTES MÓDULO DE ABASTECIMIENTO */
        //37 Departamento Gestión de abastecimiento y logistica
        $user = User::Create(['id'=>98989898, 'dv'=>1, 'name'=>'Departamento', 'fathers_family'=>'Abastecimiento', 'mothers_family' => 'Logística',
                'email'=>'abastecimiento@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Director', 'organizational_unit_id'=>'37']);
        $user->assignRole('dev');

        //40 Departamento Gestión finaciera
        $user = User::Create(['id'=>43434343, 'dv'=>1, 'name'=>'Departamento', 'fathers_family'=>'Gestión', 'mothers_family' => 'Financiera',
            'email'=>'finanzas@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Director', 'organizational_unit_id'=>'40']);
        $user->assignRole('dev');
        //manager gestión financiera
        $user = User::Create(['id'=>12121212, 'dv'=>1, 'name'=>'Autoridad', 'fathers_family'=>'Gestión', 'mothers_family' => 'Financiera',
        'email'=>'managerfinanzas@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente', 'organizational_unit_id'=>'40']);
        $user->assignRole('dev');
        $user->givePermissionTo(Permission::all());

        $user = new User();
        $user->id = 88888888;
        $user->dv = 1;
        $user->name = "Candidato";
        $user->fathers_family = "Contratación";
        $user->mothers_family = "Honorarios";
        $user->password = bcrypt('admin');
        $user->position = "Ingeniero Desarrollador";
        $user->email = "candidato@pronova.cl";
        $user->save();
        $user->givePermissionTo('Service Request');
    }
}
