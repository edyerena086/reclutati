<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use ReclutaTI\CandidateFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\ResumeRequest;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = CandidateFile::where('candidate_id', Auth::user()->candidate->id)->orderBy('created_at')->get();

        return view('front.candidate.resume.index', ['resumes' => $resumes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResumeRequest $request)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = CandidateFile::find($id);

        $response;

        if ($file != null) {
            $folderName = 'candidates/'.Auth::user()->candidate->id.'/resumes';
            Storage::disk('public')->delete($folderName.'/'.$file->file);

            if ($file->delete()) {
                $howMuchFile = Auth::user()->candidate->files->count();
                
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito el archivo.',
                    'file_count' => $howMuchFile
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
}
