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

	Route::get('/login', array('uses' => 'AdminController@login', 'as' => 'admin.login'));
	Route::post('/login', array('uses' => 'AdminController@doLogin'));
	Route::get('/logout', array('uses' => 'AdminController@logout', 'as' => 'admin.logout'));
	Route::resource('/', 'AdminController');

	Route::get('/manager/changepassword/{id}', array('uses' => 'ManagerController@changePassword', 'as' => 'admin.manager.chanpassword'));
	Route::post('/manager/updatePassword/{id}', array('uses' => 'ManagerController@updatePassword'));
	Route::get('/manager/search', array('uses' => 'ManagerController@search', 'as' => 'admin.manager.search'));
	Route::resource('/manager', 'ManagerController');

	Route::resource('/newstype', 'NewsTypeController');

	Route::get('/news/search', array('uses' => 'NewsController@search', 'as' => 'admin.news.search'));
	Route::resource('/news', 'NewsController');

	Route::post('/image_slider/delete/{id}', 'AdminSlideController@deleteSlide');
	Route::get('/slider/search', array('uses' => 'AdminSlideController@search', 'as' => 'admin.slide.search'));
	Route::resource('/slider', 'AdminSlideController');

	Route::resource('/des_content', 'DesContentController');
	Route::resource('/introduce', 'AdminIntroduceController');

});

Route::group(
	array(
		'prefix' => LaravelLocalization::setLocale(),
		'before' => 'LaravelLocalizationRoutes' // Route translate filter
	),
	function()
	{

		Route::get('/tin-tuc/{slug}', array('uses' => 'SiteNewsController@show', 'as' =>'showNews'));
		Route::get('/tin-tuc', array('uses' => 'SiteNewsController@index', 'as' => 'listNews'));

		/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
		Route::resource('/', 'SiteIndexController');

		// Route::get(LaravelLocalization::transRoute('routes.about'),function(){
		// 	return View::make('about');
		// });
		Route::get(LaravelLocalization::transRoute('routes.about'), 'AboutController@index');
		Route::get(LaravelLocalization::transRoute('routes.contact'), 'ContactController@index');
		Route::post(LaravelLocalization::transRoute('routes.contact'), 'ContactController@store');
		// Route::get(LaravelLocalization::transRoute('routes.view'),function($id){
		// 	return View::make('view',array('id'=>$id));
		// });
	}
);