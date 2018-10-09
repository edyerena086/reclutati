<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    public function index()
    {
    	$appliedVacancies = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)
    									->where('status', 1)
    									->with(['vacancy.recruiter.companyContact.companies'])
    									->orderBy('created_at', 'DESC')
    									->take(5)
    									->get();

    	$savedVacancies = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)
    									->where('status', 2)
    									->with(['vacancy.recruiter.companyContact.companies'])
    									->orderBy('created_at', 'DESC')
    									->take(5)
    									->get();

    	return view('front.candidate.dashboard.index', ['appliedVacancies' => $appliedVacancies, 'savedVacancies' => $savedVacancies]);
    }
}
