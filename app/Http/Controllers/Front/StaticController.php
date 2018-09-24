<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function index()
    {
    	$vacancies = Vacancy::where('publish', true)->orderBy('created_at', 'DESC')->take(10)->get();

    	return view('front.static.index', ['vacancies' => $vacancies]);
    }
}
