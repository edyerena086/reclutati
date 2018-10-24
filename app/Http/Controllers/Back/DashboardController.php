<?php

namespace ReclutaTI\Http\Controllers\Back;

use ReclutaTI\User;
use ReclutaTI\Role;
use ReclutaTI\Recruiter;
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

    	$recruiters = Recruiter::where('validation_phone', '!=', '8116362986')->orderBy('created_at', 'DESC')->with(['user'])->take(10)->get();

    	return view('back.dashboard.index', ['candidates' => $candidates, 'i' => 1, 'recruiters' => $recruiters]);
    }
}
