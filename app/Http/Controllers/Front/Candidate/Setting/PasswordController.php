<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate\Setting;

use Auth;
use Notification;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Candidate\Settings\PasswordChange;
use ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Settings\PasswordRequest;

class PasswordController extends Controller
{
	/**
	 * [newPassword description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function newPassword(PasswordRequest $request)
    {
    	$response;

    	if ($request->currentPassword == Auth::user()->candidate->hash) {
    		//Save new password
    		Auth::user()->password = bcrypt($request->password);
            Auth::user()->candidate->hash = $request->password;

    		if (Auth::user()->save() && Auth::user()->candidate->save()) {
                Notification::send(Auth::user(), new PasswordChange(Auth::user()->name, $request->password));

    			$response = [
    				'errors' => false,
    				'message' => 'Se ha actualizado tu contraseña.'
    			];
    		} else {
    			$response = [
    				'errors' => true,
    				'message' => 'No se ha podido actualizar tu contraseña.',
    				'error_code' => 'p0002'
    			];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => 'Contraseña actual inválida.',
    			'error_code' => 'p0001'
    		];
    	}

    	return response()->json($response);
    }
}
