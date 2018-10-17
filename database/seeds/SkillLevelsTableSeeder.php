<?php

use ReclutaTI\SkillLevel;
use Illuminate\Database\Seeder;

class SkillLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
        	[
        		'name' => 'junior'
        	],

        	[
        		'name' => 'mid-senior'
        	],

        	[
        		'name' => 'senior'
        	]
        ];

        foreach ($skills as $skill) {
        	if (SkillLevel::where('name', $skill['name'])->first() == null) {
        		SkillLevel::create($skill);
        	}
        }
    }
}
