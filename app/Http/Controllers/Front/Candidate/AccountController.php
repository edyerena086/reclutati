<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use Socialite;
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

    /**
     * [handlerProviderCallback description]
     * @param  [type] $driver [description]
     * @return [type]         [description]
     */
    public function handlerProviderCallback($driver)
    {
    	$socialUser = Socialite::driver($driver)->user();

    	if (!request()->has('code') || request()->has('denied')) {
    		return redirect()->intnded('candidate');
    	}

    	//Check if user is already registered
    	$user = User::where('email', $socialUser->email)->where('role_id', \ReclutaTI\Role::CANDIDATE)->first();
    	if ($user) {
    		Auth::loginUsingId($user->id);

    		return redirect()->intended('candidate/dashboard');
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

    					return redirect()->intended('candidate/dashboard');
    				} else {
    					$candidate->delete();
    					$user->delete();
    				}
    			} else {
    				$user->delete();
    			}
    		} else {

    		}
    	}
    }

    /**
     * [passwordReset description]
     * @return [type] [description]
     */
    public function passwordRecover()
	{
		return URL::temporarySignedRoute(
		    'unsubscribe', now()->addMinutes(30), ['user' => 1]
		);

		//return view('front.candidate.account.password-recover');
	}

	public function passwordRecoverSend(PasswordRecoverRequest $request)
	{
		$response;

		//
	}
}
