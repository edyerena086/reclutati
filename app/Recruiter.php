<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
	public function user()
	{
		return $this->hasOne('\ReclutaTI\User', 'id', 'user_id');
	}

    public function vacancies()
    {
    	return $this->hasMany('\ReclutaTI\Vacancy')->orderBy('created_at', 'DESC');
    }

    public function companyContact()
    {
    	return $this->hasOne('\ReclutaTI\CompanyContact');
    }
}
