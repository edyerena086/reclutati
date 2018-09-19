<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Setting;

use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class SettingController extends Controller
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
    	return view('front.candidate.dashboard.settings.index');
    }
}
