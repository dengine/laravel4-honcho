<?php namespace Dberry37388\Honcho\Controllers;

use Dberry37388\Honcho\Controllers\HonchoController;
use View;
use Config;
use Redirect;
use Input;
use Sentry;
use Messages;
use Settings;
use DB;

class GroupController extends HonchoController {

	public function __construct()
	{
		// set our section and default title
		// This will be used for navigation items.
		Settings::setMultiple(array(
			'section' => 'Admin :: Group Management',
			'page_title' => 'Manage Your Groups'
		));
	}

	public function getIndex()
	{
		// get all of our groups
		$data['groups'] = Sentry::getGroupProvider()->findAll();

		// set our page title
		Settings::setPageTitle(trans(Config::get('honcho::group.index.page_title')));

		// return our dashboard view
		return View::make(Config::get('honcho::group.index.view'), $data);
	}

	/**
	 * View a Groups's Details
	 *
	 * @param  string $group_id  our group's id
	 *
	 * @return View
	 */
	public function getView($group_id = '')
	{
		try
		{
			// fetch the group
			$data['group'] = Sentry::getGroupProvider()->findById($group_id);// set our page title
			$data['groups'] = $data['group']->groups;

			// set our section and default title
			// This will be used for navigation items.
			Settings::setMultiple(array(
				'page_title' => trans('honcho::group.view.page_title'),
				'nav_section' => 'group'
			));

			// return our view with our group's data in there.
			return View::make(Config::get('honcho::group.view.view'), $data);
		}
		catch (\Cartalyst\Sentry\groups\GroupNotFoundException $e)
		{
			$error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
			'container' => 'honcho::group.index', // will use "default" if empty
		));

