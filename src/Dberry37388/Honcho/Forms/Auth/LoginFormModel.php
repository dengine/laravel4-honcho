<?php namespace Dberry37388\Honcho\Forms\Auth;

use Dberry37388\Honcho\Models\FormBaseModel;

class LoginFormModel extends FormBaseModel {

	/**
	 * Holds our Validation rules
	 *
	 * Use the standard Laravel validation rules or your custom validation rules.
	 *
	 * Fields listed here can also be used to generate your attributes array for filling your
	 * data models by using the generateAttributes() method.
	 *
	 * @var array
	 */
	public static $rules = array(
		'login_column' => array('required'),
		'password' => array('required')
	);

	/**
	 * Fields that we want to exclude from the generateAttributes method.
	 *
	 * These are fields like password_confirmation, etc that are not actually part of the
	 * data that should be included.
	 *
	 * In general, these are fields that you will never need to have returned to your model for
	 * your insert, update, delete, etc... They are normally fields like password_confirmation,
	 * a captcha or terms agreement, etc...
	 *
	 * If for some reason you do need one of these fields, you can add it to your 'only' array
	 * and it will override this.  This is an abnormal case though.
	 *
	 * @var array
	 */

	protected static $exclude = array();

	/**
	 * Holds our login attribute
	 *
	 * @var string
	 */
	public static $login_column = 'email';

	/**
	 * Class Constructor
	 *
	 * Again, not doing much here, but since I can't use a class method when I set the static var,
	 * I need to declare it somewhere and this seems like a good spot to do that.
	 */
	public function __construct()
	{
		// set our login column to match Sentry's configured login value
		static::$login_column = Config::get('cartalyst/sentry::sentry.users.login_attribute');
	}
}