<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Dashboard;

use Auth;
use ReclutaTI\Company;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct()
    {
    	$this->middleware('recruiter.auth');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	$company = Company::findOrFail(Auth::user()->recruiter->companyContact->company_id);

    	return view('front.recruiter.dashboard.company.index', ['company' => $company]);
    }
}
