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
Route::get('all_exams', 'ExamController@view');
Route::get('add_exam_form', 'ExamController@add_form');
Route::post('add_exams', 'ExamController@add');
Route::post('delete_exam', 'ExamController@delete');
Route::get('exam_settings/{id}', 'ExamController@view_settings');
Route::post('update_exam_settings', 'ExamController@update_settings');
Route::get('view_exam/{id}', 'ExamController@view_exam');


//Set Routes
Route::get('add_set_form/{id}', 'SetController@add_set_form');
Route::post('add_set', 'SetController@add_set');

//Question Routes
Route::get('add_question_form/{id}', 'QuestionController@add_question_form');
Route::post('add_question', 'QuestionController@add_question');
Route::post('delete_question', 'QuestionController@delete_question');
Route::get('edit_question_form/{exam_id}/{question_id}', 'QuestionController@edit_question_form');
Route::post('edit_question', 'QuestionController@edit_question');


//Choices Routes
Route::get('add_choices_form/{exam_id}/{question_id}', 'ChoiceController@add_choices_form');
Route::post('add_choices', 'ChoiceController@add_choice');