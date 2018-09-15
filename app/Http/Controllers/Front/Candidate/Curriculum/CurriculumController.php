<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use ReclutaTI\Gender;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class CurriculumController extends Controller
{
	public function __construct()
	{
		$this->middleware('candidate.auth');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('front.candidate.dashboard.curriculum.index', ['genders' => $this->renderList(Gender::all())]);
    }

    /**
     * [renderList description]
     * @param  [type] $object [description]
     * @return [type]         [description]
     */
    private function renderList($object)
    {
    	$list = [];
    	
    	foreach ($object as $item) {
    		$list[$item->id] = ucwords($item->name); 
    	}

    	return $list;
    }
}
