<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Rrhh\Authority;
use Carbon\Carbon;

class AuthoritySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */

    public function run()
    {

        //DB::table('rrhh_authorities')->insert([
        Authority::create([
            'user_id' => '12345678',
            'from' => carbon::now()->toDateString(),
            'to' => carbon::now()->addYear()->toDateString(),
            'position_id' => '6',
            'type' => 'manager',
            'decree' => 'resol. pendiente',
            'organizational_unit_id' => '1',
            'creator_id' => '12345678',
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);

        Authority::create([
            'user_id' => '12345678',
            'from' => carbon::now()->toDateString(),
            'to' => carbon::now()->addYear()->toDateString(),
            'position_id' => '6',
            'type' => 'manager',
            'decree' => 'resol. pendiente',
            'organizational_unit_id' => '2',
            'creator_id' => '12345678',
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);
// //secreatrio de Direccion
//         Authority::create([
//             'user_id' => '12345678',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '17',
//             'type' => 'secretary',
//             'decree' => 'resol. pendiente',
//             'organizational_unit_id' => '1',
//             'creator_id' => '12345678',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '1',
//             'type' => 'manager',
//             'organizational_unit_id' => '1',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '2',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '24',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '40',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '44',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '59',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '5',
//             'type' => 'manager',
//             'organizational_unit_id' => '1',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '56565656',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '7',
//             'type' => 'manager',
//             'organizational_unit_id' => '44',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '17',
//             'type' => 'secretary',
//             'organizational_unit_id' => '44',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

//         Authority::create([
//             'user_id' => '98765432',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '17',
//             'type' => 'secretary',
//             'organizational_unit_id' => '44',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);
// //37 Departamento Gestión de abastecimiento y logistica
//         Authority::create([
//             'user_id' => '98989898',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '37',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);
//        //40 Departamento Gestión finaciera
//         Authority::create([
//             'user_id' => '12121212',
//             'from' => carbon::now()->toDateString(),
//             'to' => carbon::now()->addYear()->toDateString(),
//             'position_id' => '9',
//             'type' => 'manager',
//             'organizational_unit_id' => '40',
//             'creator_id' => '98765432',
//             'created_at' => carbon::now(),
//             'updated_at' => carbon::now()
//         ]);

    }
}
