<?php namespace Dberry37388\Honcho\Forms\User;

use Dberry37388\Honcho\Models\FormBaseModel;
use Config;

class UpdateFormModel extends FormBaseModel {

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
		'email' 				=> 'required|email|unique:users',
		'username' 				=> 'required|username|unique:users',
		'first_name' 			=> 'required',
		'last_name'  			=> 'required',
	);

	/**
	 * Holds the id of the user we are updating
	 *
	 * This will be set in the controller or model requesting the update.
	 * Once updated, the before_validation will apply the changes to our
	 * username and email rules.
	 *
	 * @var int
	 */

	public static $user_id = null;

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

	public static $exclude = array(
		'password_confirmation'
	);

	/**
	 * Change our validation rules before we run our validation
	 *
	 * We are updating the user, so when doing our validation for our username and email,
	 * we need to allow the user to save their own username and password, so we are adding the
	 * user's id key to the unique rule here.
	 *
	 * @return void
	 */

	public static function before_validation()
	{
		static::$rules['email']    = 'required|email|unique:users,email,'.static::$user_id;
		static::$rules['username'] = 'required|username|unique:users,username,'.static::$user_id;
	}


}