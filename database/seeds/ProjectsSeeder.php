<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name' => 'Psychotic',
            'type_id' => 1,
            'flavor' => 'Apple',
            'country_id' => 1,
            'created_by' => 1
        ]);

        Project::create([
            'name' => 'Psychotic',
            'type_id' => 1,
            'flavor' => 'Grape',
            'country_id' => 1,
            'created_by' => 1
        ]);

        Project::create([
            'name' => 'Insane Amino',
            'type_id' => 1,
            'flavor' => 'Apple',
            'country_id' => 1,
            'created_by' => 1
        ]);

        Project::create([
            'name' => 'Psychotic',
            'type_id' => 1,
            'flavor' => 'Rainbow Candy (Spartan)',
            'country_id' => 2,
            'created_by' => 1
        ]);
    }
}
