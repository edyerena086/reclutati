<?php

namespace ReclutaTI\Http\Controllers\Back\Catalog;

use ReclutaTI\Language;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Back\Dashboard\Catalog\LanguageRequest;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('back.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.dashboard.catalog.language.index', ['languages' => Language::all(), 'i' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.dashboard.catalog.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $response;

        $languaje = new Language();

        $languaje->name = $request->idioma;

        if ($languaje->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha guardado con éxito el nuevo idioma.'
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido guardar el nuevo idioma.'
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
