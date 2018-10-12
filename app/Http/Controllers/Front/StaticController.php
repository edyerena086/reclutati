<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\State;
use ReclutaTI\Vacancy;
use ReclutaTI\JobType;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function index()
    {
    	$states = State::list();
    	$jobTypes = JobType::list();

    	$vacanciesQuery = Vacancy::where('publish', true)->orderBy('created_at', 'DESC')
    						->with(['recruiter.companyContact.companies'])
    						->take(10)
    						->get();

    	$vacancies = [];

    	foreach ($vacanciesQuery as $vacancy ){
    		$createAt = $vacancy->created_at->diffInDays(\Carbon\Carbon::now());

    		$vacancies[] = [
    			'id' => $vacancy->id,
    			'job_title' => $vacancy->job_title,
    			'job_type' => $jobTypes[$vacancy->job_type_id],
    			'job_location' => $states[$vacancy->state_id],
    			'created_at' => ($createAt == 0) ? 1 : $createAt,
    			'company_id' => $vacancy->recruiter->companyContact
    													->companies
    													->id,
    			'company_name' => $vacancy->recruiter->companyContact
    													->companies
    													->name,
    			'company_profile' => $vacancy->recruiter->companyContact
    													->companies
    													->profile_picture
    		];
    	};

    	return view('front.static.index', ['vacancies' => $vacancies]);
    }

    public function privacy()
    {
        return view('front.static.privacy');
    }
}
