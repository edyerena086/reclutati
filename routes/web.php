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
Route::get('candidate/account', 'Front\Candidate\AccountController@create');
Route::post('candidate/account', 'Front\Candidate\AccountController@store');
