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
        $user->id = 27005646;
        $user->dv = 6;
        $user->name = "Ana Paula";
        $user->fathers_family = "López";
        $user->mothers_family = "Mendoza";
        $user->password = bcrypt('admin');
        $user->position = "Profesional";
        $user->email = "candidato@pronova.cl";
        $user->save();
    }
}
