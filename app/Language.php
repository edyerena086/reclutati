<?php

namespace ReclutaTI;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    /**
	 * [list description]
	 * @return [type] [description]
	 */
    public static function list()
    {
    	$elements = Language::all();

    	$list = [];

    	foreach ($elements as $element) {
    		$list[$element->id] = ucwords($element->name);
    	}

    	return $list;
    }
}
