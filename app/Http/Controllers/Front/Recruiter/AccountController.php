<?php

namespace ReclutaTI\Http\Controllers\Front\Recruiter;

use DB;
use Auth;
use Notification;
use ReclutaTI\User;
use ReclutaTI\Role;
use ReclutaTI\Company;
use ReclutaTI\Recruiter;
use Illuminate\Http\Request;
use ReclutaTI\CompanyContact;
use Illuminate\Support\Facades\URL;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Recruiter\Account\Welcome;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\LoginRequest;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\StoreRequest;
use ReclutaTI\Notifications\Front\Recruiter\Account\PasswordReset;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\PasswordResetRequest;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\PasswordRecoverRequest;

class AccountController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('recruiter.guest')->except(['logout']);

        $this->middleware('throttle:5,1')->only(['login']);

        $this->middleware('recruiter.auth')->only(['logout']);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return view('front.recruiter.account.index');
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
            'role_id' => Role::RECRUITER
        ];

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('recruiter/dashboard');
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
		return view('front.recruiter.account.create');
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
    	$user->role_id = Role::RECRUITER;

    	DB::beginTransaction();

    	try {
    		$user->save();

    		$recruiter = new Recruiter();

    		$recruiter->user_id = $user->id;
    		$recruiter->last_name = strtolower($request->apellidoPaterno);
    		$recruiter->validation_phone = $request->telefono;
    		$recruiter->hash = $request->password;
    		$recruiter->save();

    		//Company
    		$company = new Company();
    		$company->name = $request->empresa;
    		$company->save();

    		$companyContact = new CompanyContact();
    		$companyContact->company_id = $company->id;
    		$companyContact->recruiter_id = $recruiter->id;
    		$companyContact->main_contact = true;
    		$companyContact->save();

    	} catch (Exception $e) {
    		DB::rollBack();

    		$response = [
    			'errors' => true,
    			'message' => 'No se ha podido crear tu cuenta en ReclutaTI.',
    			'error_code' => 's0001'
    		];

    		return response()->json($response);
    	}

    	DB::commit();

        Notification::send($user, new Welcome($user->name));

    	$response = [
    		'errors' => false,
    		'callback_url' => url('recruiter/dashboard')
    	];

    	Auth::loginUsingId($user->id);

    	return response()->json($response);
    }

    /**
     * [passwordReset description]
     * @return [type] [description]
     */
    public function passwordRecover()
    {
        return view('front.recruiter.account.password-recover');
    }

    /**
     * [passwordRecoverSend description]
     * @param  PasswordRecoverRequest $request [description]
     * @return [type]                          [description]
     */
    public function passwordRecoverSend(PasswordRecoverRequest $request)
    {
        $response;

        //Check if the email gives is recruiter
        $user = User::whereEmail($request->correoElectronico)->first();

        if ($user->role_id != \ReclutaTI\Role::RECRUITER) {
            $response = [
                'errors' => true,
                'message' => 'El correo electrónico ingresado es inválido.',
                'error_code' => 'prs0001'
            ];
        } else {
            $signedUrl = URL::temporarySignedRoute(
                'recruiter_password_reset', now()->addMinutes(11), ['id' => $user->id]
            );

            Notification::send($user, new PasswordReset($user->name, $signedUrl));

            $response = [
                'errors' => false,
                'message' => 'Se ha enviado un correo con instrucciones, revisa tu bandeja de entrada.'
            ];
        }

        return response()->json($response);
    }

    /**
     * [passwordReset description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function passwordReset(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->intended('candidate');
        }

        return view('front.recruiter.account.password-reset', ['id' => $id]);
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
        $user->recruiter->hash = $request->password;

        if ($user->save() && $user->recruiter->save()) {
            $response = [
                'errors' => false,
                'message' => 'Se ha reestablecido con éxito tu contraseña.',
                'callback_url' => url('recruiter'),
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

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->intended('recruiter');
    }
}
