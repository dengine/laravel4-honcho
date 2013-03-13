<?php

/**
 * Auth Routes
 */

Route::get('login', array('as' => 'login', 'uses' => 'Dberry37388\Honcho\Controllers\AuthController@getLogin'));
Route::post('login', array('uses' => 'Dberry37388\Honcho\Controllers\AuthController@postLogin'));

Route::get('forgotpassword', array('as' => 'forgotpassword', 'uses' => 'Dberry37388\Honcho\Controllers\AuthController@getForgotPassword'));
Route::post('forgotpassword', array('uses' => 'Dberry37388\Honcho\Controllers\AuthController@postForgotPassword'));
Route::get('forgotpassword', array('as' => 'confirmreset', 'uses' => 'Dberry37388\Honcho\Controllers\AuthController@getConfirmReset'));



// register our controller,
Route::group(array('before' => 'has_access'), function()
{
	/**
	 * Routes for our User Controller
	 *
	 * Routes are defined as honcho::user.action
	 */
	Route::get('admin/user', array('as' => 'honcho.user', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getIndex'));

	Route::get('admin/user/create', array('as' => 'honcho.user.create', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getCreate'));
	Route::post('admin/user/create', array('uses' => 'Dberry37388\Honcho\Controllers\UserController@postCreate'));

	Route::get('admin/user/view/{num}', array('as' => 'honcho.user.view', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getView'));

	Route::get('admin/user/update/{num}', array('as' => 'honcho.user.update', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getUpdate'));
	Route::post('admin/user/update/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\UserController@postUpdate'));

	Route::get('admin/user/groups/{num}', array('as' => 'honcho.user.groups', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getGroups'));
	Route::post('admin/user/groups/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\UserController@postGroups'));

	Route::get('admin/user/permissions/{num}', array('as' => 'honcho.user.permissions', 'uses' => 'Dberry37388\Honcho\Controllers\UserController@getPermissions'));
	Route::post('admin/user/permissions/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\UserController@postPermissions'));

	/**
	 * Routes for our Group Controller
	 *
	 * Routes are defined as honcho::group.action
	 */
	Route::get('admin/group', array('as' => 'honcho.group', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getIndex'));

	Route::get('admin/group/create', array('as' => 'honcho.group.create', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getCreate'));
	Route::post('admin/group/create', array('uses' => 'Dberry37388\Honcho\Controllers\GroupController@postCreate'));

	Route::get('admin/group/view/{num}', array('as' => 'honcho.group.view', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getView'));

	Route::get('admin/group/delete/{num}', array('as' => 'honcho.group.delete', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getDelete'));
	Route::get('admin/group/confirmDelete/{num}', array('as' => 'honcho.group.confirmDelete', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getconfirmDelete'));

	Route::get('admin/group/update/{num}', array('as' => 'honcho.group.update', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getUpdate'));
	Route::post('admin/group/update/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\GroupController@postUpdate'));

	Route::get('admin/group/users/{num}', array('as' => 'honcho.group.users', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getGroups'));
	Route::post('admin/group/users/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\GroupController@postGroups'));

	Route::get('admin/group/permissions/{num}', array('as' => 'honcho.group.permissions', 'uses' => 'Dberry37388\Honcho\Controllers\GroupController@getPermissions'));
	Route::post('admin/group/permissions/{num}', array('uses' => 'Dberry37388\Honcho\Controllers\GroupController@postPermissions'));
});