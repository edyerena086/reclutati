<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Vacancy::class, function (Faker $faker) {
    return [
        'recruiter_id' => factory(\ReclutaTI\Recruiter::class)->create()->id,
        'job_title' => $faker->jobTitle,
        'job_small_description' => $faker->text(200),
        'job_description' => $faker->text(1000),
        'job_type_id' => factory(\ReclutaTI\JobType::class)->create()->id,
        'state_id' => factory(\ReclutaTI\State::class)->create()->id,
        'publish' => true,
        'salary_min' => rand(10000, 40000),
        'salary_max' => rand(40000, 60000),
        'educative_level_id' => factory(\ReclutaTI\EducativeLevel::class)->create()->id
    ];
});
