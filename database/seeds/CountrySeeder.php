<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'United States',
            'abr' => 'US',
            'created_by' => 1
        ]);

        Country::create([
            'name' => 'Austrailia',
            'abr' => 'AU',
            'created_by' => 1
        ]);
    }
}
