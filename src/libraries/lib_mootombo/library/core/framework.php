<?php
/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          Framework
 * @subPackage	Library
 * @version		1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 */

// no direct access
defined('_MFWRA') or die;

/**
 * MFW Main Framework Class
 *
 */
abstract class MFWCoreFramework
{
	/**
	 * @var    array  Array containing information for loaded files
	 * @since  1.0
	 */
	protected static $loaded = array();


	/**
	 * Method to load the entire framework in noConflict mode into the document head
	 *
	 * If debugging mode is on an uncompressed version of Bootstrap is included for easier debugging.
	 *
	 * @param   mixed	$debug  Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public static function loadMFW( $debug = null )
	{
		self::loadJs( true, $debug );
		self::loadCss( true, true, 'ltr', array(), $debug );
	}

	/**
	 * Method to load the Bootstrap JavaScript framework into the document head
	 *
	 * If debugging mode is on an uncompressed version of Bootstrap is included for easier debugging.
	 *
	 * @param   boolean	$noConflict  True to load jQuery in noConflict mode [optional]
	 * @param   mixed	$debug  Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public static function loadJs( $noConflict = true, $debug = null )
	{
		// Only load once
		if ( !empty(self::$loaded[__METHOD__]) )
		{
			return;
		}

		// If no debugging value is set, use the configuration setting
		if ( $debug === null )
		{
			$config = JFactory::getConfig();
			$debug = (boolean) $config->get('debug');
		}

		// Load jQuery
		if ( !$debug ) {
			JHtml::_('script', 'media/' . MFWDIRNAME . '/package/jquery/core/jquery.min.js', false, false, false, false, $debug);
		} else {
			JHtml::_('script', 'media/' . MFWDIRNAME . '/package/jquery/core/jquery.js', false, false, false, false, $debug);
		}

		// Check if we are loading in noConflict
		if ( $noConflict )
		{
			JHtml::_('script', 'media/' . MFWDIRNAME . '/package/jquery/core/jquery-noconflict.js', false, false, false, false, $debug);
		}

		if ( !$debug ) {
			JHtml::_('script', 'media/' . MFWDIRNAME . '/package/bootstrap/js/bootstrap.min.js', false, false, false, false, $debug);
		} else {
			JHtml::_('script', 'media/' . MFWDIRNAME . '/package/bootstrap/js/bootstrap.js', false, false, false, false, $debug);
		}

		self::$loaded[__METHOD__] = true;

		return;
	}


	/**
	 * Loads CSS files needed by Bootstrap
	 *
	 * @param     boolean    $includeMainCss    If true, main bootstrap.css files are loaded
	 * @param     string     $direction         rtl or ltr direction. If empty, ltr is assumed
	 * @param     array      $attribs           Optional array of attributes to be passed to JHtml::_('stylesheet')
	 *
	 * @return    void
	 *
	 * @since   1.0
	 */
	public static function loadCss( $includeMainCss = true, $includeThemeCss = true, $direction = 'ltr', $attribs = array(), $debug = null )
	{
		// Only load once
		if ( !empty(self::$loaded[__METHOD__]) )
		{
			return;
		}

		// If no debugging value is set, use the configuration setting
		if ( $debug === null )
		{
			$config = JFactory::getConfig();
			$debug = (boolean) $config->get('debug');
		}

		// Load Bootstrap main CSS
		if ( $includeMainCss )
		{
			if ( !$debug ) {
				JHtml::_('stylesheet', 'media/' . MFWDIRNAME . '/package/bootstrap/css/bootstrap.min.css', $attribs, false);
			} else {
				JHtml::_('stylesheet', 'media/' . MFWDIRNAME . '/package/bootstrap/css/bootstrap.css', $attribs, false);
			}
		}

		// Load Bootstrap theme CSS
		if ( $includeThemeCss )
		{
			if ( !$debug ) {
				JHtml::_('stylesheet', 'media/' . MFWDIRNAME . '/package/bootstrap/css/bootstrap-theme.min.css', $attribs, false);
			} else {
				JHtml::_('stylesheet', 'media/' . MFWDIRNAME . '/package/bootstrap/css/bootstrap-theme.css', $attribs, false);
			}
		}


// TODO: Check Support for RTL
//		// Load Bootstrap RTL CSS
//		if ( $direction === 'rtl' )
//		{
//			JHtml::_('stylesheet', MFWDIRNAME . '/bootstrap-rtl.css', $attribs, true);
//		}

		self::$loaded[__METHOD__] = true;

		return;
	}


	/**
	 * Internal method to get a JavaScript object notation string from an array
	 *
	 * @param   array  $array  The array to convert to JavaScript object notation
	 *
	 * @return  string  JavaScript object notation representation of the array
	 *
	 * @since   13.6
	 */
	public static function getJSObject(array $array = array())
	{
		$elements = array();

		foreach ($array as $k => $v)
		{
			// Don't encode either of these types
			if (is_null($v) || is_resource($v))
			{
				continue;
			}

			// Safely encode as a Javascript string
			$key = json_encode((string) $k);

			if (is_bool($v))
			{
				$elements[] = $key . ': ' . ($v ? 'true' : 'false');
			}
			elseif (is_numeric($v))
			{
				$elements[] = $key . ': ' . ($v + 0);
			}
			elseif (is_string($v))
			{
				if (strpos($v, '\\') === 0)
				{
					// Items such as functions and JSON objects are prefixed with \, strip the prefix and don't encode them
					$elements[] = $key . ': ' . substr($v, 1);
				}
				else
				{
					// The safest way to insert a string
					$elements[] = $key . ': ' . json_encode((string) $v);
				}
			}
			else
			{
				$elements[] = $key . ': ' . self::getJSObject(is_object($v) ? get_object_vars($v) : $v);
			}
		}

		return '{' . implode(',', $elements) . '}';

	}
}