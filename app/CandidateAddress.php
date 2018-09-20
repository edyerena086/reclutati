<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CandidateAddress extends Model
{
    public function candidate()
    {
    	return $this->belongsTo('\ReclutaTI\Candidate');
    }
}
