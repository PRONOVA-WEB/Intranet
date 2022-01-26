<?php

namespace Database\Seeders;

use App\Pharmacies\Category;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::Create([
            'name' => 'General'
        ]);
        Category::Create([
            'name' => 'Específica'
        ]);
    }
}
