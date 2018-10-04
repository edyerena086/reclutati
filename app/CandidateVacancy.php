<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CandidateVacancy extends Model
{
    public function candidate()
    {
    	return $this->hasOne('\ReclutaTI\Candidate', 'id', 'candidate_id');
    }

    public function vacancy()
    {
    	return $this->hasOne('\ReclutaTI\Vacancy', 'id', 'vacancy_id');
    }
}
