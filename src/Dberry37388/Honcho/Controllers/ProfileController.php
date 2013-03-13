<?php namespace Dberry37388\Honcho\Controllers;

use Dberry37388\Honcho\Controllers\HonchoController;
use View;
use Config;
use Redirect;
use Sentry;
use Messages;

class ProfileController extends HonchoController {

	public function getIndex()
	{
		// return our dashboard view
		return View::make(Config::get('honcho::profile.index.view'));
	}
}