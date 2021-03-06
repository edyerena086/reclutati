<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Setting;

use Auth;
use Notification;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Candidate\Settings\NewEmail;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Settings\EmailRequest;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    public function update(EmailRequest $request)
    {
    	$response;

    	$user = Auth::user();
    	$user->email = $request->newEmail;

    	if ($user->candidate->hash == $request->password) {
    		if ($user->save()) {
	    		Notification::send(Auth::user(), new NewEmail($user));

	    		$response = [
	    			'errors' => false,
	    			'message' => 'Se ha actualizado con éxito tu cuenta de correo electrónico.',
	    			'resetForm' => true
	    		];
	    	} else {
	    		$response = [
	    			'errors' => true,
	    			'message' => 'No se ha podido actualiar tu cuenta de correo electrónico.',
	    			'error_code' => 'u0001'
	    		];
	    	}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'La contraseña es inválida.',
    			'error_code' => 'u0003'
    		];
    	}

    	return response()->json($response);
    }
}
