<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    function recruiter()
    {
    	return $this->belongsTo('\ReclutaTI\Recruiter');
    }

    function state()
    {
    	return $this->belongsTo('\ReclutaTI\State');
    }

    function jobType()
    {
    	return $this->belongsTo('\ReclutaTI\JobType');
    }

    function educativeLevel()
    {
        return $this->belongsTo('\ReclutaTI\EducativeLevel');
    }
}
