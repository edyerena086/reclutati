<?php

namespace ReclutaTI\Http\Controllers\Back;

use ReclutaTI\User;
use ReclutaTI\Role;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$candidates = User::whereRoleId(Role::CANDIDATE)->orderBy('created_at', 'DESC')->with(['candidate'])->take(10)->get();

    	$recruiters = User::whereRoleId(Role::RECRUITER)->orderBy('created_at', 'DESC')->with(['recruiter'])->take(10)->get();

    	return view('back.dashboard.index', ['candidates' => $candidates, 'i' => 1, 'recruiters' => $recruiters]);
    }
}
