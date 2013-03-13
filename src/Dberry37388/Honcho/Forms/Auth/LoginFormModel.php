<?php namespace Dberry37388\Honcho\Forms\Auth;

use Dberry37388\Honcho\Models\FormBaseModel;

class LoginFormModel extends FormBaseModel {

	public static $rules = array(
		'login_column' => array('required'),
		'password' => array('required')
	);
}