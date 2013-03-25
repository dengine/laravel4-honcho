<?php namespace Dberry37388\Honcho\Events;

use Config;

class ProfileEventHandler {

    /**
     * Handle user login events.
     */
    public function onProfileChangePassword($user)
    {
        // record this action to our user logs
        $user->logs()->create(array(
            'user_id'     => $user->id,
            'entry'       => trans('honcho::profile.changepassword.event_entry'),
            'modified_by' => $user->id
        ));
    }

    /**
     * Handle user logout events.
     */
    public function onProfileUpdate($user)
    {
        // record this action to our user logs
        $user->logs()->create(array(
            'user_id'     => $user->id,
            'entry'       => trans('honcho::profile.update.event_entry'),
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
        $events->listen('honcho.profile.changepassword', __CLASS__ . '@onProfileChangePassword');
        $events->listen('honcho.profile.update', __CLASS__ .'@onProfileUpdate');
    }

}