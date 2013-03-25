<?php namespace Dberry37388\Honcho\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Config;

class User extends SentryUserModel {

	/**
	 * Returns the relationship between users and groups.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function logs()
	{
		// sets our logs model
		$logsModel = Config::get('honcho::log.user.model');

		return $this->hasMany($logsModel, 'user_id');
	}

}