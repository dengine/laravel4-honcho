<?php

return array(

	// sets the controller we will be using.
	// If left blank, we will default to Honcho's built-in controllers
	'controller' => 'Dberry37388\Honcho\Controllers\AuthController',

	// our login controller
	'login' => array(
		'view' => 'honcho::auth.login',

		// where to send the user on successful login
		'redirect_success' => 'honcho.profile',

		// where to send the user on failed login
		'redirect_failed' => 'login'
	),

	'logout' => array(
		'redirect_success' => 'login'
	)
);