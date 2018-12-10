<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class SystemModule extends Model
{
    public function children()
    {
    	return $this->hasMany('\ReclutaTI\SystemModule', 'parent');
    }
}
