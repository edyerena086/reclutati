<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CandidateEducationHistory::class, function (Faker $faker) {
    return [
    	'candidate_id' => factory(\ReclutaTI\Candidate::class)->create()->id,
        'school_name' => $faker->company,
        'educative_level_id' => factory(\ReclutaTI\EducativeLevel::class)->create()->id,
        'degree' => $faker->titleMale,
        'description' => $faker->paragraph(),
        'current' => (rand(1,2) == 1) ? false : true
    ];
});
