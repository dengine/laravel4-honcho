<?php namespace Dberry37388\Honcho\Controllers;

use Dberry37388\Honcho\Controllers\HonchoController;
use Dberry37388\Honcho\Forms\Profile\ChangePasswordFormModel;
use View;
use Config;
use Redirect;
use Sentry;
use Messages;
use Input;

class ProfileController extends HonchoController {

	/**
	 * Displays the user's profile page
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// return our dashboard view
		return View::make(Config::get('honcho::profile.index.view'));
	}

	/**
	 * Form to change the user's password
	 *
	 * @return View
	 */
	public function getChangePassword()
	{
		return View::make(Config::get('honcho::profile.changepassword.view'));
	}

	/**
	 * Validates the user's current password and attempts to update the user's password
	 * to the new one they submitted
	 *
	 * @return Redirect
	 */
	public function postChangePassword()
	{
		// assign our form model
		$changePasswordFormModel = Config::get('honcho::profile.models.changePasswordFormModel');

		// let's validate our data using our form model
		if ( ! $changePasswordFormModel::is_valid())
		{
			// something did not validate, so we will add a validation message to the container
			// and then redirect the user back to the change password form.
			Messages::add('validation error', array(
				'template'  => 'validation',
			    'container' => 'honcho::profile.changepassword', // will use "default" if empty
			));

			return Redirect::route(Config::get('honcho::profile.changepassword.redirect_failed'))
				->withErrors($changePasswordFormModel::$validation);
		}

		// we've already shared the current user object, so let's just retrieve it.
		$me = array_get(View::getShared(), 'me');

		//now let's check to make sure the user entered the correct "current" password.
		//This is really just an extra security precaution
		if ( ! $me->checkHash(Input::get('old_password'), $me->getPassword()))
		{
			// our passwords didn't match, so let's add our error message to the container
			// and then redirect the user back to the change password form.
			Messages::add(trans('honcho::profile.changepassword.old_password_incorrect'), array(
				'template'  => 'error',
			    'container' => 'honcho::profile.changepassword', // will use "default" if empty
			));

			return Redirect::route(Config::get('honcho::profile.changepassword.redirect_failed'));
		}

		// use sentry to update our user's password.
		try
		{
			// use our form model to generate our attributes that will be passed to Sentry
			// to create our new user.
			$attributes = $changePasswordFormModel::generateAttributes();

			// use our form model to attempt to update the user object
			if ($changePasswordFormModel::saveObject($me))
			{
				// add our error message
				Messages::add(trans('honcho::profile.changepassword.success'), array(
					'template'  => 'success',
				    'container' => 'honcho::profile.index'
				));

				// we're all finished here, so let's go view our new user
				return Redirect::route(Config::get('honcho::profile.changepassword.redirect_success'));
			}
			else
			{
				// we failed to change the user's password. Send an error message
				Messages::add(trans('honcho::profile.changepassword.error'), array(
					'template'  => 'error',
				    'container' => 'honcho::profile.changepassword'
				));

				// we're all finished here, so let's go view our new user
				return Redirect::route(Config::get('honcho::profile.changepassword.redirect_failed'));
			}
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // we could not find the user, so let's send them a message and then redirect
		    // back to the profile page.
		    Messages::add(trans('honcho::profile.changepassword.user_not_found'), array(
		    	'template'  => 'error',
		        'container' => 'honcho::profile.index', // will use "default" if empty
		    ));

		    return Redirect::route('honcho.profile')
		    	->withInput();
		}
	}

	/**
	 * Form to change the user's password
	 *
	 * @return View
	 */
	public function getUpdate()
	{
		return View::make(Config::get('honcho::profile.update.view'));
	}

	/**
	 * Validates the user's current password and attempts to update the user's password
	 * to the new one they submitted
	 *
	 * @return Redirect
	 */
	public function postUpdate()
	{
		// we've already shared the current user object, so let's just retrieve it.
		$me = array_get(View::getShared(), 'me');

		// assign our form model
		$updateFormModel = Config::get('honcho::profile.models.updateFormModel');

		// let's set our user id for the form model. We need this because our validation of the email
		// needs to be unique unless it matches the current user.
		$updateFormModel::$user_id = $me->id;

		// let's validate our data using our form model
		if ( ! $updateFormModel::is_valid())
		{
			// something did not validate, so we will add a validation message to the container
			// and then redirect the user back to the change password form.
			Messages::add('validation error', array(
				'template'  => 'validation',
			    'container' => 'honcho::profile.update', // will use "default" if empty
			));

			return Redirect::route(Config::get('honcho::profile.update.redirect_failed'))
				->withErrors($updateFormModel::$validation);
		}

		// use sentry to update our user's password.
		try
		{
			// use our form model to generate our attributes that will be passed to Sentry
			// to create our new user.
			$attributes = $updateFormModel::generateAttributes();

			// use our form model to attempt to update the user object
			if ($updateFormModel::saveObject($me))
			{
				// add our error message
				Messages::add(trans('honcho::profile.update.success'), array(
					'template'  => 'success',
				    'container' => 'honcho::profile.index'
				));

				// we're all finished here, so let's go view our new user
				return Redirect::route(Config::get('honcho::profile.update.redirect_success'));
			}
			else
			{
				// we failed to change the user's password. Send an error message
				Messages::add(trans('honcho::profile.update.error'), array(
					'template'  => 'error',
				    'container' => 'honcho::profile.update'
				));

				// we're all finished here, so let's go view our new user
				return Redirect::route(Config::get('honcho::profile.update.redirect_failed'));
			}
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // we could not find the user, so let's send them a message and then redirect
		    // back to the profile page.
		    Messages::add(trans('honcho::profile.update.user_not_found'), array(
		    	'template'  => 'error',
		        'container' => 'honcho::profile.index', // will use "default" if empty
		    ));

		    return Redirect::route('honcho.profile')
		    	->withInput();
		}
	}
}