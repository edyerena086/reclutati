<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CandidateAddress::class, function (Faker $faker) {
    return [
        'candidate_id' => factory(\ReclutaTI\Candidate::class)->create()->id,
        'street' => $faker->streetName,
        'external_number' => rand(1000, 9999),
        'internal_number' => rand(1, 9),
        'colony' => $faker->streetName,
        'city' => $faker->city,
        'state_id' => factory(\ReclutaTI\State::class)->create()->id,
        'zipcode' => rand (10000, 99999)
    ];
});
