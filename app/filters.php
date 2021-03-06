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
	// Maintenance Mode
	if(Config::get('app.devmode'))
	{
		// Get the current users IP address
		$usersIp = Request::server('REMOTE_ADDR');
		$accessList = array('127.0.0.0');
		
		if(!in_array($usersIp, $accessList))
		{
			return View::make('errors.maintenance');
		}
	}
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
    if (Auth::guest()){
        return Redirect::guest('login');
    }
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});


// Make sure the user has the needed permission
Route::filter('permission', function($route, $request, $permission)
{
	if (!Auth::user()->checkPermission(Str::upper($permission))) {
		if (!Redirect::getUrlGenerator()->getRequest()->headers->get('referer')) {
			return Redirect::to('/')->with('errors', array('You lack the permission(s) required to view this area'))->send();
		} else {
			return Redirect::back()->with('errors', array('You lack the permission(s) required to view this area'))->send();
		}
	}
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
