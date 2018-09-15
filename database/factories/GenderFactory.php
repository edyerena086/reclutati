<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\Gender::class, function (Faker $faker) {
	$genders = [
		'femenino',
		'masculino',
		'otro'
	];

    return [
        'name' => $faker->randomElement($genders)
    ];
});
