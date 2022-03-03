<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserExternal;

class UserExternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new UserExternal();
        $user->id = 88888888;
        $user->dv = 1;
        $user->name = "Usuario";
        $user->fathers_family = "Externo";
        $user->mothers_family = "";
        $user->password = bcrypt('admin');
        $user->position = "Ingeniero Desarrollador";
        $user->email = "externo@pronova.cl";
        $user->save();
    }
}
