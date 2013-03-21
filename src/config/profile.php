<?php

return array(
	// sets the controller we will be using.
	// If left blank, we will default to Honcho's built-in controllers
	'controller' => 'Dberry37388\Honcho\Controllers\ProfileController',

	'models' => array(
		'changePasswordFormModel' => 'Dberry37388\Honcho\Forms\Profile\ChangePasswordFormModel'
	),

	// our index action
	'index' => array(
		'view' => 'honcho::profile.index'
	),

	'changepassword' => array(
		'view' => 'honcho::profile.changepassword'
	)
);