<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CandidateJobHistory::class, function (Faker $faker) {
    return [
        'candidate_id' => factory(\ReclutaTI\Candidate::class)->create()->id,
        'company_name' => $this->faker->company,
    	'job_title' => $this->faker->jobTitle,
    	'duration' => rand(1,3),
    	'description' => $this->faker->paragraph(),
    	'current' => (rand(1,2) == 1) ? false : true
    ];
});
