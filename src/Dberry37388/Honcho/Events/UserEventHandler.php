<?php namespace Dberry37388\Honcho\Events;

class UserEventHandler {

	/**
	 * Handle user login events.
	 */
	public function onView($user, $modified_by)
	{
		// record this action to our user logs
		$user->logs()->create(array(
			'user_id'     => $user->id,
			'entry'       => trans('honcho::user.view.event_entry'),
			'modified_by' => $modified_by
		));

		$user->save();
	}

	/**
	 * Handle user login events.
	 */
	public function onCreate($user, $modified_by)
	{
		// record this action to our user logs
		$user->logs()->create(array(
			'user_id'     => $user->id,
			'entry'       => trans('honcho::user.create.event_entry'),
			'modified_by' => $modified_by
		));

		$user->save();
	}

	/**
	 * Handle user login events.
	 */
	public function onUpdate($user, $modified_by)
	{
		// record this action to our user logs
		$user->logs()->create(array(
			'user_id'     => $user->id,
			'entry'       => trans('honcho::user.update.event_entry'),
			'modified_by' => $modified_by
		));

		$user->save();
	}

	/**
	 * Handle user login events.
	 */
	public function onGroups($user, $modified_by)
	{
		// record this action to our user logs
		$user->logs()->create(array(
			'user_id'     => $user->id,
			'entry'       => trans('honcho::user.groups.event_entry'),
			'modified_by' => $modified_by
		));

		$user->save();
	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 * @return array
	 */
	public static function subscribe($events)
	{
		// listen for our events
		$events->listen('honcho.user.view', __CLASS__ . '@onView');
		$events->listen('honcho.user.create', __CLASS__ . '@onCreate');
		$events->listen('honcho.user.update', __CLASS__ . '@onUpdate');
		$events->listen('honcho.user.groups', __CLASS__ . '@onGroups');
	}

}