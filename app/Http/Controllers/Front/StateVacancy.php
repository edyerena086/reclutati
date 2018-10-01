<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\State;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class StateVacancy extends Controller
{
    public function states()
    {
    	$states = State::orderBy('name', 'ASC');

    	return view('front.static.vacancy.state', ['states' => $states]);
    }
}
