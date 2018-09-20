<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\State::class, function (Faker $faker) {
	$states = [
		'nuevo león',
		'jalisco',
		'ciudad de méxico'
	];

    return [
       'name' => $faker->randomElement($states)
    ];
});
