<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter;

use DB;
use Auth;
use ReclutaTI\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\CompanyRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\CompanyProfilePictureRequest;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('recruiter.auth');
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
    {
    	return view('front.recruiter.dashboard.index');
    }

    /**
     * [companyProfilePicture description]
     * @param  companyProfilePicture $request [description]
     * @return [type]                         [description]
     */
    public function companyProfilePicture(CompanyProfilePictureRequest $request)
    {
    	$response;

    	$recruiter = Auth::user()->recruiter;
    	$company = Company::find($recruiter->companyContact->companies->first()->id);

    	$fileName = rand(10000, 99999).'_profile.'.$request->file('imagenDePerfil')->getClientOriginalExtension();
        $folderName = 'recruiter/companies/'.$company->id;

        $request->file('imagenDePerfil')->storeAs($folderName, $fileName, 'public');

        //Delete a file if exists
        if ($company->profile_picture != '') {
            Storage::disk('public')->delete($folderName.'/'.$company->profile_picture);
        }

        $company->profile_picture = $fileName;

        if ($company->save()) {
        	$response = [
        		'errors' => false,
        		'message' => 'Se ha actualizado con éxito la imagen de perfil.',
        		'image_url' => asset('storage/'.$folderName.'/'.$fileName)
        	];
        } else {
        	$response = [
        		'errors' => false,
        		'message' => 'No se ha podido actualizar ´la imagen de perfil.',
        		'error_code' => 'cpi0001'
        	];
        }

        return response()->json($response);
    }

    /**
     * [company description]
     * @param  CompanyRequest $request [description]
     * @return [type]                  [description]
     */
    public function company(CompanyRequest $request)
    {
    	$response;

    	$recruiter = Auth::user()->recruiter;
    	$company = Company::find($recruiter->companyContact->companies->first()->id);

        $company->name = $request->empresa;
        if ($request->has('acercaDe')) {
        	$company->about = $request->acercaDe;
        }

        $recruiter->validation_phone = $request->telefono;


        DB::beginTransaction();

        	try {
        		$recruiter->save();
        		$company->save();

        		$response = [
        			'errors' => false,
        			'message' => 'Se ha actualizado con éxito la información de tu empresa.'
        		];
        	} catch(Exception $e) {
        		DB::rollBack();

        		$response = [
        			'errors' => true,
        			'message' => 'No se ha podido actualizar la información de tu empresa.',
        			'error_code' => 'c0001'
        		];

        		return response()->json($response);
        	}

        DB::commit();

        return response()->json($response);

    }
}
