<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\EducativeLevel::class, function (Faker $faker) {
	$educativeLevels = [
		'primaria',
		'secundaria',
		'preparatoria',
		'universidad'
	];

    return [
        'name' => $faker->randomElement($educativeLevels)
    ];
});
