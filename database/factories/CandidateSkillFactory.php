<?php

use Faker\Generator as Faker;

$factory->define(ReclutaTI\CandidateSkill::class, function (Faker $faker) {
    return [
        'candidate_id' => factory(\ReclutaTI\Candidate::class)->create()->id,
        'skill' => 'PHP',
        'skill_level_id' => factory(\ReclutaTI\SkillLevel::class)->create()->id
    ];
});
