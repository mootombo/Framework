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
 * MOOTOMBO!Framework plugin class.
 *
 * @package     Mootombo.plugin
 * @subpackage  System.mootombo
 */
class plgSystemMootombo extends JPlugin
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
		JLoader::registerPrefix('MFW', JPATH_LIBRARIES . '/mootombo');


		// Do some extra initialisation in this constructor if required

		// Define version
		if ( !defined('MFWVERSION') ) {
			$mfwversion = new MFWCoreVersion();
			define( 'MFWVERSION', $mfwversion->getShortVersion() );
			define( 'MFWINFO', $mfwversion->getLongVersion() );
			define( 'MFWLINK', MFWCoreVersion::MFWLINK_TEXT );
		}

		// Set the Framework directory name as a constant if necessary.
		if (!defined('MFWDIRNAME'))
		{
			define('MFWDIRNAME', 'mootombo');
		}

		// Set the MOOTOMBO!Framework root path as a constant if necessary.
		if (!defined('MFWPATH_FRAMEWORK'))
		{
			define('MFWPATH_FRAMEWORK', JPATH_SITE . '/libraries/' . MFWDIRNAME);
		}

		// Set the MOOTOMBO!Framework media root path as a constant if necessary.
		if (!defined('MFWPATH_MEDIA'))
		{
			define('MFWPATH_MEDIA', JPATH_SITE . '/media/' . MFWDIRNAME);
		}

		// Define a legacy directory separator as a constant if not exist
		if(!defined('DS')) {
			define('DS', '/');
		}

		// Init the factory if necessary.
		if (!class_exists('MFWFactory'))
		{
			require_once (MFWPATH_FRAMEWORK . '/factory.php');
		}
	}


	/**
	 * return  void
	 */
	public function onAfterInitialise()
	{
		if ( JFactory::getApplication()->isSite() ) {
			// Load the JS/CSS Framework
			MFWCoreFramework::loadMFW();
		}
	}


	/**
	 * return  void
	 */
	public function onBeforeCompileHead()
	{
		MFWHtmlHead::test();

		// TODO: Load Extra header information on site and admin! (Extra Viewports, facebook, google, windows, apple, etc....)
	}
}