<?php

use ReclutaTI\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Language::all()->count() == 0) {
        	$languages = [
        		[
        			'name' => 'ingles'
        		],

        		[
        			'name' => 'frances'
        		],

        		[
        			'name' => 'italiano'
        		]
        	];

        	foreach ($languages as $language) {
        		Language::create($language);
        	}
        }
    }
}
