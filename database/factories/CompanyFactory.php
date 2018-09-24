<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'profile_picture' => 'random-image.jpg',
        'about' => $faker->text(150)
    ];
});
