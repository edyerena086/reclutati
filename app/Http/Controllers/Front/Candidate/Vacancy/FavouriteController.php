<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Vacancy;

use Auth;
use Notification;
use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Recruiter\Vacancy\CandidateApplied;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
    	$vacancies = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)->where('status', 2)->with(['vacancy.recruiter.companyContact.companies'])->orderBY('created_at', 'DESC')->paginate(10);

    	return view('front.candidate.dashboard.vacancies.favourite.index', ['vacancies' => $vacancies]);
    }

    /**
     * [apply description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function apply($id)
    {
    	$response;

    	$candidateVacancy = CandidateVacancy::where('candidate_id', Auth::user()->candidate->id)->where('vacancy_id', $id)->first();

    	if ($candidateVacancy) {
    		$candidateVacancy->status = 1;

    		if ($candidateVacancy->save()) {
                $vacancy = Vacancy::whereId($id)->with(['recruiter.user'])->first();
                $recruiter = $vacancy->recruiter;
                $recruiterName = ucwords($recruiter->user->name);
                $candidateName = ucwords(Auth::user()->name. ' '.Auth::user()->candidate->last_name);

                Notification::send($recruiter->user, new CandidateApplied($recruiterName, $candidateName,  $vacancy->job_title));

    			$response = [
	    			'errors' => false,
	    			'message' => 'Haz aplicado correctamente a la vacante.',
	    			'error_code' => 'a0002'
	    		];
    		} else {
    			$response = [
	    			'errors' => true,
	    			'message' => 'No haz podido aplicar a esta vacante.',
	    			'error_code' => 'a0002'
	    		];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'Vacante inválida.',
    			'error_code' => 'a0001'
    		];
    	}

    	return response()->json($response);
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
    				'message' => 'Se ha eliminado con éxito a la vacante.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido eliminar la vacante.',
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
