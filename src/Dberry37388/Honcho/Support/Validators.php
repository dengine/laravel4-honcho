<?php namespace Dberry37388\Honcho\Support;

use Illuminate\Validation\Validator;

class Validators extends Validator {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Makes sure our username matches our regex.
	 * The regex is defined in the Honcho config file
	 */
	public function validateUsername($attribute, $value, $parameters)
	{
		// get our configured regexes for the username
		$regexes = Config::get('honcho::users.validation.username.regex');

		foreach ($regexes as $regex)
		{
			// go through our regexes
			if ( ! preg_match($regex, $value))
			{
				return false;
			}

			return true;
		}
	}

	/**
	 * Makes sure our password matches our regex.
	 * The regex is defined in the Honcho config file
	 */
	public function validatePassword($attribute, $value, $parameters)
	{
		// grab our regexes defined in our config file.
		$regexes = Config::get('honcho::users.validation.password.regex');

		// go through each regex until one doesn't match. If all match, then we
		// will return true.
		foreach ($regexes as $regex)
		{
			// go through our regexes
			if ( ! preg_match_all($regex, $value, $o) < 1)
			{
				return false;
			}
		}

		return true;
	}

}