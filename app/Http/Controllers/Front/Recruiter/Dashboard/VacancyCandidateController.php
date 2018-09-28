<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Dashboard;

use ReclutaTI\Vacancy;
use ReclutaTI\Candidate;
use Illuminate\Http\Request;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Library\MessageSender;
use ReclutaTI\Http\Controllers\Controller;

class VacancyCandidateController extends Controller
{
	public function __construct()
    {
        $this->middleware('recruiter.auth');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index($id)
    {
    	$vacancy = Vacancy::where('id', $id)->with(['candidates.candidate.user'])->first();

    	if ($vacancy) {
    		$vacancyView = [];

    		$vacancyView['count'] = $vacancy->candidates->count();
    		$vacancyView['name'] = $vacancy->job_title;
    		$vacancyView['vacancy_id'] = $vacancy->id;

    		$candidateItem = [];
    		foreach ($vacancy->candidates as $candidate) {
    			$candidateItem[] = [
    				'id' => $candidate->candidate->id,
    				'name' => ucwords($candidate->candidate->user->name.' '.$candidate->candidate->last_name),
    				'profile_picture' => $candidate->candidate->profile_picture,
    				'email' => $candidate->candidate->user->email,
    				'cellphone' => $candidate->candidate->cellphone
    			];
    		}

    		$vacancyView['candidates'] = $candidateItem;

    		return view('front.recruiter.dashboard.vacancy.candidates.index', ['vacancy' => $vacancyView]);
    	} else {
    		return back();
    	}
    }

    public function remove($id, $vacancy)
    {
    	$response;

    	$candidate = Candidate::find($id);

    	if ($candidate) {
    		$vacancy = Vacancy::find($vacancy);

    		if ($vacancy) {
    			$record = CandidateVacancy::where('candidate_id', $id)->where('vacancy_id', $vacancy->id)->first();

    			if ($record) {
    				if ($record->delete()) {
    					$response = [
	    					'errors' => false,
	    					'message' => 'Se ha removido con éxito el candidato.',
	    					'candidateCounter' => ($vacancy->candidates->count() == 1) ? '1 Candidato' : $vacancy->candidates->count().' Candidatos' 
	    				];
    				} else {
    					$response = [
	    					'error' => true,
	    					'message' => 'No se ha podido remover el candidato de la vacante.',
	    					'error_code' => 'r0004'
	    				];
    				}
    			} else {
    				$response = [
    					'error' => true,
    					'message' => 'No hay nada que eliminar.',
    					'error_code' => 'r0003'
    				];
    			}
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'La vacante es inválida.',
    				'error_code' => 'r0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'El candidato es inválido.',
    			'error_code' => 'r0001'
    		];
    	}

    	return response()->json($response);
    }

    /**
     * [message description]
     * @param  MessageRequest $request   [description]
     * @param  [type]         $candidate [description]
     * @return [type]                    [description]
     */
    public function message(MessageRequest $request, $candidate)
    {
    	$response;

    	$candidate = Candidate::find($candidate);

    	if ($candidate) {
    		$sendMessage = MessageSender::send(Auth::user()->id, $candidate->user->id, $request->titulo, $request->mensaje);

    		if ($sendMessage) {
    			$response = [
    				'errors' => false,
    				'message' => 'Se ha enviado con éxito el mensaje.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido enviar el mensaje.',
    				'error_code' => 'm0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'El candidato es inválido.',
    			'error_code' => 'm0001'
    		];
    	}

    	return response()->json($response);
    }
}
