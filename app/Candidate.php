<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function user()
    {
    	return $this->belongsTo('\ReclutaTI\User');
    }
}
