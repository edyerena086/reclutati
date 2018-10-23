<?php

namespace ReclutaTI\Http\Controllers\Back;

use ReclutaTI\User;
use ReclutaTI\Vacancy;
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

    public function vacancies()
    {
        $vacancies = Vacancy::where('publish', true)->get();

        return 'Total de vacantes publicadas: '.$vacancies->count();
    }
}
