<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CompanyContact::class, function (Faker $faker) {
	$boolean = (rand(1, 2) == 1) ? true : false;

    return [
        'company_id' => factory(\ReclutaTI\Company::class)->create()->id,
        'recruiter_id' => factory(\ReclutaTI\Recruiter::class)->create()->id,
        'main_contact' => $boolean
    ];
});