		// redirect to the configured fail route
		return Redirect::route(Config::get('honcho::group.view.redirect_failed'));
	}

	public function getCreate()
	{
		// get all of our groups
		$data['groups'] = Sentry::getgroupProvider()->findAll();

		// set our section and default title
		// This will be used for navigation items.
		Settings::setMultiple(array(
			'page_title' => trans('honcho::group.create.page_title'),
		));

		// return our dashboard view
		return View::make(Config::get('honcho::group.create.view'), $data);
	}

	public function postCreate()
	{
		// create an instance of our form model
		$createFormModel = Config::get('honcho::group.models.createFormModel');

		if ( ! $createFormModel::is_valid())
		{
			// add our error message
			Messages::add('validation error', array(
				'template'  => 'validation',
				'container' => 'honcho::group.create', // will use "default" if empty
			));

			// we've failed to create the group, so let's send them back to the form.
			return Redirect::route(Config::get('honcho::group.group.redirect_failed'))
				->withErrors($createFormModel::$validation)
				->withInput();
		}

		// use the form model to create our attributes.
		$attributes = $createFormModel::generateAttributes();

		try
		{
			// Create the group
			$group = Sentry::getGroupProvider()->create($attributes);

			// if we have groups to add, let's do that now
			if (Input::has('groups'))
			{
				foreach (Input::get('groups') as $group)
				{
					$group = Sentry::getgroupProvider()->findById($group)->addGroup($group);
				}
			}

			// add our error message
			Messages::add(trans('honcho::group.create.success'), array(
				'template'  => 'success',
				'container' => 'honcho::group.view', // will use "default" if empty
			));

			// group created and groups added, let's take a look at our new group
			return Redirect::route(Config::get('honcho::group.create.redirect_success'), array($group->id));
		}
		catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		   $error = trans('honcho::group.create.name_is_requried');
		}
		catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			$error = trans('honcho::group.create.group_already_exists', array('name' => Input::get('name')));
		}

		// add our error message
		Messages::add($error, array(
			'template'  => 'error',
			'container' => 'honcho::group.create', // will use "default" if empty
		));

		// now let's redirect back to the create form
		return Redirect::route(Config::get('honcho::group.create.redirect_failed'))
			->withInput();
	}

	/**
	 * View a Groups's Details
	 *
	 * @param  string $group_id  our group's id
	 *
	 * @return View
	 */
	public function getDelete($group_id = '')
	{
		try
		{
			// fetch the group
			$data['group'] = Sentry::getGroupProvider()->findById($group_id);// set our page title

			// set our section and default title
			// This will be used for navigation items.
			Settings::setMultiple(array(
				'page_title' => trans('honcho::group.delete.page_title'),
				'nav_section' => 'group'
			));

			// return our view with our group's data in there.
			return View::make(Config::get('honcho::group.delete.view'), $data);
		}
		catch (\Cartalyst\Sentry\groups\GroupNotFoundException $e)
		{
			$error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
			'container' => 'honcho::group.view', // will use "default" if empty
		));

		// redirect to the configured fail route
		return Redirect::route(Config::get('honcho::group.view.redirect_failed'));
	}

	/**
	 * View a Groups's Details
	 *
	 * @param  string $group_id  our group's id
	 *
	 * @return View
	 */
	public function getConfirmDelete($group_id = '')
	{
		try
		{
			// fetch the group
			$group = Sentry::getGroupProvider()->findById($group_id);// set our page title

			// set our name. this will be passed to our message just to make it friendlier.
			// once we delete the group, we will lose this groups data.
			$group_name = $group->name;

			// Delete the group
			if ($group->delete())
			{
				// add our error message
				Messages::add(trans('honcho::group.delete.success'), array(
					'template'  => 'success',
					'container' => 'honcho::group.index', // will use "default" if empty
				));

				// Group was successfully deleted
				return Redirect::route(Config::get('honcho::group.delete.redirect_success'));
			}
			else
			{
				// There was a problem deleting the group
				Messages::add(trans('honcho::group.delete.failed'), array(
					'template'  => 'error',
					'container' => 'honcho::group.view', // will use "default" if empty
				));

				// Group was successfully deleted
				return Redirect::route(Config::get('honcho::group.delete.redirect_failed'), array($group->id));
			}
		}
		catch (\Cartalyst\Sentry\groups\GroupNotFoundException $e)
		{
			$error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
			'container' => 'honcho::group.view', // will use "default" if empty
		));

		// redirect to the configured fail route
		return Redirect::route(Config::get('honcho::group.view.redirect_failed'));
	}

	/**
	 * Display form to update a Groups's Details
	 *
	 * @param  string $group_id  our group's id
	 *
	 * @return View
	 */
	public function getUpdate($group_id = '')
	{
		try
		{
			// fetch the group
			$data['group'] = Sentry::getGroupProvider()->findById($group_id);// set our page title

			// set our section and default title
			// This will be used for navigation items.
			Settings::setMultiple(array(
				'page_title' => trans('honcho::group.update.page_title'),
				'nav_section' => 'group'
			));

			// return our view with our group's data in there.
			return View::make(Config::get('honcho::group.update.view'), $data);
		}
		catch (\Cartalyst\Sentry\groups\GroupNotFoundException $e)
		{
			$error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
			'container' => 'honcho::group.update', // will use "default" if empty
		));

		// redirect to the configured fail route
		return View::make(Config::get('honcho::group.update.view'));
	}

	/**
	 * Handles updating our group.
	 *
	 * We will validate our input and attempt to update the group. On success we will be redirected
	 * to the group's page, on fail, we will go back to the update form with error message.
	 *
	 * @return Redirect
	 */
	public function postUpdate($group_id)
	{
		// create an instance of our form model
		$updateFormModel = Config::get('honcho::group.models.updateFormModel');

		// set the group id for our group form model
		$updateFormModel::$group_id = $group_id;

		// use our form model to validate the form.
		if ( ! $updateFormModel::is_valid())
		{
			// add our error message
			Messages::add('validation error', array(
				'template'  => 'validation',
			    'container' => 'honcho::group.update', // will use "default" if empty
			));

			// we've failed to update the group, so let's send them back to the form.
			return Redirect::route(Config::get('honcho::group.update.redirect_failed'), array($group_id))
				->withErrors($updateFormModel::$validation)
				->withInput();
		}

		// try to use sentry to update our group.
		try
		{
			// use our form model to generate our attributes that will be passed to Sentry
			// to create our new group.
			$attributes = $updateFormModel::generateAttributes();

			// Create the group
			$group = Sentry::getGroupProvider()->findById($group_id);

			if ($updateFormModel::saveObject($group))
			{
				// add our error message
				Messages::add(trans('honcho::group.update.success', array('name' => $group->name)), array(
					'template'  => 'success',
				    'container' => 'honcho::group.view', // will use "default" if empty
				));

				// we're all finished here, so let's go view our new group
				return Redirect::route(Config::get('honcho::group.update.redirect_success'), array($group_id));
			}
			else
			{
				// add our error message
				Messages::add(trans('honcho::group.update.success'), array(
					'template'  => 'error',
				    'container' => 'honcho::group.view', // will use "default" if empty
				));
			}
		}
		catch (Cartalyst\Sentry\groups\groupExistsException $e)
		{
		   $error = trans('honcho::group.update.login_already_exists', array('login_attribute' => Input::get('email')));
		}
		catch (\Cartalyst\Sentry\groups\groupNotFoundException $e)
		{
		    // add our error message
		    Messages::add(trans('honcho::group.update.group_not_found'), array(
		    	'template'  => 'error',
		        'container' => 'honcho::group.index', // will use "default" if empty
		    ));

		    // we've failed to update the group, so let's send them back to the form.
		    return Redirect::route('honcho::group.update.redirect_failed', array($group_id))
		    	->withInput();
		}

		// add our error message
		Messages::add($error, array(
			'template'  => 'error',
		    'container' => 'honcho::group.update', // will use "default" if empty
		));


		// we've failed to update the group, so let's send them back to the form.
		return Redirect::route('honcho::group.update.redirect_failed', array($group_id))
			->withInput();
	}

	/**
	 * Display form to update a Group's Users
	 *
	 * @param  string $group_id  our group's id
	 *
	 * @return View
	 */
	public function getUsers($group_id = '')
	{
		try
		{
			// fetch the group
			$data['group'] = Sentry::getGroupProvider()->findById($group_id);

			$selected_user_ids = array();

			// fetch the groups that the user belongs to
			foreach($data['group']->users as $group)
			{
				$selected_user_ids[] = $group->id;
			}

			$data['selected_users'] = $selected_user_ids;

			// set our section and default title
			// This will be used for navigation items.
			Settings::setMultiple(array(
				'page_title' => trans('honcho::group.users.page_title'),
				'nav_section' => 'group'
			));

			// return our view with our group's data in there.
			return View::make(Config::get('honcho::group.users.view'), $data);
		}
		catch (\Cartalyst\Sentry\groups\GroupNotFoundException $e)
		{
			$error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
			'container' => 'honcho::group.users', // will use "default" if empty
		));

		// redirect to the configured fail route
		return View::make(Config::get('honcho::group.users.view'));
	}

	public function postUsers($group_id = '')
	{
		try
		{
			// start by removing all of the current groups that the user belongs to.
			$affected  = DB::table('users_groups')
				->where('group_id', '=', $group_id)
				->delete();

			// get the groups from our update form input
			$new_users = Input::get('users', array());

			if ( ! empty($new_users))
			{
				// fetch our group
				$group = Sentry::getGroupProvider()->findById($group_id);

				foreach($new_users as $user_id)
				{
					$user = Sentry::getUserProvider()->findById($user_id);

					$user->addGroup($group);
				}
			}

		   // add our error message
		   Messages::add(trans('honcho::group.users.success'), array(
		   		'template'  => 'success',
		   		'container' => 'honcho::group.view', // will use "default" if empty
		   ));

		    // return our view with our user's data in there.
		    return Redirect::route(Config::get('honcho::group.users.redirect_success'), array($group_id));
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $error = $e->getMessage();
		}

		// add our error message
		Messages::add($e->getMessage(), array(
			'template'  => 'error',
		    'container' => 'honcho::group.users', // will use "default" if empty
		));

		// return our view with our user's data in there.
	    return Redirect::route(Config::get('honcho::group.users.redirect_failed'), array($user_id));
	}
}