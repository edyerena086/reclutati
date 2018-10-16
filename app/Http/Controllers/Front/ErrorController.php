<?php

namespace ReclutaTI\Http\Controllers\Front;

use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function error404()
    {
    	return view('error.404');
    }

    public function error500()
    {
    	return view('error.500');
    }
}
