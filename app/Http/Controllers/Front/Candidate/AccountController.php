<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use Session;
use Socialite;
use Notification;
use ReclutaTI\User;
use ReclutaTI\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use ReclutaTI\CandidateSocialLogin;
use Illuminate\Support\Facades\Mail;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Mail\Candidate\Account\Welcome;
use ReclutaTI\Http\Requests\Front\Candidate\Account\LoginRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Account\StoreRequest;
use ReclutaTI\Notifications\Front\Candidate\Account\PasswordReset;
use ReclutaTI\Http\Requests\Front\Candidate\Account\PasswordResetRequest;
use ReclutaTI\Http\Requests\Front\Candidate\Account\PasswordRecoverRequest;

class AccountController extends Controller
{
	private $storeErrorMessage = "No se ha podido crear tu cuenta en ReclutaTI";

	public function __construct()
	{
		$this->middleware('candidate.guest')->except(['logout']);

		$this->middleware('candidate.auth')->only(['logout']);
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		return view('front.candidate.account.index');
	}

	/**
	 * [login description]
	 * @param  LoginRequest $request [description]
	 * @return [type]                [description]
	 */
	public function login(LoginRequest $request)
	{
		$remember = ($request->has('remember')) ? true : false;

		$credentials = [
			'email' => $request->correoElectronico,
			'password' => $request->password,
			'role_id' => \ReclutaTI\Role::CANDIDATE
		];

		if (Auth::attempt($credentials, $remember)) {
			return redirect()->intended('candidate/dashboard');
		} else {
			return back()->withErrors(['loginError']);
		}
	}

