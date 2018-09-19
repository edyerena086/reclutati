<?php

use ReclutaTI\EducativeLevel;
use Illuminate\Database\Seeder;

class EducativeLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (EducativeLevel::all()->count() == 0) {
        	$levels = [
        		[
        			'name' => 'primaria'
        		],

        		[
        			'name' => 'secundaria'
        		],

        		[
        			'name' => 'preparatoria'
        		],

        		[
        			'name' => 'universidad'
        		]
        	];

        	foreach ($levels as $level) {
        		EducativeLevel::create($level);
        	}
        }
    }
}
