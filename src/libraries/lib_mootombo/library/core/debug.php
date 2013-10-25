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
 * MOOTOMBO!Framework Debug class
 *
 * @package  Framework
 * @since    1.0
 */
abstract class MFWCoreDebug
{
	/**
	 * Global Debug Method
	 *
	 * @param     array      $debug    Debug (Standard: null)
	 *
	 * @return    boolean              Debug state
	 *
	 * @since     1.0
	 */
	function init( $debug = null ) {
		// If no debugging value is set, use the configuration setting
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug = (boolean) $config->get('debug');
		}

		return $debug;
	}
}