<?php namespace Dberry37388\Honcho\Facades;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'honcho.settings'; }

}