<?php

return array(

	// what field will we be using for our login column?
	// This will also update the Sentry  config file in app/config/packages/cartalyst/sentry/sentry.php
	'login_attribute' => 'email',

	/**
	 * Regexes for our custom validators.
	 */
	'validation' => array(

		'username' => array(
			'regex' => array(
				'/^[a-z\d_\-.]{5,20}$/i', // lowercase letters, numbers and dashes
			),
		),

		// custom regex for password. we will loop through these in the custom validator.
		'password' => array(
			'regex' => array(
				'/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/'
			),
		),
	),

	'index' => array(
		'view' => 'honcho::user.index'
	),

	// config for our create action
	'create' => array(

		// our view
		'view' => 'honcho::user.create',

		// where we will be sending the user on success
		'redirect_success' => 'honcho.user.view',

		// where to send the user on fail
		'redirect_failed' => 'honcho.user.create',

		// are we requiring the user to verify their account via email?
		// false by default, since you are the admin creating the account, but it is an
		// option here in case you want it.
		'require_activation' => false
	),

	// config for our create action
	'update' => array(

		// our view
		'view' => 'honcho::user.update',

		// where we will be sending the user on success
		'redirect_success' => 'honcho.user.view',

		// where to send the user on fail
		'redirect_failed' => 'honcho.user.update',
	),

	'view' => array(
		// our view
		'view' => 'honcho::user.view',

		// where to send the user on fail
		'redirect_failed' => 'honcho.user.dashboard',
	),

	// config for our groups action
	'groups' => array(

		// our view
		'view' => 'honcho::user.groups',

		// where we will be sending the user on success
		'redirect_success' => 'honcho.user.view',

		// where to send the user on fail
		'redirect_failed' => 'honcho.user.groups',
	),
);