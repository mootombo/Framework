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
defined('_JEXEC') or die();
 
/**
 * MFW plugin class.
 *
 * @package     MFW.plugin
 * @subpackage  System.mfw
 */
class plgSystemMfw extends JPlugin
{
	/**
	 * Constructor.
	 *
	 * @access protected
	 * @param object $subject The object to observe
	 * @param array   $config  An array that holds the plugin configuration
	 * @since 1.0
	 */
	public function __construct( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		if (!defined('_MFWRA')) {
			define('_MFWRA', 1);
		}

		// Register the library.
		JLoader::registerPrefix('MFW', JPATH_LIBRARIES . '/mfw');

		// Do some extra initialisation in this constructor if required
	}

	/**
	 * return  void
	 */
	public function onAfterInitialise()
	{
	}
}