    /**
     * [getLoginVacancy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getLoginVacancy($id)
    {
        return view('front.candidate.account.login-vacancy', ['id' => $id]);
    }

    /**
     * [login description]
     * @param  LoginRequest $request [description]
     * @return [type]                [description]
     */
    public function postLoginVacancy(LoginRequest $request, $id)
    {
        $remember = ($request->has('remember')) ? true : false;

        $credentials = [
            'email' => $request->correoElectronico,
            'password' => $request->password,
            'role_id' => \ReclutaTI\Role::CANDIDATE
        ];

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('vacante/'.$id);
        } else {
            return back()->withErrors(['loginError']);
        }
    }

	/**
	 * [create description]
	 * @return [type] [description]
	 */
	public function create()
	{
		return view('front.candidate.account.create');
	}

	/**
	 * [store description]
	 * @param  StoreRequest $request [description]
	 * @return [type]                [description]
	 */
    public function store(StoreRequest $request)
    {
    	$response;

    	$user = new User();
    	$user->name = strtolower($request->nombre);
    	$user->email = $request->correoElectronico;
    	$user->password = bcrypt($request->password);

    	if ($user->save()) {
    		$candidate = new Candidate();

    		$candidate->user_id = $user->id;
    		$candidate->last_name = strtolower($request->apellidoPaterno);
    		$candidate->hash = $request->password;

    		if ($candidate->save()) {
    			//Send welcome Mail
    			Mail::to($user->email)->send(new Welcome($user));

    			//Log user in
    			Auth::attempt([
    				'email' => $user->email,
    				'password' => $request->password
    			]);

    			$response = [
	    			'errors' => false,
	    			'message' => 'Se ha creado con éxito tu cuenta.',
	    			'callback_url' => url('candidate/dashboard')
	    		];
    		} else {
    			$user->delete();

    			$response = [
	    			'errors' => true,
	    			'message' => $this->storeErrorMessage,
	    			'error_code' => 's0002'
	    		];
    		}
    	} else {
    		$response = [
    			'errors' => true,
    			'message' => $this->storeErrorMessage,
    			'error_code' => 's0001'
    		];
    	}

    	return response()->json($response);
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
    	Auth::logout();

    	return redirect()->intended('candidate');
    }

    /**
     * [redirectToProvider description]
     * @param  [type] $driver [description]
     * @return [type]         [description]
     */
    public function redirectToProvider($driver)
    {
    	return Socialite::driver($driver)->redirect();
    }

    public function redirectToProviderWithVacancy($id, $driver)
    {
        Session::put('vacancy_callback', $id);

        return Socialite::driver($driver)->redirect();
    }

    /**
     * [handlerProviderCallback description]
     * @param  [type] $driver [description]
     * @return [type]         [description]
     */
    public function handlerProviderCallback($driver)
    {
        //return $driver;

    	$socialUser = Socialite::driver($driver)->user();

    	if (!request()->has('code') || request()->has('denied')) {
    		Session::flash('error', 'Se ha cancelado la petición');
    		return redirect()->intnded('candidate');
    	}

    	//Check if user is already registered
    	$user = User::where('email', $socialUser->email)->where('role_id', \ReclutaTI\Role::CANDIDATE)->first();
    	if ($user) {
    		Auth::loginUsingId($user->id);

            return session('vacancy_callback');

            if (session('vacancy_callback')) {
                return redirect()->intended('vacante/'.session('vacancy_callback'));
            } else {
                return redirect()->intended('candidate/dashboard');
            }
    		
    	} else {
    		$user = new User();
    		$user->name = ($socialUser->name == '' || $socialUser->name == null) ? $socialUser->nickname : strtolower($socialUser->name);
    		$user->email = $socialUser->email;

    		if ($user->save()) {
    			$candidate = new Candidate();
    			$candidate->user_id = $user->id;

    			if ($candidate->save()) {
    				$candidateSocialLogin = new CandidateSocialLogin();
    				$candidateSocialLogin->candidate_id = $candidate->id;
    				$candidateSocialLogin->social_network = $driver;
    				$candidateSocialLogin->uuid = $socialUser->id;

    				if ($candidateSocialLogin->save()) {
    					Auth::loginUsingId($user->id);

    					if (session('vacancy_callback')) {
                            return redirect()->intended('vacante/'.session('vacancy_callback'));
                        } else {
                            return redirect()->intended('candidate/dashboard');
                        }
    				} else {
    					$candidate->delete();
    					$user->delete();
    					Session::flash('error', 'No se ha podido crear tu cuenta en ReclutaTI.');
    					return redirect()->intnded('candidate');
    				}
    			} else {
    				$user->delete();
    				Session::flash('error', 'No se ha podido crear tu cuenta en ReclutaTI.');
    				return redirect()->intnded('candidate');
    			}
    		} else {
    			Session::flash('error', 'No se ha podido crear tu cuenta en ReclutaTI.');
    			return redirect()->intnded('candidate');
    		}
    	}
    }

    /**
     * [passwordReset description]
     * @return [type] [description]
     */
    public function passwordRecover()
	{
		return view('front.candidate.account.password-recover');
	}

    /**
     * [passwordRecoverSend description]
     * @param  PasswordRecoverRequest $request [description]
     * @return [type]                          [description]
     */
	public function passwordRecoverSend(PasswordRecoverRequest $request)
	{
		$response;

		//Check if the email gives is candidate and it's not a social account
        $user = User::whereEmail($request->correoElectronico)->first();

        if ($user->role_id != \ReclutaTI\Role::CANDIDATE || $user->candidate->socialLogin != null) {
            $response = [
                'errors' => true,
                'message' => 'El correo electrónico ingresado es inválido.',
                'error_code' => 'prs0001'
            ];
        } else {
            $signedUrl = URL::temporarySignedRoute(
                'candidate_password_reset', now()->addMinutes(11), ['id' => $user->id]
            );

            Notification::send($user, new PasswordReset($user->name, $signedUrl));

            $response = [
                'errors' => false,
                'message' => 'Se ha enviado un correo con instrucciones, revisa tu bandeja de entrada.'
            ];
        }

        return response()->json($response);
	}

    public function passwordReset(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->intended('candidate');
        }

        return view('front.candidate.account.password-reset', ['id' => $id]);
    }

    /**
     * [passwordResetSave description]
     * @param  PasswordResetRequest $request [description]
     * @param  [type]               $id      [description]
     * @return [type]                        [description]
     */
    public function passwordResetSave(PasswordResetRequest $request, $id)
    {
        $response;

        $user = User::find($id);

        $user->password = bcrypt($request->password);
        $user->candidate->hash = $request->password;

        if ($user->save() && $user->candidate->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha reestablecido con éxito tu contraseña.',
                'callback_url' => url('candidate'),
                'redirect' => true
            ];
        } else {
            $response = [
                'errors' => true,
                'message' => 'No se ha podido actualizar',
                'error_code' => 'prs0001'
            ];
        }

        return response()->json($response);
    }
}
