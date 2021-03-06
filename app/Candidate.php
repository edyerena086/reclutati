<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function user()
    {
    	return $this->hasOne('\ReclutaTI\User', 'id', 'user_id');
    }

    public function languages()
    {
    	return $this->hasMany('\ReclutaTI\CandidateLanguage');
    }

    public function educativeHistories()
    {
    	return $this->hasMany('\ReclutaTI\CandidateEducationHistory')->orderBy('educative_level_id', 'DESC');
    }

    public function address()
    {
        return $this->hasOne('\ReclutaTI\CandidateAddress');
    }

    public function jobHistories()
    {
        return $this->hasMany('\ReclutaTI\CandidateJobHistory')->orderBy('current', 'DESC');
    }

    public function skills()
    {
        return $this->hasMany('\ReclutaTI\CandidateSkill');
    }

    public function socialLogin()
    {
        return $this->hasOne('\ReclutaTI\CandidateSocialLogin');
    }

    public function vacancies()
    {
        return $this->hasMany('\ReclutaTI\CandidateVacancy');
    }

    public function files()
    {
        return $this->hasMany('\ReclutaTI\CandidateFile');
    }
}
