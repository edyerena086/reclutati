<?php

namespace ReclutaTI\Http\Controllers\Front;

use Auth;
use Notification;
use ReclutaTI\Vacancy;
use ReclutaTI\Recruiter;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Recruiter\Vacancy\CandidateApplied;

class VacancyController extends Controller
{
	public function __construct()
	{
		$this->middleware('candidate.auth')->only(['apply']);
	}

	/**
	 * [detail description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function detail($id)
    {
    	$vacancy = Vacancy::where('id', $id)->with(['recruiter.companyContact.companies', 'state', 'jobType', 'educativeLevel'])->first();

        $vacancy = [
            'id' => $vacancy->id,
            'job_title' => $vacancy->job_title,
            'job_description' => $vacancy->job_description,
            'job_location' => $vacancy->state->name,
            'job_type' => $vacancy->jobType->name,
            'educative_level' => $vacancy->educativeLevel->name,
            'salary_min' => $vacancy->salary_min,
            'salary_max' => $vacancy->salary_max,
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

        //dd($vacancy);

    	if ($vacancy) {
    		return view('front.static.vacancy.detail', ['vacancy' => $vacancy]);
    	} else {
    		return back();
    	}
    }

    /**
     * [apply description]
     * @param  VacancyApplyRequest $request [description]
     * @return [type]                       [description]
     */
    public function apply($id)
    {
    	$response;

    	$apply = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)->where('vacancy_id', $id)->first();
    	$vacancy = Vacancy::find($id);

    	if (!$apply && $vacancy) {
    		$apply = new CandidateVacancy();

    		$apply->candidate_id = Auth::user()->candidate->id;
    		$apply->vacancy_id = $id;

    		if ($apply->save()) {
                $recruiter = Recruiter::find($vacancy->recruiter_id);
                $recruiterName = ucwords($recruiter->user->name);
                $candidateName = ucwords(Auth::user()->name.' '.Auth::user()->candidate->last_name);

                Notification::send($recruiter->user, new CandidateApplied($recruiterName, $candidateName,  $vacancy->job_title));

    			$response = [
    				'errors' => false,
    				'message' => '¡Perfecto!, ya aplicaste para la vacante.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido aplicar tu solicitud a la vacante.',
    				'error_code' => 'a0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'Ya haz aplicado para la vacante.',
    			'error_code' => 'a0001'
    		];
    	}

    	return response()->json($response);
    }
}
