<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use Illuminate\Http\Request;
use ReclutaTI\CandidateJobHistory;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\JobHistoryRequest;

class JobHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobHistoryRequest $request)
    {
        $response;

        $jobHistory = new CandidateJobHistory();

        $jobHistory->candidate_id = Auth::user()->candidate->id;
        $jobHistory->company_name = $request->empresa;
        $jobHistory->job_title = $request->puesto;
        $jobHistory->duration = $request->duracion;
        $jobHistory->description = $request->descripcion;
        $jobHistory->current = ($request->trabajoActual == 2) ? true : false;

        if ($jobHistory->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito el historial laboral.',
                'id' => $jobHistory->id,
                'company' => ucwords($jobHistory->company_name),
                'job_title' => $jobHistory->job_title,
                'duration' => $jobHistory->duration,
                'description' => $jobHistory->description,
                'current' => ($jobHistory->current == true) ? 1 : 0,
                'callback_url' => url('candidate/dashboard/curriculum/job-histories')
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido guardar el historial laboral. ',
                'error_code' => 's0001'
            ];
        }

        return response()->json($response);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobHistoryRequest $request, $id)
    {
        $response;

        $jobHistory = CandidateJobHistory::where('id', $id)->where('candidate_id', Auth::user()->candidate->id)->first();

        if ($jobHistory != null) {
            $jobHistory->company_name = $request->empresa;
            $jobHistory->job_title = $request->puesto;
            $jobHistory->duration = $request->duracion;
            $jobHistory->description = $request->descripcion;
            $jobHistory->current = ($request->trabajoActual == 2) ? true : false;

            if ($jobHistory->save()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha actualizado con éxito el historial laboral.',
                    'id' => $jobHistory->id,
                    'company' => ucwords($jobHistory->company_name),
                    'job_title' => $jobHistory->job_title,
                    'duration' => $jobHistory->duration,
                    'description' => $jobHistory->description,
                    'current' => ($jobHistory->current == true) ? 1 : 0,
                    'callback_url' => url('candidate/dashboard/curriculum/job-histories')
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido actualizar el historial laboral. ',
                    'error_code' => 'u0002'
                ];
            }
        } else {
            $response =[
                'errors' => true,
                'message' => 'El historial laboral no existe.',
                'error_code' => 'u0001'
            ];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobHistory = CandidateJobHistory::where('id', $id)->where('candidate_id', Auth::user()->candidate->id)->first();

        if ($jobHistory != null) {
            if ($jobHistory->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito el historial laboral.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar el historial laboral. ',
                    'error_code' => 'd0002'
                ];
            }
        } else {
            $response =[
                'errors' => true,
                'message' => 'El historial laboral no existe.',
                'error_code' => 'u0001'
            ];
        }

        return response()->json($response);
    }
}
