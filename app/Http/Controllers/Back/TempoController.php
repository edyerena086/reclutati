<?php

namespace ReclutaTI\Http\Controllers\Back;

use ReclutaTI\User;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class TempoController extends Controller
{
    public function candidates()
    {
    	$candidates = User::whereRoleId(\ReclutaTI\Role::CANDIDATE)->get();

    	return 'Total de candidatos: '.$candidates->count();
    }

    public function recruiters()
    {
    	$recruiters = User::whereRoleId(\ReclutaTI\Role::RECRUITER)->get();

    	return 'Total de candidatos: '.$recruiters->count();
    }
}
