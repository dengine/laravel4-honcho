<?php namespace Dberry37388\Honcho\Events;

use DateTime;

class AuthEventHandler {

    /**
     * Handle user login events.
     */
    public function onAuthLogin($user)
    {
        // record this action to our user logs
        $user->logs()->create(array(
            'user_id'     => $user->id,
            'entry'       => trans('honcho::auth.login.event_entry'),
            'modified_by' => $user->id
        ));

        $user->last_login = new DateTime;
        $user->save();
    }

    /**
     * Handle user logout events.
     */
    public function onAuthLogout($user)
    {
        // record this action to our user logs
        $user->logs()->create(array(
            'user_id'     => $user->id,
            'entry'       => trans('honcho::auth.logout.event_entry'),
            'modified_by' => $user->id
        ));
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
        $events->listen('honcho.auth.login', __CLASS__ . '@onAuthLogin');
        $events->listen('honcho.auth.logout', __CLASS__ .'@onAuthLogout');
    }

}