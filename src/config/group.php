<?php

return array(

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

	// config for our groups action
	'groups' => array(

		// our view
		'view' => 'honcho::group.groups',

		// where we will be sending the group on success
		'redirect_success' => 'honcho.group.view',

		// where to send the group on fail
		'redirect_failed' => 'honcho.group.groups',
	),
);