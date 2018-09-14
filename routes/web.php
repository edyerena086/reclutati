<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Front\StaticController@index');
/**
 * ------------------------------------------------------------------------
 * Candidate Account Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate', 'Front\Candidate\AccountController@index');
Route::post('candidate', 'Front\Candidate\AccountController@login');
Route::get('candidate/account', 'Front\Candidate\AccountController@create');
Route::post('candidate/account', 'Front\Candidate\AccountController@store');
Route::get('candidate/account/logout', 'Front\Candidate\AccountController@logout');
/**
 * ------------------------------------------------------------------------
 * Candidate Dashboard Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate/dashboard', function () {
	return view('layouts.front.candidate');
});
