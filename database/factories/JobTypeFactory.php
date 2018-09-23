<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\JobType::class, function (Faker $faker) {
	$types = [
		'tiempo completo',
		'medio tiempo'
	];

    return [
        'name' => $faker->randomElement($types)
    ];
});
