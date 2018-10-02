<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	public function companyContacts()
	{
		return $this->hasMany('\ReclutaTI\CompanyContact');
	}
}
