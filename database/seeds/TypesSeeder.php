<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Powder'
        ]);

        Type::create([
            'name' => 'Capsule'
        ]);

        Type::create([
            'name' => 'Powder Bulk'
        ]);

        Type::create([
            'name' => 'Capsule Bulk'
        ]);
    }
}
