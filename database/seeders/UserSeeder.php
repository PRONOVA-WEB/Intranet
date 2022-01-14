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
        $user->assignRole('god', 'dev','RRHH: admin','Replacement Staff: admin');
        $user->givePermissionTo(Permission::all());

        $user = new User();
        $user->id = 98765432;
        $user->dv = 1;
        $user->name = "Victor";
        $user->fathers_family = "Ramirez";
        $user->mothers_family = "";
        $user->email = "vramirez@pronova.cl";
        $user->password = bcrypt('admin');
        $user->position = "Ingeniero Desarrollador";
        $user->organizationalUnit()->associate($ou);
        $user->save();
        $user->assignRole('god', 'dev');
        $user->givePermissionTo(Permission::all());

        //44(Subdirección de Recursos Humanos) = para que sea líder de RRHH
        $user = User::Create(['id'=>12121212, 'dv'=>1, 'name'=>'Jorge', 'fathers_family'=>'Galleguillos', 'mothers_family' => 'Möller',
            'email'=>'jgalleguillos@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente', 'organizational_unit_id'=>'44']);
        $user->assignRole('dev');
        $user->givePermissionTo(Permission::all());

        //48(Unidad de Reclutamiento y Selección de Personal) ->para asignar los requerimientos -> usuario tipo RYS (userrys)
        $user = User::Create(['id'=>32323232, 'dv'=>1, 'name'=>'Usuario', 'fathers_family'=>'Reclutamiento', 'mothers_family' => 'Selección',
            'email'=>'rys@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente', 'organizational_unit_id'=>'48']);
        $user->assignRole('Replacement Staff: user rys');
    }
}
