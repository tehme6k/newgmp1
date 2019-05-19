<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Product::create([
            'name' => 'Powder 1',
            'category_id' => 1,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Powder 2',
            'category_id' => 1,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Powder 3',
            'category_id' => 1,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Powder 4',
            'category_id' => 1,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Powder 5',
            'category_id' => 1,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Scoops 1',
            'category_id' => 4,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Scoops 2',
            'category_id' => 4,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Scoops 3',
            'category_id' => 4,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Bottle 1',
            'category_id' =>2,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Bottle 2',
            'category_id' =>2,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Bottle 3',
            'category_id' =>2,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Lid 1',
            'category_id' => 3,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Lid 2',
            'category_id' => 3,
            'created_by' => 1
        ]);

        Product::create([
            'name' => 'Lid 3',
            'category_id' => 3,
            'created_by' => 1
        ]);


    }
}
