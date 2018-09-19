<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use Illuminate\Http\Request;
use ReclutaTI\CandidateEducationHistory;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\EducationRequest;

class EducationController extends Controller
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
    public function store(EducationRequest $request)
    {
        $response;

        $candidateEducation = new CandidateEducationHistory();

        $candidateEducation->candidate_id = Auth::user()->candidate->id;
        $candidateEducation->school_name = strtolower($request->institucionEducativa);
        $candidateEducation->educative_level_id = $request->nivelEducativo;
        $candidateEducation->degree = $request->tituloObtenido;
        if ($request->has('descripcion')) {
            $candidateEducation->description = $request->descripcion;
        }
        $candidateEducation->current = ($request->estudiandoActualmente == 1) ? false : true;

        if ($candidateEducation->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito el historial educativo.'
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido gaurdar el historial educativo.',
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
    public function update(EducationRequest $request, $id)
    {
        $response;

        $candidateEducation = CandidateEducationHistory::find($id);

        if ($candidateEducation != null) {
            $candidateEducation->candidate_id = Auth::user()->candidate->id;
            $candidateEducation->school_name = strtolower($request->institucionEducativa);
            $candidateEducation->educative_level_id = $request->nivelEducativo;
            $candidateEducation->degree = $request->tituloObtenido;
            if ($request->has('descripcion')) {
                $candidateEducation->description = $request->descripcion;
            }
            $candidateEducation->current = ($request->estudiandoActualmente == 1) ? false : true;

            if ($candidateEducation->save()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha actualizado con éxito el historial educativo.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido actualizar el historial educativo.',
                    'error_code' => 'u0002'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'El historial a actualizar no esta registrado.',
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
        $response;

        $candidateEducation = CandidateEducationHistory::find($id);

        if ($candidateEducation != null) {
            if ($candidateEducation->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito el historial educativo.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar el historial educativo.',
                    'error_code' => 'd0001'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'El historial a eliminar no esta registrado.',
                'error_code' => 'd0002'
            ];
        }

        return response()->json($response);
    }
}
