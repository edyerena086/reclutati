<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class VacancyController extends Controller
{
    public function detail($id)
    {
    	$vacancy = Vacancy::where('id', $id)->with(['recruiter'])->first();

    	if ($vacancy) {
    		return view('front.static.vacancy.detail', ['vacancy' => $vacancy]);
    	} else {
    		return back();
    	}
    }
}
