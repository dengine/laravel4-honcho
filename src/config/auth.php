<?php

return array(

	// our login controller
	'login' => array(
		'view' => 'honcho::auth.login',

		// where to send the user on successful login
		'redirect_success' => 'profile',

		// where to send the user on failed login
		'redirect_failed' => 'login'
	)
);