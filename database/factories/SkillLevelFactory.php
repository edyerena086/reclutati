<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\SkillLevel::class, function (Faker $faker) {
	$skillLevels = [
		'junior',
		'mid senior',
		'senior'
	];

    return [
        'name' => $faker->randomElement($skillLevels)
    ];
});
