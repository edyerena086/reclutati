<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Dashboard;

use Auth;
use Notification;
use ReclutaTI\Vacancy;
use ReclutaTI\Candidate;
use Illuminate\Http\Request;
use ReclutaTI\CandidateFile;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Library\MessageSender;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Recruiter\Message\NewMessage;
use ReclutaTI\Http\Requests\Front\Recruiter\Dashboard\Message\MessageRequest;

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
    				'cellphone' => $candidate->candidate->cellphone,
            'file' => CandidateVacancy::where('candidate_id', $candidate->candidate->id)->where('vacancy_id', $vacancy->id)->first()->candidate_file_id
    			];
    		}

    		$vacancyView['candidates'] = $candidateItem;

            /*if (!is_null($resume)) {
                $resumeFile = CandidateFile::findOrFail($resume);

                $vacancyView['resume'] = $resumeFile->file;
            }*/

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
    		$sendMessage = MessageSender::send(Auth::user()->id, $candidate->user->id, $request->title, $request->message);

    		if ($sendMessage) {
                $message = $request->message;
								$recruiterName = ucwords(Auth::user()->name.' '.Auth::user()->recruiter->last_name);
								$companyName = Auth::user()->recruiter->companyContact->companies->name;
                $candidateName = ucwords($candidate->user->name);

                Notification::send($candidate->user, new NewMessage($recruiterName, $candidateName, $companyName, $message));

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
