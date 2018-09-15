<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use ReclutaTI\Gender;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\LaborGoalRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\GeneralInfoRequest;

class CurriculumController extends Controller
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
    	return view('front.candidate.dashboard.curriculum.index');
    }

    public function generalInfo(GeneralInfoRequest $request)
    {
    	$response;

    	$user = Auth::user();

    	$user->name = strtolower($request->primerNombre);

    	if ($user->save()) {
    		$user->candidate->second_name = ($request->has('segundoNombre')) ? strtolower($request->segundoNombre) : '';
    		$user->candidate->last_name = strtolower($request->apellidoPaterno);
    		$user->candidate->second_last_name = ($request->has('apellidoMaterno')) ? strtolower($request->apellidoMaterno) : '';

    		if ($request->has('edad')) {
    			$user->candidate->age = $request->edad;
    		}

    		if ($request->has('genero')) {
    			$user->candidate->gender_id = $request->genero;
    		}

    		if ($user->candidate->save()) {
    			$response = [
    				'errors' => false,
    				'message' => 'Se ha actualizado con éxito tu información'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido actualizar tu información',
    				'error_code' => 'gi0001'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'No se ha podido actualizar tu información',
    			'error_code' => 'gi0002'
    		];
    	}

    	return response()->json($response);
    }

    /**
     * [laborGoal description]
     * @param  LaborGoalRequest $request [description]
     * @return [type]                    [description]
     */
    public function laborGoal(LaborGoalRequest $request)
    {
    	$response;

    	$candidate = Auth::user()->candidate;

    	$candidate->labor_goal = $request->objetivoLaboral;

    	if ($candidate->save()) {
    		$response = [
    			'errors' => false,
    			'message' => 'Se ha actualizado con éxito tu objetivo laboral.'
    		];
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'No se ha podido actualizar tu objetivo laboral.',
    			'error_code' => 'lg0001'
    		];
    	}

    	return response()->json($response);
    }
}
