<?php

return array(

	// our form models. We have them here in a config so that they can be overridden
	'models' => array(
		'createFormModel' => '\Dberry37388\Honcho\Forms\Group\CreateFormModel',
		'updateFormModel' => '\Dberry37388\Honcho\Forms\Group\UpdateFormModel'
	),

	'index' => array(
		'page_title' => 'Manage Your Groups',
		'view' => 'honcho::group.index'
	),

	// config for our create action
	'create' => array(

		// our view
		'view' => 'honcho::group.create',

		// where we will be sending the group on success
		'redirect_success' => 'honcho.group.view',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group.create',

		// are we requiring the group to verify their account via email?
		// false by default, since you are the admin creating the account, but it is an
		// option here in case you want it.
		'require_activation' => false
	),

	// config for our create action
	'update' => array(

		// our view
		'view' => 'honcho::group.update',

		// where we will be sending the group on success
		'redirect_success' => 'honcho.group.view',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group.update',
	),

	'view' => array(
		// our view
		'view' => 'honcho::group.view',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group',
	),

	'delete' => array(
		// our view
		'view' => 'honcho::group.delete',

		// where to send the user on success
		'redirect_success' => 'honcho.group',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group.view',
	),

	// config for our users action
	'users' => array(

		// our view
		'view' => 'honcho::group.users',

		// where we will be sending the group on success
		'redirect_success' => 'honcho.users.view',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group.users',
	),
);