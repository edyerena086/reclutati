<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use ReclutaTI\Gender;
use ReclutaTI\Candidate;
use ReclutaTI\CivilStatus;
use Illuminate\Http\Request;
use ReclutaTI\SearchCandidate;
use Illuminate\Support\Facades\Storage;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\LaborGoalRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\GeneralInfoRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\ProfilePictureRequest;

class CurriculumController extends Controller
{
    private $searchIndex;

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

            if ($request->has('estadoCivil')) {
                $user->candidate->civil_status_id = $request->estadoCivil;
            }

    		if ($user->candidate->save()) {
                //Save in search index
                $this->initSearchIndex();

                $this->searchIndex->name = $user->name.' '.$user->candidate->last_name;

                //check age
                if ($request->has('edad')) {
                    $this->searchIndex->age = $request->edad;
                }

                //Check gender
                if ($request->has('genero')) {
                    $this->searchIndex->gender = Gender::find($request->genero)->name;
                }

                //Check civil status
                if ($request->has('estadoCivil')) {
                    $this->searchIndex->civil_status = CivilStatus::find($request->estadoCivil)->name;
                }

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
            $this->initSearchIndex();

            $this->searchIndex->labor_goal = $request->objetivoLaboral;

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

    /**
     * [profilePicture description]
     * @param  ProfilePictureRequest $request [description]
     * @return [type]                         [description]
     */
    public function profilePicture(ProfilePictureRequest $request)
    {
        $response;

        $fileName = rand(10000, 99999).'_profile.'.$request->file('imagenDePerfil')->getClientOriginalExtension();
        $folderName = 'candidates/'.Auth::user()->candidate->id;

        $request->file('imagenDePerfil')->storeAs($folderName, $fileName, 'public');

        $candidate = Candidate::find(Auth::user()->candidate->id);

        //Delete a file if exists
        if ($candidate->profile_picture != '') {
            Storage::disk('public')->delete($folderName.'/'.$candidate->profile_picture);
        }

        $candidate->profile_picture = $fileName;

        if ($candidate->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha actualizado con éxito tu imagen de perfil.',
                'image_url' => asset('storage/candidates/'.$candidate->id.'/'.$candidate->profile_picture)
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido actualizar tu imagen de perfil.',
                'error_code' => 'pp0001'
            ];
        }

        return response()->json($response);
    }

    /**
     * [initSearchIndex description]
     * @return [type] [description]
     */
    private function initSearchIndex()
    {
        $index = SearchCandidate::where('candidate_id', Auth::user()->candidate->id)->first();

        $this->searchIndex = ($index) ? $index : new SearchCandidate();
    }
}
