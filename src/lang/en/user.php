<?php

return array(
	'create' => array(
		'page_title' => 'Create a New User',
		'login_attribute_required' => 'An email address is required for this user.',
		'password_attribute_required' => 'A password is required to create this user.',
		'user_already_exists' => 'Oops, a user with the email address :login_column, already exists.',
	),

	'update' => array(
		'page_title' => 'Update User',
		'login_already_exists' => 'The :login_attribute you entered (:login_value) already exists.',
		'user_not_found' => 'Sorry, we could not find the user that you tried to update.',
		'success' => 'User was successfully updated.'
	),

	'view' => array(
		'page_title' => 'View User',
	),

	'index' => array(
		'page_title' => 'Manage Users',
	),

	'groups' => array(
		'success' => '<h4>Success!</h4> You have successfully updated this user\'s groups.',
	)
);