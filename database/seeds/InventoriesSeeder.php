<?php

use App\Inventory;
use Illuminate\Database\Seeder;

class InventoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Inventory::class, 200)->create()->each(function ($i){
            $i->make();
        });
    }
}
