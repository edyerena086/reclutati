<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CandidateEducationHistory extends Model
{
    public function candidate()
    {
    	return $this->belongsTo('ReclutaTI\Candidate');
    }
}
