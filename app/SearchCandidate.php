<?php

namespace ReclutaTI;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class SearchCandidate extends Model
{
    use Searchable;

    public function candidate()
    {
    	return $this->hasOne('\ReclutaTI\Candidate', 'id', 'candidate_id');
    }
}
