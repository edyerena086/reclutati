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
        		],

                [
                    'name' => 'aleman'
                ],

                [
                    'name' => 'japones'
                ],

                [
                    'name' => 'árabe'
                ],

                [
                    'name' => 'hindi'
                ],

                [
                    'name' => 'portugués'
                ],

                [
                    'name' => 'ruso'
                ],

                [
                    'name' => 'otro'
                ]
        	];

        	foreach ($languages as $language) {
                if (Language::where('name', $language['name'])->first() == null) {
                    Language::create($language);
                }
        	}
        }
    }
}
