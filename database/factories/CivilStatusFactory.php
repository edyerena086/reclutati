<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CivilStatus::class, function (Faker $faker) {
	$statuses = [
		'soltero(a)',
		'casado(a)'
	];

    return [
        'name' => $faker->randomElement($statuses)
    ];
});
