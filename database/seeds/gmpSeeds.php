<?php

use Illuminate\Database\Seeder;

class gmpSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriesSeeder::class);
         $this->call(CountrySeeder::class);
         $this->call(ProductsSeeder::class);
         $this->call(ProjectsSeeder::class);
         $this->call(TypesSeeder::class);



    }
}
