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
        $user->assignRole('god', 'dev','RRHH: admin');
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

        $user = User::Create(['id'=>12121212, 'dv'=>1, 'name'=>'Jorge', 'fathers_family'=>'Galleguillos', 'mothers_family' => 'Möller',
            'email'=>'jgalleguillos@pronova.cl','password'=>bcrypt('admin'), 'position'=>'Gerente de Proyectos y Operaciones', 'organizational_unit_id'=>$ou->id]);
        $user->assignRole('dev');
        $user->givePermissionTo(Permission::all());

    }
}
