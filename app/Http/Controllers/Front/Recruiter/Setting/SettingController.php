<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Setting;

use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function __construct()
	{
		$this->middleware('recruiter.auth');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('front.recruiter.dashboard.settings.index');
    }
}
