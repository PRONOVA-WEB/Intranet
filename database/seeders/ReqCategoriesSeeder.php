<?php

namespace Database\Seeders;

use App\Requirements\Category;
use Illuminate\Database\Seeder;

class ReqCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Categoria 1',
            'color'=> 'AB2567',
            'user_id' => 12345678
        ]);

        Category::create([
            'name' => 'Categoria 2',
            'color'=> '52AB9E',
            'user_id' => 12345678
        ]);
    }
}
