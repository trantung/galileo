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

/*
	Hệ thống
	1. Quản lý partner
	2. Quản lý trung tâm
	3. Quản lý lớp học
	4. Quản lý môn học
	5. Quản lý gói bán 
	6. Quản lý khuyến mãi
	7. Quản lý học liệu	
*/
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
    // Route::post('/login', array('uses' => 'AdminController@doLogin'));
   
    /*
		Quản lý partner: CRUD đối tác: tên, email, username, password, sđt
		1. Controller: ManagerPartnerController 
		2. table: partners
		3. view: admin.partner
    */
	Route::get('/partner/{id}/reset-password', 'ManagerPartnerController@getResetPass');
	Route::post('/partner/{id}/reset-password', 'ManagerPartnerController@postResetPass');
	Route::resource('/partner', 'ManagerPartnerController');
	/*
		Quản lý trung: CRUD trung tâm: tên, địa chỉ
		1. Controller: ManagerCenterController 
		2. table: center
		3. view: admin.center
    */
	Route::resource('/center', 'ManagerCenterController');

    Route::resource('/', 'AdminController');
});

Route::group(['prefix' => 'partner'], function () {
    // Route::get('/login', array('uses' => 'UserController@login', 'as' => 'admin.login'));
    // Route::post('/login', array('uses' => 'UserController@doLogin'));
    Route::resource('/', 'UserController');
});

Route::group(['prefix' => 'user'], function () {
    // Route::get('/login', array('uses' => 'UserController@login', 'as' => 'admin.login'));
    // Route::post('/login', array('uses' => 'UserController@doLogin'));
    Route::resource('/', 'UserController');
});

























Route::get('/test', function() {
	$input = [
		'username' => 'partner1',
		'email' => 'partner1@gmail.com',
		'password'=>Hash::make('123456'),
	];
	$id = Partner::create($input)->id;
	dd($id);
});
Route::get('/test/login/partner', function(){
	$input = [
		'username' => 'admin',
		'password' => '123456',
	];
	// dd(111);
	// $input = [
	// 	'username' => 'admin',
	// 	'email' => 'admin@gmail.com',
	// 	'password'=>Hash::make('123456'),
	// ];
	// $id = Admin::create($input)->id;
	// dd($id);
	$checkLogin = Auth::admin()->attempt($input);
	// $checkLogin = Auth::partner()->attempt($input);
	dd($checkLogin);
});
