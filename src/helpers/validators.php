<?php

// validates our username against a set of regexes defined in the honcho config file
Validator::extend('username', function($attribute, $value, $parameters)
{
	// get our configured regexes for the username
	$regexes = Config::get('honcho::user.validation.username.regex');

	foreach ($regexes as $regex)
	{
		// go through our regexes
		if ( ! preg_match($regex, $value))
		{
			return false;
		}

		return true;
	}
});

// // validates our password against a set of regexes defined in the honcho config file
Validator::extend('password', function($attribute, $value, $parameters)
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
});