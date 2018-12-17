<?php

namespace ReclutaTI\Http\Controllers\Back;

use Auth;
use ReclutaTI\User;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;
use ReclutaTI\Http\Requests\Back\Account\LoginRequest;

class AccountController extends Controller
{
   /**
    * [__construct description]
    */
   public function __construct()
   {
      $this->middleware('back.guest')->except(['logout']);
   }

	/**
	 * [index description]
	 * @return [type] [description]
	 */
    public function index()
   	{
   		return view('back.account.index');
   	}

   	/**
   	 * [login description]
   	 * @param  LoginRequest $request [description]
   	 * @return [type]                [description]
   	 */
   	public function login(LoginRequest $request)
   	{
   		$credentials = [
   			'email' => $request->correoElectronico,
   			'password' => $request->password,
   			'role_id' => \ReclutaTI\Role::ADMIN
   		];

   		if (Auth::attempt($credentials)) {
   			return redirect()->intended('back/dashboard');
   		} else {
   			return back()->withErrors(['loginError' => true]);
   		}
   	}

   public function logout()
   {
      Auth::logout();

      return redirect()->intended('back');
   }
}
