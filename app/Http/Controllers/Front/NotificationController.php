<?php

namespace ReclutaTI\Http\Controllers\Front;

use Auth;
use ReclutaTI\User;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * [markAsRead description]
	 * @param  [type] $user     [description]
	 * @param  [type] $noty     [description]
	 * @param  [type] $callback [description]
	 * @return [type]           [description]
	 */
    public function markAsRead(Request $request, $user, $noty, $callback = null)
    {
    	$user = User::findOrFail($user);

    	$notification = $user->notifications()->where('id', $noty)->first();

    	if ($notification) {
    		$notification->markAsRead();

    		if (!is_null($callback)) {
    			$callback = url($notification->data['url']);
    		}

    		if ($request->ajax()) {
    			$response = [
    				'errors' => false,
    				'markAsRead' => true,
                    'message' => 'Se ha marcado con éxito la notificación como leída.'
    			];

                return response()->json($response);
    		} else {
    			return redirect()->intended($callback);
    		}
    	} else {
    		if ($request->ajax()) {
    			$response = [
    				'errors' => true,
    				'message' => 'La notificación es inválida.',
    				'error_code' => 'n0001'
    			];

    			return response()->json($response);
    		} else {
    			return back();
    		}
    	}
    }

    /**
     * [allMarkAsRead description]
     * @return [type] [description]
     */
    public function allMarkAsRead()
    {
        $response;

        Auth::user()->unreadNotifications->markAsRead();

        $response = [
            'errors' => false,
            'message' => 'Se ha marcado con éxito todas las notificaciones.'
        ];

        return response()->json($response);
    }
}
