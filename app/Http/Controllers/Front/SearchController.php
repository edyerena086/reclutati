<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\JobType;
use ReclutaTI\SearchVacancy;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	$querySearch = $request->string.' '.$request->state;

    	$vacancies = SearchVacancy::search($querySearch)->where('publish', true);
    	$vacancyCount = $vacancies->count();
    	$vacancies->paginate(20);

    	return view('front.static.result', ['vacancies' => $vacancies, 'vacancyCount' => $vacancyCount, 'jobTypes' => JobType::all()]);
    }
}
