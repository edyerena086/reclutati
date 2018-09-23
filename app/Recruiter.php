<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
	public function user()
	{
		return $this->belongsTo('\ReclutaTI\User');
	}

    public function vacancies()
    {
    	return $this->hasMany('\ReclutaTI\Vacancy')->orderBy('created_at', 'DESC');
    }
}
