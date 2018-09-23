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
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Notifications\Front\Recruiter\Account\Welcome;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\LoginRequest;
use ReclutaTI\Http\Requests\Front\Recruiter\Account\StoreRequest;

class AccountController extends Controller
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('recruiter.guest')->except(['logout']);

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
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->intended('recruiter');
    }
}
