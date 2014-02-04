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

//User Routes
Route::get('admin_login', 'UserController@login');
Route::any('logout', 'UserController@logout');
Route::post('authenticate', 'UserController@authenticate');


//Exam Routes
Route::get('/', 'ExamController@index');
Route::get('exams', 'ExamController@index');
Route::get('exam/add', 'ExamController@add');
Route::post('exam/create', 'ExamController@create');
Route::get('exam/{id}/delete', 'ExamController@delete');
Route::get('exam/{id}/settings', 'ExamController@settings');
Route::post('exam/{id}/settings/update', 'ExamController@update_settings');
Route::get('exam/{id}', 'ExamController@show');


//Set Routes
//Route::get('add_set_form/{id}', 'SetController@add_set_form');
Route::get('exam/{id}/set/add', 'SetController@add');
Route::post('exam/{id}/set/create', 'SetController@create');

//Question Routes
Route::get('exam/{id}/question/add/{type}', 'QuestionController@add');
Route::post('exam/{id}/question/create', 'QuestionController@create');
Route::post('exam/{id}/question/delete', 'QuestionController@delete');
Route::get('question/{id}/edit', 'QuestionController@edit');
Route::post('question/{id}/update', 'QuestionController@update');
Route::post('question/{id}/setanswer', 'QuestionController@answer');


//Choices Routes
Route::get('add_choices_form/{exam_id}/{question_id}', 'ChoiceController@add_choices_form');
Route::post('add_choices', 'ChoiceController@add_choice');
Route::post('choice/update', 'ChoiceController@try_update');