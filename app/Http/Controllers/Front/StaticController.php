<?php

namespace ReclutaTI\Http\Controllers\Front;

use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function index()
    {
    	return view('front.static.index');
    }
}
