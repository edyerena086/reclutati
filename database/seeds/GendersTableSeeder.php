<?php

use ReclutaTI\Gender;
use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Gender::all()->count() == 0) {
        	$genders = [
        		[
        			'name' => 'femenino'
        		],

        		[
        			'name' => 'masculino'
        		],

        		[
        			'name' => 'otro'
        		]
        	];

        	foreach ($genders as $gender) {
        		Gender::create($gender);
        	}
        }
    }
}
