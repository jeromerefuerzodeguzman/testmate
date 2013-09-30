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
