<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Curriculum;

use Auth;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\PhoneRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\SocialMediaRequest;

class ContactInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

	/**
	 * [phones description]
	 * @param  PhoneRequest $request [description]
	 * @return [type]                [description]
	 */
    public function phones(PhoneRequest $request)
    {
    	$response;

    	$candidate = Auth::user()->candidate;

    	$candidate->cellphone = $request->celular;

    	if ($request->has('telefonoFijo')) {
    		$candidate->phone = $request->telefonoFijo;
    	}

    	if ($candidate->save()) {
    		$response = [
    			'errors' => false,
    			'message' => 'Se ha actualizado con éxito los teléfonos.'
    		];
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'No se ha podido actualizar los teléfonos.',
    			'error_code' => 'p0001'
    		];
    	}

    	return response()->json($response);
    }

    /**
     * [socialMedia description]
     * @param  SocialMediaRequest $request [description]
     * @return [type]                      [description]
     */
    public function socialMedia(SocialMediaRequest $request)
    {
    	$response;

    	//Check if there is something to save
    	if ($request->has('website') || $request->has('facebook') || $request->has('twitter') || $request->has('linkedin')) {
    		$candidate = Auth::user()->candidate;

    		if ($request->has('website')) {
    			$candidate->website = $request->website;
    		}

    		if ($request->has('facebook')) {
    			$candidate->facebook = $request->facebook;
    		}

    		if ($request->has('twitter')) {
    			$candidate->twitter = $request->twitter;
    		}

    		if ($request->has('linkedin')) {
    			$candidate->linkedin = $request->linkedin;
    		}

    		if ($candidate->save()) {
    			$response = [
    				'errors' => false,
    				'message' => 'Se ha actualizado con éxito la información de tus redes sociales.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido actualizar la información de tus redes sociales.',
    				'error_code' => 'sm0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'No hay nada que actualizar.',
    			'error_code' => 'sm0001'
    		];
    	}

    	return response()->json($response);
    }
}
