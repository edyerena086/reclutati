<?php

use ReclutaTI\JobType;
use Illuminate\Database\Seeder;

class JobTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
        	[
        		'name' => 'medio tiempo' 
        	],

        	[
        		'name' => 'tiempo completo' 
        	],

        	[
        		'name' => 'temporal' 
        	],

        	[
        		'name' => 'por proyecto' 
        	],

        	[
        		'name' => 'otro' 
        	]
        ];

        foreach ($types as $type) {
        	if (JobType::where('name', $type['name'])->first() == null) {
        		JobType::create($type);
        	}
        }
    }
}
