<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Dashboard;

use ReclutaTI\Candidate;
use Illuminate\Http\Request;
use ReclutaTI\SearchCandidate;
use ReclutaTI\Http\Controllers\Controller;

class CandidateController extends Controller
{
	public function __construct()
	{
		$this->middleware('candidate.auth')->only(['apply']);
	}

	/**
	 * [search description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function search(Request $request)
    {
    	$querySearch = $request->string.' '.$request->state;

    	$candidates = SearchCandidate::search($querySearch)->paginate(20);

    	return view('front.recruiter.dashboard.candidate.search', ['candidates' => $candidates]);
    }

    /**
     * [detail description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function detail($id)
    {
    	$candidate = Candidate::findOrFail($id);

    	return view('front.recruiter.dashboard.candidate.detail', ['candidate' => $candidate]);
    }
}
