<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Powder'
        ]);

        Category::create([
            'name' => 'Bottles'
        ]);

        Category::create([
            'name' => 'Lids'
        ]);

        Category::create([
            'name' => 'Scoops',
        ]);

        Category::create([
            'name' => 'Labels',
        ]);
    }
}
