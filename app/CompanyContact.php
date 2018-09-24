<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    public function companies()
    {
    	return $this->belongsTo('\ReclutaTI\Company', 'company_id', 'id');
    }
}
