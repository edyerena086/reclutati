<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter\Dashboard;

use Auth;
use ReclutaTI\Vacancy;
use Illuminate\Http\Request;
use ReclutaTI\SearchVacancy;
use ReclutaTI\Library\Search;
use ReclutaTI\CandidateVacancy;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Recruiter\Dashboard\VacancyRequest;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('recruiter.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::where('recruiter_id', Auth::user()->recruiter->id)->orderBy('created_at', 'DESC')->with(['candidates'])->paginate(10);

        return view('front.recruiter.dashboard.vacancy.index', ['vacancies' => $vacancies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.recruiter.dashboard.vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $response;

        $vacancy = new Vacancy();

        $vacancy->recruiter_id = Auth::user()->recruiter->id;
        $vacancy->job_title = $request->puesto;
        $vacancy->job_small_description = $request->descripcionBreve;
        $vacancy->job_description = $request->descripcion;
        $vacancy->job_type_id = $request->tipoDeVacante;
        $vacancy->state_id = $request->estado;
        $vacancy->publish = ($request->publicar == 1) ? false : true;
        $vacancy->educative_level_id = $request->nivelEducativo;
        if ($request->has('salarioMinimo')) {
            $vacancy->salary_min = $request->salarioMinimo;
        }
        if ($request->has('salarioMaximo')) {
            $vacancy->salary_max = $request->salarioMaximo;
        }

        if ($vacancy->save() && Search::addVacancy($vacancy)) {
            $response = [
                'errors' => false,
                'message' => 'Se ha creado con éxito la vacante.',
                'create' => true
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido crear la vacante.',
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
        $vacancy = Vacancy::where('id', $id)->with(['recruiter.companyContact.companies', 'state', 'jobType', 'educativeLevel'])->first();

        if ($vacancy) {

            $vacancy = [
                'id' => $vacancy->id,
                'job_title' => $vacancy->job_title,
                'job_description' => $vacancy->job_description,
                'job_small_description' => $vacancy->job_small_description,
                'job_location' => $vacancy->state->name,
                'job_type' => $vacancy->jobType->name,
                'educative_level' => $vacancy->educativeLevel->name,
                'salary_min' => $vacancy->salary_min,
                'salary_max' => $vacancy->salary_max,
                'company_id' => $vacancy->recruiter->companyContact
                                                            ->companies
                                                            ->id,
                'company_name' => $vacancy->recruiter->companyContact
                                                            ->companies
                                                            ->name,
                'company_profile' => $vacancy->recruiter->companyContact
                                                            ->companies
                                                            ->profile_picture
            ];

            return view('front.static.vacancy.detail', ['vacancy' => $vacancy]);
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancy = Vacancy::find($id);

        if ($vacancy) {
            return view('front.recruiter.dashboard.vacancy.edit', ['vacancy' => $vacancy]);
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyRequest $request, $id)
    {
        $response;

        $vacancy = Vacancy::find($id);

        if ($vacancy) {
            $vacancy->job_title = $request->puesto;
            $vacancy->job_small_description = $request->descripcionBreve;
            $vacancy->job_description = $request->descripcion;
            $vacancy->job_type_id = $request->tipoDeVacante;
            $vacancy->state_id = $request->estado;
            $vacancy->publish = ($request->publicar == 1) ? false : true;
            $vacancy->educative_level_id = $request->nivelEducativo;
            if ($request->has('salarioMinimo')) {
                $vacancy->salary_min = $request->salarioMinimo;
            }
            if ($request->has('salarioMaximo')) {
                $vacancy->salary_max = $request->salarioMaximo;
            }

            if ($vacancy->save() && Search::updateVacancy($vacancy)) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha actualizado con éxito la vacante.',
                    'create' => false
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido actualizar la vacante.',
                    'error_code' => 'u0002'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'La vacante es inválida.',
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

        $vacancy = Vacancy::find($id);
        $searchVacancy = SearchVacancy::where('vacancy_id', $id)->first();

        if ($vacancy && $searchVacancy) {
            $relationships = CandidateVacancy::where('vacancy_id', $vacancy->id)->get();

            $relationships->each(function ($item) {
                $item->delete();
            });

            if ($vacancy->delete() && $searchVacancy->delete()) {
                $response = [
                    'errors' => false,
                    'message' => 'Se ha eliminado con éxito la vacante.'
                ];
            } else {
                $response = [
                    'errors' => true,
                    'message' => 'No se ha podido eliminar la vacante.',
                    'error_code' => 'd0002'
                ];
            }
        } else {
            $response = [
                'errors' => true,
                'message' => 'La vacante es inválida.',
                'error_code' => 'd0001'
            ];
        }

        return response()->json($response);
    }
}
