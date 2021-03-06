<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    function recruiter()
    {
    	return $this->hasOne('\ReclutaTI\Recruiter', 'id', 'recruiter_id');
    }

    function state()
    {
    	return $this->hasOne('\ReclutaTI\State', 'id', 'state_id');
    }

    function jobType()
    {
    	return $this->hasOne('\ReclutaTI\JobType', 'id', 'job_type_id');
    }

    function educativeLevel()
    {
        return $this->hasOne('\ReclutaTI\EducativeLevel', 'id', 'educative_level_id');
    }

    function candidates()
    {
        return $this->hasMany('\ReclutaTI\CandidateVacancy');
    }
}
