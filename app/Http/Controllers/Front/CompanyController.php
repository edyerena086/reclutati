<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\Company;
use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index($id)
    {
    	$company = Company::whereId($id)->with(['companyContacts.recruiters'])->first();

    	if ($company) {

    		$candidatesIds = [];
    		$centinel = 0;

    		foreach ($company->companyContacts as $item)
    		{
    			$candidatesIds[] = $item->recruiters->get($centinel)->id;

    			$centinel++;
    		}

    		$vacancies = Vacancy::whereIn('recruiter_id', $candidatesIds)->with(['state', 'jobType'])->orderBy('created_at', 'DESC')->take(10)->get();

    		return view('front.static.company', ['company' => $company, 'vacancies' => $vacancies]);
    	} else {
    		return back();
    	}
    }
}
