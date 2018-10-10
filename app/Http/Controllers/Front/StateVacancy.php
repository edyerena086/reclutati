<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\State;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class StateVacancy extends Controller
{
    public function states()
    {
    	$states = State::orderBy('name', 'ASC')->with(['vacancies'])->get();

    	return view('front.static.vacancy.state', ['states' => $states]);
    }

    public function state($id)
    {
    	$state = State::findOrFail($id);

    	return view('front.static.vacancy.individual', ['state' => $state]);
    }
}
