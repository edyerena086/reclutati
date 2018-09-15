<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Candidate::class, function (Faker $faker) {
    return [
        'user_id' => factory(\ReclutaTI\User::class)->create(['role_id' => 1])->id,
        'second_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'second_last_name' => $faker->lastName,
    ];
});
