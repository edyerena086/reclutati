<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CandidateLanguage::class, function (Faker $faker) {
    return [
        'candidate_id' => factory(\ReclutaTI\Candidate::class)->create()->id,
        'language_id' => factory(\ReclutaTI\Language::class)->create()->id,
        'percent' => rand(1, 100)
    ];
});
