<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Resources\Telephone;
use App\User;

class TelephoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $telephone = Telephone::Create(['number'=>572406984, 'minsal'=>576984]);
        $telephone->users()->attach(User::find(12121212));

        $telephone = Telephone::Create(['number'=>572539004, 'minsal'=>579004]);
        $telephone->users()->attach(User::find(98765432));

        /**
         * Create 10 random telephones.
         */
        //factory(App\Resources\Telephone::class, 10)->create();

    }
}
