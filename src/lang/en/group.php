<?php

return array(

	'index' => array(
		'page_title' => 'View All Groups',
	),
	'create' => array(
		'page_title' => 'Create a New Group',
		'group_already_exists' => '<h4>Oops, an Error Occurred</h4> A group named <strong>:name</strong> already exists. Please choose a different name.',
		'success' => '<h4>Group Created!</h4> You have successfully created a group named <strong>:name</strong>.',
	),
	'view' => array(
		'page_title' => 'View Group Details',
		'group_not_found' => '<h4>Oops, Group Not Found.</h4> Sorry, but we could not find the group that you were trying to view.'
	),

	'delete' => array(
		'page_title' => 'Delete Group',
		'success' => '<h4>Group Successfully Deleted</h4> You have successfully deleted the  <strong>:name</strong> group. Please remember to update an access rules that contain this group.'
	),

	'update' => array(
		'page_title' => 'Update Group Details',
		'success' => '<h4>Group Updated!</h4> You have successfully updated the <strong>:name</strong> group.',
		'failed' => '<h4>An Error Occured</h4> Oops, something went wrong while attempting to update the <strong>:name</strong> group. If the problem persists, please contact support.',
		'group_not_found' => '<h4>Oops, Group Not Found.</h4> Sorry, but we could not find the group that you were trying to update.'
	)

);