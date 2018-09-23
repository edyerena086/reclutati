<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter;

use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('recruiter.auth');
	}

    public function index()
    {
    	return view('layouts.front.recruiter');
    }
}
