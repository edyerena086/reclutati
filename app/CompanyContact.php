<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    public function companies()
    {
    	return $this->hasOne('\ReclutaTI\Company', 'id', 'company_id');
    }

    public function recruiters()
    {
    	return $this->hasOne('\ReclutaTI\Recruiter', 'id', 'recruiter_id');
    }
}
