<?php namespace Dberry37388\Honcho\Support;

use Config;
use Request;

class Settings {

	/**
	 * Get's a value from our config
	 *
	 * @param  string  $value  key for the item we are retrieving
	 *
	 * @return string
	 */
	public function get($key)
	{
		return Config::get('honcho::site.' . $key);
	}

	/**
	 * Sets a value
	 *
	 * @param string  $key    item we are setting
	 * @param string  $value  value to set item to
	 *
	 * @return void
	 */
	public function set($key, $value = '')
	{
		Config::set('honcho::site.'.$key, $value);
	}

	public function setMultiple($items = array())
	{
		if ( ! empty($items) and is_array($items))
		{
			foreach ($items as $key=>$value)
			{
				$this->set($key, $value);
			}
		}
	}

	/**
	 * Gets the Site Name
	 *
	 * @return string
	 */
	public function getSiteName()
	{
		return $this->get('site_name');
	}

	/**
	 * Sets our page title for the current view
	 *
	 * @param  string  $value  page title
	 *
	 * @return string
	 */
	public function setPageTitle($value = '')
	{
		Config::set('honcho::site.page_title', $value);
	}

	/**
	 * Gets our page title
	 *
	 * @return string
	 */
	public function getPageTitle()
	{
		return $this->get('page_title');
	}

	/**
	 * Gets our page title
	 *
	 * @return string
	 */
	public function getCopyright()
	{
		return $this->get('copyright');
	}

	public function getSection()
	{
		return $this->get('section');
	}

	/**
	 * Check to see if section matches
	 * @param  string  $value  value we are checking
	 *
	 * @return boolean
	 */
	public function isSection($needle, $css = null)
	{
		if ($needle == $this->get('section'))
		{
			if (! empty($css))
			{
				return $css;
			}

			return true;
		}

		return false;
	}

	/**
	 * Check to see if section matches
	 * @param  string  $value  value we are checking
	 *
	 * @return boolean
	 */
	public function isNavSection($needle, $css = null)
	{
		if ($needle == $this->get('nav_section'))
		{
			if (! empty($css))
			{
				return $css;
			}

			return true;
		}

		return false;
	}

	/**
	 * Check to see if string matches our current uri request
	 *
	 * @param  string  $value  value we are checking
	 *
	 * @return boolean
	 */
	public function isUri($needle, $css = null)
	{
		if (Request::is($needle))
		{
			if (! empty($css))
			{
				return $css;
			}

			return true;
		}

		return false;
	}
}