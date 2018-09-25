<?php

namespace ReclutaTI\Http\Controllers\Front;

use Auth;
use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;

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
    	$vacancy = Vacancy::where('id', $id)->with(['recruiter'])->first();

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
