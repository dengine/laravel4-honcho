<?php

// We want to be able to make our controllers configurable so that if we want to we can customize them.
// This seems like a pretty cheesy way of doing it, but for right now it works :)
$controllers = array(
	'auth'    => Config::get('honcho::auth.controller', 'Dberry37388\Honcho\Controllers\AuthController'),
	'user'    => Config::get('honcho::user.controller', 'Dberry37388\Honcho\Controllers\UserController'),
	'group'   => Config::get('honcho::group.controller', 'Dberry37388\Honcho\Controllers\GroupController'),
	'profile' => Config::get('honcho::profile.controller', 'Dberry37388\Honcho\Controllers\ProfileController')
);

/**
 * These are routes that if the user is logged in, they do not need to access, such as
 * logging in, forgotten password, etc...
 */

Route::group(array('before' => 'guest'), function() use($controllers)
{

	/**
	 * Routes for Our Auth Controller
	 *
	 * Routes are defined as honcho::auth.action
	 */
	Route::get('login', array('as' => 'login', 'uses' => $controllers['auth'] . '@getLogin'));
	Route::post('login', array('uses' => $controllers['auth'] . '@postLogin'));

	Route::get('forgotpassword', array('as' => 'forgotpassword', 'uses' => $controllers['auth'] . '@getForgotPassword'));
	Route::post('forgotpassword', array('uses' => $controllers['auth'] . '@postForgotPassword'));
	Route::get('confirmforgotpassword', array('as' => 'confirmreset', 'uses' => $controllers['auth'] . '@getConfirmReset'));
});


/**
 * Our Logout Route.
 */
Route::get('logout', array('as' => 'logout', 'uses' => $controllers['auth'] . '@getLogout'));



/**
 * Grouped routes that REQUIRE our user to have access to a permission
 */
Route::group(array('before' => 'has_access'), function() use($controllers)
{
	/**
	 * Routes for our User Controller
	 *
	 * Routes are defined as honcho::user.action
	 */
	Route::get('admin/user', array('as' => 'honcho.user', 'uses' => $controllers['user'] .'@getIndex'));

	Route::get('admin/user/create', array('as' => 'honcho.user.create', 'uses' => $controllers['user'] .'@getCreate'));
	Route::post('admin/user/create', array('uses' => $controllers['user'] .'@postCreate'));

	Route::get('admin/user/view/{num}', array('as' => 'honcho.user.view', 'uses' => $controllers['user'] .'@getView'));

	Route::get('admin/user/update/{num}', array('as' => 'honcho.user.update', 'uses' => $controllers['user'] .'@getUpdate'));
	Route::post('admin/user/update/{num}', array('uses' => $controllers['user'] .'@postUpdate'));

	Route::get('admin/user/groups/{num}', array('as' => 'honcho.user.groups', 'uses' => $controllers['user'] .'@getGroups'));
	Route::post('admin/user/groups/{num}', array('uses' => $controllers['user'] .'@postGroups'));

	Route::get('admin/user/permissions/{num}', array('as' => 'honcho.user.permissions', 'uses' => $controllers['user'] .'@getPermissions'));
	Route::post('admin/user/permissions/{num}', array('uses' => $controllers['user'] .'@postPermissions'));

	/**
	 * Routes for our Group Controller
	 *
	 * Routes are defined as honcho::group.action
	 */
	Route::get('admin/group', array('as' => 'honcho.group', 'uses' => $controllers['group'] .'@getIndex'));

	Route::get('admin/group/create', array('as' => 'honcho.group.create', 'uses' => $controllers['group'] .'@getCreate'));
	Route::post('admin/group/create', array('uses' => $controllers['group'] .'@postCreate'));

	Route::get('admin/group/view/{num}', array('as' => 'honcho.group.view', 'uses' => $controllers['group'] .'@getView'));

	Route::get('admin/group/delete/{num}', array('as' => 'honcho.group.delete', 'uses' => $controllers['group'] .'@getDelete'));
	Route::get('admin/group/confirmDelete/{num}', array('as' => 'honcho.group.confirmDelete', 'uses' => $controllers['group'] .'@getconfirmDelete'));

	Route::get('admin/group/update/{num}', array('as' => 'honcho.group.update', 'uses' => $controllers['group'] .'@getUpdate'));
	Route::post('admin/group/update/{num}', array('uses' => $controllers['group'] .'@postUpdate'));

	Route::get('admin/group/users/{num}', array('as' => 'honcho.group.users', 'uses' => $controllers['group'] .'@getUsers'));
	Route::post('admin/group/users/{num}', array('uses' => $controllers['group'] .'@postUsers'));

	Route::get('admin/group/permissions/{num}', array('as' => 'honcho.group.permissions', 'uses' => $controllers['group'] .'@getPermissions'));
	Route::post('admin/group/permissions/{num}', array('uses' => $controllers['group'] .'@postPermissions'));

	/**
	 * Routes for our Profile Manager
	 *
	 * Routes are defined as honcho::profile.action
	 */
	Route::get('profile', array('as' => 'honcho.profile', 'uses' => $controllers['profile'] . '@getIndex'));

	Route::get('profile/changepassword', array('as' => 'honcho.profile.changepassword', 'uses' => $controllers['profile'] . '@getChangePassword'));
	Route::post('profile/changepassword', array('uses' => $controllers['profile'] . '@postChangePassword'));
});