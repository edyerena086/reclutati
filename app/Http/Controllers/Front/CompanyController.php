<?php

namespace ReclutaTI\Http\Controllers\Front;

use ReclutaTI\Company;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index($id)
    {
    	$company = Company::find($id);

    	if ($company) {
    		return view('front.static.company');
    	} else {
    		return back();
    	}
    }
}
