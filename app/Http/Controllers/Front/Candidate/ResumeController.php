<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use ReclutaTI\CandidateFile;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Resume\StoreRequest;

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
    public function store(StoreRequest $request)
    {
        $response;

        $record = new CandidateFile();

        $record->candidate_id = Auth::user()->candidate_id;

        if ($record->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito el nuevo archivo.'
            ];
        } else {
            $response = [
                'errors' => false,
                'message' => 'No se ha podido guardar el nuevo archivo.',
                'error_code' => 's0001'
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
        //
    }
}
