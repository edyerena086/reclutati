<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Recruiter::class, function (Faker $faker) {
    return [
        'user_id' => factory(\ReclutaTI\User::class)->create(['role_id' => \ReclutaTI\Role::RECRUITER])->id,
        'second_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'second_last_name' => $faker->lastName,
        'validation_phone' => '20921234',
        'hash' => 'secret'
    ];
});
