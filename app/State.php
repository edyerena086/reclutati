<?php

namespace ReclutaTI;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use Searchable;

    /**
	 * [list description]
	 * @return [type] [description]
	 */
    public static function list()
    {
    	$elements = State::all();

    	$list = [];

    	foreach ($elements as $element) {
    		$list[$element->id] = ucwords($element->name);
    	}

    	return $list;
    }
}
