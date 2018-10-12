<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use ReclutaTI\Language;
use Illuminate\Http\Request;
use ReclutaTI\SearchCandidate;
use ReclutaTI\CandidateLanguage;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\LanguageRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\Language\StoreRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\Language\UpdateRequest;

class LanguageController extends Controller
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
        $candidateLanguages = CandidateLanguage::where('candidate_id', Auth::user()->candidate->id)->get();

        return response()->json($candidateLanguages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $candidateLanguage = new CandidateLanguage();

        $candidateLanguage->candidate_id = Auth::user()->candidate->id;
        $candidateLanguage->language_id = $request->idioma;
        $candidateLanguage->percent = $request->porcentaje;

        if ($candidateLanguage->save()) {
            $this->initSearchIndex();
            
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito el nuevo idioma.',
                'id' => $candidateLanguage->id,
                'percent' => $candidateLanguage->percent,
                'language_id' => $candidateLanguage->language_id,
                'url' => url('candidate/dashboard/curriculum/languages'),
                'language_name' => ucwords($candidateLanguage->language->where('id', $candidateLanguage->language_id)->first()->name)
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido guardar el idioma.',
                'error_code' => 's0001'
            ];
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response;

        $candidateLanguage = CandidateLanguage::find($id);

        if ($candidateLanguage != null) {
            $response = [
                'errors' => false,
                'data' => $candidateLanguage,
                'hasData' => true
            ];
        } else {
            $response = [
                'errors' => false,
                'data' => $candidateLanguage,
                'hasData' => false,
                'error_code' => 'e0001'
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $response;

        $candidateLanguage = CandidateLanguage::where('id', $id)->where('candidate_id', Auth::user()->candidate->id)->first();

        if ($candidateLanguage != null) {
            $candidateLanguage->language_id = $request->idioma;
            $candidateLanguage->percent = $request->porcentaje;

            if ($candidateLanguage->save()) {
                $this->initSearchIndex();

                $response = [
                    'errors' => false,
                    'message' => 'Se ha actualizado con éxito el idioma.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido actualizar el idioma.',
                    'error_code' => 'u0001'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'El idioma ha editar no esta registrado.',
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

        $candidateLanguage = CandidateLanguage::where('id', $id)->where('candidate_id', Auth::user()->candidate->id)->first();

        if ($candidateLanguage != null) {
            if ($candidateLanguage->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito el idioma.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar el idioma.',
                    'error_code' => 'd0002'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'El idioma ha eliminar no esta registrado.',
                'error_code' => 'd0001'
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

        $languages = CandidateLanguage::where('candidate_id', Auth::user()->candidate->id)->get();

        $insert = '';

        foreach ($languages as $language) {
            $insert .= Language::find($language->language_id)->name.' ';
        }

        $this->searchIndex->languages = $insert;
    }
}
