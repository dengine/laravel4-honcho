<?php namespace Dberry37388\Honcho\Controllers;

use Dberry37388\Honcho\Controllers\HonchoController;
use Dberry37388\Honcho\Forms\User\CreateFormModel;
use Dberry37388\Honcho\Forms\User\UpdateFormModel;
use View;
use Config;
use Redirect;
use Input;
use Sentry;
use Messages;
use DB;

class UserController extends HonchoController {

	public function getIndex()
	{
		// get all of our users
		$data['users'] = Sentry::getUserProvider()->findAll();

		// return our dashboard view
		return View::make(Config::get('honcho::user.index.view'), $data);
	}

	/**
	 * View a User's Details
	 *
	 * @param  string $user_id  our user's id
	 *
	 * @return View
	 */
	public function getView($user_id = '')
	{
		try
		{
			// fetch the user
		    $data['user'] = Sentry::getUserProvider()->findById($user_id);// set our page title
		    $data['groups'] = $data['user']->getGroups();

		    // return our view with our user's data in there.
		    return View::make(Config::get('honcho::user.view.view'), $data);
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
		    'container' => 'honcho::user.view', // will use "default" if empty
		));

		// redirect to the configured fail route
		return Redirect::route(Config::get('honcho::user.view.redirect_failed'));
	}

	/**
	 * Displays our form used to create our user
	 *
	 * @return View
	 */
	public function getCreate()
	{
		$data['groups'] = Sentry::getGroupProvider()->findAll();

		// return our create form view
		return View::make(Config::get('honcho::user.create.view'), $data);
	}

	/**
	 * Handles creating our user.
	 *
	 * We will validate our input and attempt to create the user. On success we will be redirected
	 * to the user's page, on fail, we will go back to the create form with error message.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		$createFormModel = Config::get('honcho::user.models.createFormModel');

		// use our form model to validate the form.
		if ( ! $createFormModel::is_valid())
		{
			// add our error message
			Messages::add('validation error', array(
				'template'  => 'validation',
			    'container' => 'honcho::user.create', // will use "default" if empty
			));

			// we've failed to create the user, so let's send them back to the form.
			return Redirect::route(Config::get('honcho::user.create.redirect_failed'))
				->withErrors($createFormModel::$validation)
				->withInput();
		}

		// try to use sentry to create our user.
		try
		{
			// use our form model to generate our attributes that will be passed to Sentry
			// to create our new user.
			$attributes = $createFormModel::generateAttributes();

			// add a unique id for the public key
			$attributes['token'] = uniqid(md5(rand()), true);

			// Create the user
			$user = Sentry::getUserProvider()->create($attributes, true);

			if ( Input::has('groups'))
			{
				$groups = Input::get('groups');

				foreach ($groups as $group)
				{
					$group = Sentry::getGroupProvider()->findById($group);

					// Assign the group to the user
					$user->addGroup($group);
				}
			}

			// we're all finished here, so let's go view our new user
			return Redirect::route(Config::get('honcho::user.create.redirect_success'), array($user->id));
		}
		catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			$error = trans('honcho::user.create.login_attribute_required');
		}
		catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			$error = trans('honcho::user.create.password_attribute_required');
		}
		catch (\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$error = trans('honcho::user.create.user_already_exists');
		}

		// add our error message
		Messages::add($error, array(
			'template'  => 'error',
		    'container' => 'honcho::user.create', // will use "default" if empty
		));


		// we've failed to create the user, so let's send them back to the form.
		return Redirect::route('honcho::user.create.redirect_failed')
			->withInput();
	}

	/**
	 * Display the form to update our user's details
	 *
	 * @param  integer  $user_id  our user id
	 *
	 * @return View
	 */
	public function getUpdate($user_id = null)
	{
		try
		{
			// fetch the user
		    $data['user'] = Sentry::getUserProvider()->findById($user_id);

		    // return our view with our user's data in there.
		    return View::make(Config::get('honcho::user.update.view'), $data);
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
		    'container' => 'honcho::user.update', // will use "default" if empty
		));

		// redirect to the configured fail route
	}

	/**
	 * Handles updating our user.
	 *
	 * We will validate our input and attempt to update the user. On success we will be redirected
	 * to the user's page, on fail, we will go back to the update form with error message.
	 *
	 * @return Redirect
	 */
	public function postUpdate($user_id)
	{
		$updateFormModel = Config::get('honcho::user.models.UpdateFormModel');

		// set the user id for our user form model
		UpdateFormModel::$user_id = $user_id;

		// use our form model to validate the form.
		if ( ! UpdateFormModel::is_valid())
		{
			// add our error message
			Messages::add('validation error', array(
				'template'  => 'validation',
			    'container' => 'honcho::user.update', // will use "default" if empty
			));

			// we've failed to update the user, so let's send them back to the form.
			return Redirect::route(Config::get('honcho::user.update.redirect_failed'), array($user_id))
				->withErrors(UpdateFormModel::$validation)
				->withInput();
		}

		// try to use sentry to update our user.
		try
		{
			// use our form model to generate our attributes that will be passed to Sentry
			// to create our new user.
			$attributes = UpdateFormModel::generateAttributes();

			// Create the user
			$user = Sentry::getUserProvider()->findById($user_id);

			if (UpdateFormModel::saveObject($user))
			{
				// add our error message
				Messages::add(trans('honcho::user.update.success'), array(
					'template'  => 'success',
				    'container' => 'honcho::user.view', // will use "default" if empty
				));

				// we're all finished here, so let's go view our new user
				return Redirect::route(Config::get('honcho::user.update.redirect_success'), array($user_id));
			}
			else
			{
				// add our error message
				Messages::add(trans('honcho::user.update.success'), array(
					'template'  => 'error',
				    'container' => 'honcho::user.view', // will use "default" if empty
				));
			}
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		   $error = trans('honcho::user.update.login_already_exists', array('login_attribute' => Input::get('email')));
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // add our error message
		    Messages::add(trans('honcho::user.update.user_not_found'), array(
		    	'template'  => 'error',
		        'container' => 'honcho::user.update', // will use "default" if empty
		    ));

		    // we've failed to update the user, so let's send them back to the form.
		    return Redirect::route('honcho::user.update.redirect_failed', array($user_id))
		    	->withInput();
		}

		// add our error message
		Messages::add($error, array(
			'template'  => 'error',
		    'container' => 'honcho::user.update', // will use "default" if empty
		));


		// we've failed to update the user, so let's send them back to the form.
		return Redirect::route('honcho::user.update.redirect_failed', array($user_id))
			->withInput();
	}


	public function getGroups($user_id = '')
	{
		try
		{
			// fetch the user
			$data['user'] = Sentry::getUserProvider()->findById($user_id);// set our page title
			$selected_group_ids = array();

			// fetch the groups that the user belongs to
			foreach($data['user']->getGroups() as $group)
			{
				$selected_group_ids[] = $group->id;
			}

			$data['selected_groups'] = $selected_group_ids;

		    // return our view with our user's data in there.
		    return View::make(Config::get('honcho::user.groups.view'), $data);
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
		    'container' => 'honcho::user.groups', // will use "default" if empty
		));
	}

	public function postGroups($user_id = '')
	{
		try
		{
			// start by removing all of the current groups that the user belongs to.
			$affected  = DB::table('users_groups')
				->where('user_id', '=', $user_id)
				->delete();

			// get the groups from our update form input
			$new_groups = Input::get('groups', array());

			if ( ! empty($new_groups))
			{
				// fetch the user
				$user = Sentry::getUserProvider()->findById($user_id);// set our page title

				foreach($new_groups as $group_id)
				{
					$group = Sentry::getGroupProvider()->findById($group_id);

					$user->addGroup($group);
				}
			}

		   // add our error message
		   Messages::add(trans('honcho::user.groups.success'), array(
		   	'template'  => 'success',
		       'container' => 'honcho::user.view', // will use "default" if empty
		   ));

		    // return our view with our user's data in there.
		    return Redirect::route(Config::get('honcho::user.groups.redirect_success'), array($user_id));
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
		    'container' => 'honcho::user.groups', // will use "default" if empty
		));

		// return our view with our user's data in there.
	    return Redirect::route(Config::get('honcho::user.groups.redirect_failed'), array($user_id));
	}
}