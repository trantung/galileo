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
	Route::resource('/partner', 'PartnerController');
	Route::resource('/class', 'ClassController');
	Route::resource('/subject', 'SubjectController');
	Route::resource('/user', 'UserController');
});

Route::post('/ajax/{method}', 'AjaxController@process');