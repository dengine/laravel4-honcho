<?php namespace Dberry37388\Honcho\Controllers;

use Dberry37388\Honcho\Controllers\HonchoController;
use Dberry37388\Honcho\Forms\Auth\LoginFormModel;
use View;
use Config;
use Redirect;
use Input;
use Sentry;
use Messages;
use Event;

// sentry exceptions
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;
use Cartalyst\Sentry\Throtting\UserSuspendedException;
use Cartalyst\Sentry\Throtting\UserBannedException;


class AuthController extends HonchoController {

	/**
	 * Displays the login form
	 *
	 * @return View
	 */
	public function getLogin()
	{
		// return the view for our login form
		return View::make(Config::get('honcho::auth.login.view'));
	}

	/**
	 * Process our Login Form
	 *
	 * @return Redirect
	 */
	public function postLogin()
	{
		if ( ! LoginFormModel::is_valid())
		{
			// add our error message
			Messages::add(trans('honcho::auth.login.validation_error'), array(
				'template'  => 'error',
			    'container' => 'honcho::auth.login', // will use "default" if empty
			));

			// redirect the user to back to the login screen, letting them know that validation
			// had failed. This means they forgot to fill out the login_column or password.
			return Redirect::route(Config::get('honcho::auth.login.redirect_failed'))
				->withInput(Input::except('password'))
				->withErrors(LoginFormModel::$validation);
		}

		// our validation passed, so not let's fire up sentry and try to authenticate our user
		try
		{
			// set our login column
			$login_column = LoginFormModel::$login_column;

			// Set login credentials
			$credentials = array(
				$login_column   => Input::get('login_column'),
				'password' => Input::get('password')
			);

			// Try to authenticate the user
			$user = Sentry::authenticate($credentials);

			if ($user)
			{
				// add our success message
				Messages::add(trans('honcho::auth.login.success'), array(
					'template'  => 'error',
				    'container' => 'honcho::auth.login', // will use "default" if empty
				));

				// fire our logging event
				Event::fire('honcho.auth.login', $user);

				// we have successfully logged the user in, so now let's send them where they need
				// to go. If no session redirect uri is found, we will just send them to the default
				// route that is configured in our honcho::auth.login.redirect_success.
				return Redirect::route(Config::get('honcho::auth.login.redirect_success'));
			}
		}
		catch (LoginRequiredException $e)
		{
			// set our error message
			$error = trans('honcho::auth.login.login_column_required', array('login_column' => $login_column));
		}
		catch (PasswordRequiredException $e)
		{
			// set our error message
			$error = trans('honcho::auth.login.password_required');
		}
		catch (UserNotFoundException $e)
		{
			// Sometimes a user is found, however hashed credentials do
			// not match. Therefore a user technically doesn't exist
			// by those credentials. Check the error message returned
			// for more information.
			// set our error message
			$error = trans('honcho::auth.login.user_not_found');
		}
		catch (UserNotActivatedException $e)
		{
			// set our error message
			$error = trans('honcho::auth.login.user_not_activated');
		}

		// The following is only required if throttle is enabled
		catch (UserSuspendedException $e)
		{
			// set our error message
			$error = trans('honcho::auth.login.user_suspended');
		}
		catch (UserBannedException $e)
		{
			// set our error message
			$error = trans('honcho::auth.login.user_banned');
		}

		// add our success message
		Messages::add($error, array(
			'template'  => 'error',
		    'container' => 'honcho::auth.login', // will use "default" if empty
		));

		// we failed to log the user in successfully, so let's send them back to the login screen
		// with the error message that we received.
		return Redirect::route(Config::get('honcho::auth.login.redirect_failed'))
			->withInput(Input::except('password'));
	}

	/**
	 * Logs our user out of the system
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		if (Sentry::check())
		{
			// save our user object so that we fire our event.
			$saved_user = Sentry::getUser();

			// Logs the user out
			Sentry::logout();

			// add our success message
			Messages::add(trans('honcho::auth.logout.success'), array(
				'template'  => 'info',
			    'container' => 'honcho::auth.login', // will use "default" if empty
			));

			// fire our logging event
			Event::fire('honcho.auth.logout', $saved_user);

			// unset our saved user var
			unset($saved_user);
		}

		// we have successfully signed the user out. Let's redirect with a message.
		// The redirect is set in our config file
		return Redirect::route(Config::get('honcho::auth.logout.redirect_success'));
	}
}