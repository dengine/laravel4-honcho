<?php namespace Dberry37388\Honcho\Models;

use Eloquent;

class UserLog extends Eloquent {

	/**
	 * Holds our table name
	 * @var string
	 */
	protected $table = 'users_logs';


	/**
	 * Returns the relationship between users and logs.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function user()
    {
    	// sets our user model
    	$userModel = Config::get('cartalyst/sentry::sentry.users.model');

        return $this->belongsTo($userModel);
    }
}