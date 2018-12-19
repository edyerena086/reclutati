<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use Image;
use ReclutaTI\Gender;
use ReclutaTI\Candidate;
use ReclutaTI\CivilStatus;
use Illuminate\Http\Request;
use ReclutaTI\CandidateFile;
use ReclutaTI\SearchCandidate;
use Illuminate\Support\Facades\Storage;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\ResumeRequest;
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

                //Save in search
                $this->searchIndex->save();

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

            //Save in search
            $this->searchIndex->save();

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

        //Save thumbnail
        $thumnailPath = public_path('uploads/'.$folderName);
        if (is_dir($thumnailPath)) {
            //Delete previous image
            array_map('unlink', glob($thumnailPath."/*.*"));
            rmdir($thumnailPath);
        }
        mkdir($thumnailPath);
        $thumbnail = Image::make($request->file('imagenDePerfil'));
        $thumbnail->resize(200, 200)->save($thumnailPath.'/'.$fileName);

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
                'image_url' => asset('uploads/candidates/'.$candidate->id.'/'.$candidate->profile_picture)
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
     * [uploadResume description]
     * @param  ResumeRequest $request [description]
     * @return [type]                 [description]
     */
    public function uploadResume(ResumeRequest $request)
    {
        $response;

        $record = new CandidateFile();

        $fileName = rand(100000, 999999).'_cv.'.$request->file('resume')->getClientOriginalExtension();
        $filePublicName = $request->file('resume')->getClientOriginalName();
        $folderName = 'candidates/'.Auth::user()->candidate->id.'/resumes';

        $request->file('resume')->storeAs($folderName, $fileName, 'public');

        $record->candidate_id = Auth::user()->candidate->id;
        $record->file = $fileName;
        $record->file_public_name = $filePublicName;

        if ($record->save()) {
            $howMuchFile = Auth::user()->candidate->files->count();

            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito tu CV.',
                'file_name' => $filePublicName,
                'file_id' => $record->id,
                'file_url' => url('storage/candidates/'.Auth::user()->candidate->id.'/resumes/'.$record->file),
                'delete_upload_button' => ($howMuchFile == 3) ? true : false,
                'file_count' => $howMuchFile
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido guardar tu CV.',
                'error_code' => 'cvu0001'
            ];
        }

        return response()->json($response);
    }

    /**
     * [deleteResume description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteResume($id)
    {
        $file = CandidateFile::find($id);

        $response;

        if ($file != null) {
            $folderName = 'candidates/'.Auth::user()->candidate->id.'/resumes';
            Storage::disk('public')->delete($folderName.'/'.$file->file);

            if ($file->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito el archivo.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar el archivo.',
                    'error_code' => 'dr0002'
                ];
            }
            
        } else {
            $response = [
                'errors' => true,
                'message' => 'El archivo a eliminar no existe.',
                'error_code' => 'dr0001'
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

        $this->searchIndex->candidate_id = Auth::user()->candidate->id;
    }
}
