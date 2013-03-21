<?php namespace Dberry37388\Honcho\Forms\Profile;

use Dberry37388\Honcho\Models\FormBaseModel;

class ChangePasswordFormModel extends FormBaseModel {

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
		'old_password'			=> 'required',
		'password' 				=> 'required|confirmed',
		'password_confirmation' => 'required',
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
	public static $exclude = array(
		'old_password',
		'password_confirmation'
	);
}