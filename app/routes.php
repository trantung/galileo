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

Route::group(['prefix' => 'admin'], function () {

	Route::resource('/', 'AdminController');
});


//Route::get('partner/create','PartnerController@create');
//Route::get('partner/display','PartnerController@index');
Route::resource('partner','PartnerController');

//---------------------------------------------------------//

// Route::get('center/create','CenterController@create');
// Route::get('center/display','CenterController@index');
Route::resource('center','CenterController');

// //---------------------------------------------------------//

// Route::get('employees/create','EmployeesController@create');
// Route::get('employees/display','EmployeesController@index');
Route::resource('employees','EmployeesController');


// //---------------------------------------------------------//

// Route::get('class/create','ClassController@create');
// Route::get('class/display','ClassController@index');
// Route::resource('class','ClassController');

// //--------------------------------------------------------//

// Route::get('subject/create','SubjectController@create');
// Route::get('subject/display','SubjectController@index');
// Route::resource('subject','SubjectController');

// //--------------------------------------------------------//

// Route::get('class_subject/create','Class_SubjectController@create');
// Route::get('class_subject/display','Class_SubjectController@index');
// Route::resource('class_subject','Class_SubjectController');

//--------------------------------------------------------//
