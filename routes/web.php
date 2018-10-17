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
//Vacancies
Route::get('vacante/{id}', 'Front\VacancyController@detail');
Route::post('vacante/aplicar/{id}', 'Front\VacancyController@apply');
Route::get('vacante/guardar/{id}', 'Front\VacancyController@bookmark');
//Vacancies by states
Route::get('vacantes/estado/', 'Front\StateVacancy@states');
Route::get('vacantes/estado/{id}', 'Front\StateVacancy@state');
//Company Profile
Route::get('perfil/empresa/{id}', 'Front\CompanyController@index');
//Search
Route::get('buscar/vacante', 'Front\SearchController@index');

//Notifications
Route::get('notification/mark-as-read/{user}/{noty}/{callback?}', 'Front\NotificationController@markAsRead');

//Legal
Route::get('aviso-de-privacidad', 'Front\StaticController@privacy');

/**
 * ------------------------------------------------------------------------
 * Front static error page
 * ------------------------------------------------------------------------
 */
Route::get('404', 'Front\ErrorController@error404')->name('404');
Route::get('500', 'Front\ErrorController@error500');

/**
 * ------------------------------------------------------------------------
 * Candidate Account Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate', 'Front\Candidate\AccountController@index');
Route::post('candidate', 'Front\Candidate\AccountController@login');
Route::get('candidate/login/vacancy/{id}', 'Front\Candidate\AccountController@getLoginVacancy');
Route::post('candidate/login/vacancy/{id}', 'Front\Candidate\AccountController@postLoginVacancy');
Route::get('candidate/account', 'Front\Candidate\AccountController@create');
Route::post('candidate/account', 'Front\Candidate\AccountController@store');
Route::get('candidate/account/logout', 'Front\Candidate\AccountController@logout');
//Social login
Route::get('candidate/login/{driver}', 'Front\Candidate\AccountController@redirectToProvider')->name('social_auth');
Route::get('candidate/social-login/{vacancy}/{driver}', 'Front\Candidate\AccountController@redirectToProviderWithVacancy')->name('social_auth_vacancy');
Route::get('candidate/login/{driver}/callback', 'Front\Candidate\AccountController@handlerProviderCallback');
//Password reset
Route::get('candidate/account/password/recover', 'Front\Candidate\AccountController@passwordRecover');
Route::post('candidate/account/password/recover', 'Front\Candidate\AccountController@passwordRecoverSend');
Route::get('candidate/account/password/reset/{id}', 'Front\Candidate\AccountController@passwordReset')->name('candidate_password_reset');
Route::post('candidate/account/password/reset/{id}', 'Front\Candidate\AccountController@passwordResetSave');
//Vacancies
Route::get('candidate/dashboard/vacancies/applied', 'Front\Candidate\Vacancy\AppliedController@index');
Route::delete('candidate/dashboard/vacancies/applied/{id}', 'Front\Candidate\Vacancy\AppliedController@destroy');
Route::get('candidate/dashboard/vacancies/favourites', 'Front\Candidate\Vacancy\FavouriteController@index');
Route::post('candidate/dashboard/vacancies/favourites/apply/{id}', 'Front\Candidate\Vacancy\FavouriteController@apply');
Route::delete('candidate/dashboard/vacancies/favourites/{id}', 'Front\Candidate\Vacancy\FavouriteController@destroy');
/**
 * ------------------------------------------------------------------------
 * Candidate Dashboard Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('candidate/dashboard', 'Front\Candidate\DashboardController@index')->middleware('candidate.auth');
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
Route::post('candidate/dashboard/settings/email', 'Front\Candidate\Setting\EmailController@update');
//Messages
Route::get('candidate/dashboard/messages', 'Front\Candidate\MessageController@index');


/**
 * ------------------------------------------------------------------------
 * Recruiter Account Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('recruiter', 'Front\Recruiter\AccountController@index');
Route::post('recruiter', 'Front\Recruiter\AccountController@login');
Route::get('recruiter/account', 'Front\Recruiter\AccountController@create');
Route::post('recruiter/account', 'Front\Recruiter\AccountController@store');
Route::get('recruiter/account/logout', 'Front\Recruiter\AccountController@logout');
//Password
Route::get('recruiter/account/password/recover', 'Front\Recruiter\AccountController@passwordRecover');
Route::post('recruiter/account/password/recover', 'Front\Recruiter\AccountController@passwordRecoverSend');
Route::get('recruiter/account/password/reset/{id}', 'Front\Recruiter\AccountController@passwordReset')->name('recruiter_password_reset');
Route::post('recruiter/account/password/reset/{id}', 'Front\Recruiter\AccountController@passwordResetSave');
/**
 * ------------------------------------------------------------------------
 * Recruiter Dashboard Routes
 * ------------------------------------------------------------------------
 * 
 */
Route::get('recruiter/dashboard', 'Front\Recruiter\DashboardController@index');
Route::post('recruiter/dashboard/company/update', 'Front\Recruiter\DashboardController@company');
Route::post('recruiter/dashboard/company/profile-picture', 'Front\Recruiter\DashboardController@companyProfilePicture');
//vacancies
Route::get('recruiter/dashboard/vacancies/candidates/{id}', 'Front\Recruiter\Dashboard\VacancyCandidateController@index');
Route::resource('recruiter/dashboard/vacancies', 'Front\Recruiter\Dashboard\VacancyController');
Route::post('recruiter/dashboard/candidate/{id}/{vacancy}/remove', 'Front\Recruiter\Dashboard\VacancyCandidateController@remove');
//Settings
Route::get('recruiter/dashboard/settings', 'Front\Recruiter\Setting\SettingController@index');
Route::post('recruiter/dashboard/settings/password', 'Front\Recruiter\Setting\PasswordController@newPassword');
//Candidates
Route::get('recruiter/dashboard/candidates/search', 'Front\Recruiter\Dashboard\CandidateController@search');
Route::get('recruiter/dashboard/candidates/detail/{id}', 'Front\Recruiter\Dashboard\CandidateController@detail');
//Message
Route::post('recruiter/dashboard/vacancies/cadndidates/message/{candidate}', 'Front\Recruiter\Dashboard\VacancyCandidateController@message');
