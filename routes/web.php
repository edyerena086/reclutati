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
//Social login
Route::get('candidate/login/{driver}', 'Front\Candidate\AccountController@redirectToProvider')->name('social_auth');
Route::get('candidate/login/{driver}/callback', 'Front\Candidate\AccountController@handlerProviderCallback');
//Password reset
Route::get('candidate/account/password/recover', 'Front\Candidate\AccountController@passwordRecover');
Route::post('candidate/account/password/recover', 'Front\Candidate\AccountController@passwordRecoverSend');
Route::get('candidate/account/password/reset/{id}', 'Front\Candidate\AccountController@passwordReset')->name('candidate_password_reset');
Route::post('candidate/account/password/reset/{id}', 'Front\Candidate\AccountController@passwordResetSave');
/**
 * ------------------------------------------------------------------------
 * Candidate Dashboard Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate/dashboard', 'Front\Candidate\DashboardController@index');
/*Route::get('candidate/dashboard', function () {
	return view('layouts.front.candidate');
});*/
//Curriculum
Route::get('candidate/dashboard/curriculum', 'Front\Candidate\Curriculum\CurriculumController@index');
Route::post('candidate/dashboard/curriculum/general-info', 'Front\Candidate\Curriculum\CurriculumController@generalInfo');
Route::post('candidate/dashboard/curriculum/labor-goal', 'Front\Candidate\Curriculum\CurriculumController@laborGoal');
Route::post('candidate/dashboard/curriculum/profile-picture', 'Front\Candidate\Curriculum\CurriculumController@profilePicture');
//Contact info
Route::post('candidate/dashboard/curriculum/phones', 'Front\Candidate\Curriculum\ContactInfoController@phones');
Route::post('candidate/dashboard/curriculum/social-media', 'Front\Candidate\Curriculum\ContactInfoController@socialMedia');
//Languages
Route::post('candidate/dashboard/curriculum/languages', 'Front\Candidate\Curriculum\LanguageController@store');
Route::post('candidate/dashboard/curriculum/languages/{id}', 'Front\Candidate\Curriculum\LanguageController@update');
Route::get('candidate/dashboard/curriculum/languages/{id}', 'Front\Candidate\Curriculum\LanguageController@destroy');
//Educational history
Route::post('candidate/dashboard/curriculum/educative-histories', 'Front\Candidate\Curriculum\EducationController@store');
Route::post('candidate/dashboard/curriculum/educative-histories/{id}', 'Front\Candidate\Curriculum\EducationController@update');
Route::get('candidate/dashboard/curriculum/educative-histories/{id}', 'Front\Candidate\Curriculum\EducationController@destroy');
//Address
Route::resource('candidate/dashboard/curriculum/addresses', 'Front\Candidate\Curriculum\AddressController');
//Job Histories
Route::resource('candidate/dashboard/curriculum/job-histories', 'Front\Candidate\Curriculum\JobHistoryController');
//Skills
Route::resource('candidate/dashboard/curriculum/skills', 'Front\Candidate\Curriculum\SkillController');
//Settings
Route::get('candidate/dashboard/settings', 'Front\Candidate\Setting\SettingController@index');
Route::post('candidate/dashboard/settings/password', 'Front\Candidate\Setting\PasswordController@newPassword');
