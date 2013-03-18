<?php

/**
 * Checks to make sure our user has access to the resource that they are
 * attempting to access.
 */
Route::filter('has_access', function()
{
	Messages::add(trans('honcho::auth.login.login_required'), array(
		'template'  => 'error',
		'container' => 'honcho::auth.login', // will use "default" if empty
	));

	if (! Sentry::check()) return Redirect::route('login');

	View::share('me', Sentry::getUser());
});