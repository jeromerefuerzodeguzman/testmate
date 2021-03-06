<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Applicant Controller
Route::get('nsi', 'ApplicantController@index');
Route::get('nsiexam/{code}', 'ApplicantController@examquestions');
Route::post('codeauth', 'ApplicantController@codeauth');
Route::post('answer', 'ApplicantController@answer_update');
Route::post('checkanswer', 'ApplicantController@answer_check');


Route::group(array('before' => 'auth'), function() {

	//Exam Routes
	Route::get('/', 'ExamController@index');
	Route::get('exams', 'ExamController@index');
	Route::get('exam/add', 'ExamController@add');
	Route::post('exam/create', 'ExamController@create');
	Route::get('exam/{id}/delete', 'ExamController@delete');
	Route::get('exam/{id}/settings', 'ExamController@settings');
	Route::post('exam/{id}/settings/update', 'ExamController@update_settings');
	Route::get('exam/{id}', 'ExamController@show');
	Route::any('exam/{id}/{status}', 'ExamController@update_status');
	Route::get('results', 'ExamController@results');


	//Set Routes
	//Route::get('add_set_form/{id}', 'SetController@add_set_form');
	Route::get('exam/{id}/set/add', 'SetController@add');
	Route::post('exam/{id}/set/create', 'SetController@create');

	//Question Routes
	Route::get('exam/{id}/question/add/{type}/{set_id}', 'QuestionController@add');
	Route::post('exam/{id}/question/create', 'QuestionController@create');
	Route::get('question/{id}/edit', 'QuestionController@edit');
	Route::post('question/{id}/update', 'QuestionController@update');
	Route::post('question/{id}/setanswer', 'QuestionController@answer');
	Route::get('question/{id}/delete', 'QuestionController@remove');


	//Applicant Routes
	Route::get('applicants', 'ApplicantsController@index');
	Route::get('applicant/add', 'ApplicantsController@add');
	Route::post('applicant/create', 'ApplicantsController@create');
	Route::get('applicant/{id}', 'ApplicantsController@view');


	//Choices Routes
	Route::get('add_choices_form/{exam_id}/{question_id}', 'ChoiceController@add_choices_form');
	Route::post('add_choices', 'ChoiceController@add_choice');
	Route::post('choice/update', 'ChoiceController@try_update');
});

//User Routes
Route::get('admin_login', 'UserController@login');
Route::any('logout', 'UserController@logout');
Route::post('authenticate', 'UserController@authenticate');


