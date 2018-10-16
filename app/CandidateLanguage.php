<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguage extends Model
{
    public function candidate()
    {
    	return $this->belongsTo('ReclutaTI\Candidate');
    }

    public function language()
    {
    	return $this->belongsTo('\ReclutaTI\Language');
    }

    public function languageName()
    {
    	return $this->hasOne('\ReclutaTI\Language', 'id', 'language_id');
    }
}
