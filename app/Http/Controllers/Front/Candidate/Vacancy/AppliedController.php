<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Vacancy;

use Auth;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;

class AppliedController extends Controller
{
    public function index()
    {
    	$vacancies = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)->where('status', 1)->with(['vacancy.recruiter.companyContact.companies'])->orderBY('created_at', 'DESC')->paginate(10);

    	return view('front.candidate.dashboard.vacancies.applied.index', ['vacancies' => $vacancies]);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
    	$response;

    	$candidateVacancy = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)->where('vacancy_id', $id)->first();

    	if ($candidateVacancy) {
    		if ($candidateVacancy->delete()) {
    			$response = [
    				'errors' => false,
    				'message' => 'Haz dejado de aplicar con éxito a la vacante.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido quitar la aplicacióna esa vacante.',
    				'error_code' => 'd0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'Vacante inválida.',
    			'error_code' => 'd0001'
    		];
    	}

    	return response()->json($response);
    }
}
