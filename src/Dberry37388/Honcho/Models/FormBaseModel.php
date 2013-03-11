<?php namespace Dberry37388\Honcho\Models;

use Input;

/**
 * form-base-model : A form base model for use with the Laravel PHP framework.
 *
 * @package  laravel-form-base-model
 * @version  1.5
 * @author   Shawn McCool <shawn@heybigname.com>
 * @link     https://github.com/shawnmccool/laravel-form-base-model
 */

abstract class FormBaseModel
{
	/**
	 * The internal field_data array used for storing persistent data
	 * across multi-page forms.
	 *
	 * @var array
	 */
	public static $field_data = array();

	/**
	 * The rules array stores Validator rules in an array indexed by
	 * the field_name to which the rules should be applied.
	 *
	 * @var array
	 */
	public static $rules = array();

	/**
	 * The messages array stores Validator messages in an array indexed by
	 * the field_name to which the messages should be applied in case of errors.
	 *
	 * @var array
	 */
	public static $messages = array();

	/**
	 * The validation object is stored here once is_valid() is run.
	 * This object is publicly accessible so that it can be used
	 * to redirect with errors.
	 *
	 * @var object
	 */
	public static $validation = false;

	/**
	 * True if custom validators have been loaded.
	 *
	 * @var object
	 */
	public static $custom_validators_loaded = null;

	/**
	 * This method can be overridden in order to add custom validators, generate
	 * custom validation messages with expressions, or whatever.
	 */
	public static function before_validation()
	{
	}

	/**
	 * Resets the form model to its vanilla form. Mostly used for tests.
	 */
	public static function reset()
	{
		static::$field_data               = array();
		static::$rules                    = array();
		static::$messages                 = array();
		static::$validation               = false;
		static::$custom_validators_loaded = null;
	}

	/**
	 * Validates input data. Only fields present in the $fields array
	 * will be validated. Rules must be defined in the form model's
	 * static $rules array.
	 *
	 * <code>
	 * 		// define rules within the form model
	 * 		public static $rules = array( 'first_name' => 'required' );
	 *
	 *		// validate fields from the controller
	 *		$is_valid = ExampleForm::is_valid( array( 'first_name', 'last_name' ));
	 * </code>
	 *
	 * Tested
	 *
	 * @param  array   $fields
	 * @param  array   $input
	 * @return bool
	 */
	public static function is_valid( $fields = null, $input = null )
	{
		// run before_validation hook
		static::before_validation();

		// $fields must be an array or null, a null value represents
		// that all fields should be validated
		if( !is_array( $fields ) && !is_null( $fields ))
		{
			return false;
		}

		// if input is null then pull all input from the input class
		if( is_null( $input ))
		{
			$input = \Input::all();
		}

		// if $fields is an array then we need to walk through the
		// rules defined in the form model and pull out any that
		// apply to the fields that were defined
		if( is_array( $fields ))
		{
			$field_rules = array();

			foreach( $fields as $field_name )
			{
				if( array_key_exists( $field_name, static::$rules ))
				{
					$field_rules[$field_name] = static::$rules[$field_name];
				}
			}
		}
		else
		{
			// if $fields isn't an array then apply all rules
			$field_rules = static::$rules;
		}

		// if no rules apply to the fields that we're validating then
		// validation passes
		if( empty( $field_rules ))
		{
			return true;
		}

		// remove empty rules
		foreach( $field_rules as $field => $rules )
		{
			if( empty( $rules ))
			{
				unset( $field_rules[$field] );
			}
		}

		// generate the validator and return its success status
		static::$validation = \Validator::make( $input, $field_rules, static::$messages );

		return static::$validation->passes();
	}

	/**
	 * Generates our attributes read for insert based on our defined rules.
	 *
	 * By default, and fields that are included in the form model's $excluded array will not
	 * be present in the final $attributes array. However, if you really need access to one
	 * or more of those excluded fields, you can use the 'only' option to grab those fields.
	 *
	 * @return array
	 */

	public static function generateAttributes($option = '', $values = array())
	{
		// go ahead and get all of our input fields
		$input = Input::all();

		// get an array of keys from our static::$rules. We will use these
		// to populate our $attributes array
		$fields = array_keys(static::$rules);

		// go through each of our fields and if they are not in the static::$exclude let's
		// assign a key=>value pair for that attribute.
		foreach($fields as $field)
		{
			// makes sure it's not in the global exclude
			if ( ! in_array($field, static::$exclude) or ($option == 'only' and in_array($field, $values)))
			{
				$attributes[$field] = array_get($input, $field);
			}
		}

		// we have the ability to on the fly choose either to exclude or only get certain
		// fields. We'll switch our $option to check for this. By default it will return
		// all of the $attributes that have been assigned above.
		switch ($option)
		{
			// we want all of the values except for the ones we've specified.
			case 'except':

				// use the array_except helper to extract values that we do not want.
				if ( ! empty($values) and is_array($values))
				{
					return array_except($attributes, $values);
				}

				break;

			// we "only" want to get a subset of these values,
			case 'only':

				// use the array_except helper to extract values that we do not want.
				if ( ! empty($values) and is_array($values))
				{
					return array_only($attributes, $values);
				}

				break;

			// no specific except or only option has been specified, so we will
			default:
				return $attributes;
				break;
		}
	}

	public static function saveObject($object = '')
	{
		// get our attributes
		$attributes = static::generateAttributes($options = '', $values = array());

		foreach ($attributes as $key=>$value)
		{
			$object->$key = $value;
		}

		return $object->save();
	}
}