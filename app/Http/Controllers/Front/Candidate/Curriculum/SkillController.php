<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use ReclutaTI\SkillLevel;
use Illuminate\Http\Request;
use ReclutaTI\CandidateSkill;
use ReclutaTI\SearchCandidate;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\SkillRequest;

class SkillController extends Controller
{
    private $searchIndex;

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
    public function store(SkillRequest $request)
    {
        $response;

        $skill = new CandidateSkill();

        $skill->candidate_id = Auth::user()->candidate->id;
        $skill->skill = $request->habilidad;
        $skill->skill_level_id = $request->nivel;

        if ($skill->save()) {
            $this->initSearchIndex();
            
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito tu habilidad.',
                'id' => $skill->id,
                'skill' => $skill->skill,
                'skill_level_id' => $skill->skill_level_id,
                'callback_url' => url('candidate/dashboard/curriculum/skills')
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido crear tu habilidad.',
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
    public function update(SkillRequest $request, $id)
    {
        $response;

        $skill = CandidateSkill::find($id);

        if ($skill != null) {
            $skill->skill = $request->habilidad;
            $skill->skill_level_id = $request->nivel;

            if ($skill->save()) {
                $this->initSearchIndex();

                $response = [
                    'errors' => false,
                    'message' => 'Se ha actualizado con éxito tu habilidad.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido actualizar tu habilidad.',
                    'error_code' => 'u0001'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'La habilidad es inválida.',
                'error_code' => 'u0002'
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

        $skill = CandidateSkill::find($id);

        if ($skill != null) {
            if ($skill->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito tu habilidad.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar tu habilidad.',
                    'error_code' => 'u0001'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'La habilidad es inválida.',
                'error_code' => 'u0002'
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

        $skills = CandidateSkill::where('candidate_id', Auth::user()->candidate->id)->get();

        $insert = '';

        foreach ($skills as $skill) {
            $insert .= $skill->skill.' '.SkillLevel::find($skill->skill_level_id)->name.' ';
        }

        $this->searchIndex->skills = $insert;
    }
}
