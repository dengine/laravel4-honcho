<?php

return array(
	// sets the controller we will be using.
	// If left blank, we will default to Honcho's built-in controllers
	'controller' => 'Dberry37388\Honcho\Controllers\ProfileController',

	'models' => array(
		'changePasswordFormModel' => 'Dberry37388\Honcho\Forms\Profile\ChangePasswordFormModel',
		'updateFormModel'         => 'Dberry37388\Honcho\Forms\Profile\UpdateFormModel'
	),

	// our index action
	'index' => array(
		'view' => 'honcho::profile.index'
	),

	'changepassword' => array(

		// view to display
		'view' => 'honcho::profile.changepassword',

		// where to send the user on success
		'redirect_success' => 'honcho.profile',

		// where to send the user on fail
		'redirect_failed'  => 'honcho.profile.changepassword'
	),

	'update' => array(

		// view to display
		'view' => 'honcho::profile.update',

		// where to send the user on success
		'redirect_success' => 'honcho.profile',

		// where to send the user on fail
		'redirect_failed'  => 'honcho.profile.update'
	)
);