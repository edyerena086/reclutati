<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function user()
    {
    	return $this->belongsTo('\ReclutaTI\User');
    }

    public function languages()
    {
    	return $this->hasMany('\ReclutaTI\CandidateLanguage');
    }

    public function educativeHistories()
    {
    	return $this->hasMany('\ReclutaTI\CandidateEducationHistory');
    }
}
