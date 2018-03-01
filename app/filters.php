<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    //
});


App::after(function($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest('login');
        }
    }
});

Route::filter('admin', function()
{
    if (Auth::admin()->guest()){
        if (Auth::user()->guest()){
            return Redirect::action('AdminController@login');
        }
        if (Auth::user()->check()) {
            $route = Route::getCurrentRoute()->getActionName();
            $check = checkUrlPermission($route);
            if (!$check) {
                return View::make('403');
            }
        }
    }
    $admin = Auth::admin()->get();
    if (isset($admin)) {
        if ($admin->role_id != ADMIN) {
            $route = Route::getCurrentRoute()->getActionName();
            $check = checkUrlPermission($route);
            if (!$check) {
                return View::make('403');
            }
        }
    }
    
});
Route::filter('user', function()
{
    if (Auth::user()->guest()){
        return Redirect::action('UserController@login');
    }
    // $admin = Auth::admin()->get();
 //    if ($admin->role_id != ADMIN) {
 //     $route = Route::getCurrentRoute()->getActionName();
 //     $check = checkUrlPermission($route);
 //     if (!$check) {
 //         return View::make('403');
 //     }
 //    }
});


// Route::filter('partner', function()
// {
//  if (Auth::partner()->guest()){
//      return Redirect::route('partner.login');
//  }
// });
Route::filter('auth.basic', function()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
