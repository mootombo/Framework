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
 
// Define version
if ( !defined('MFWVERSION') ) {
	$mfwversion = new MFWVersion();
	define( 'MFWVERSION', $mfwversion->getShortVersion() );
}

// Set the MOOTOMBO!Framework root path as a constant if necessary.
if (!defined('MFWPATH_FRAMEWORK'))
{
	define('MFWPATH_FRAMEWORK', JPATH_SITE . '/libraries/mfw');
}

// Set the MOOTOMBO!Framework media root path as a constant if necessary.
if (!defined('MFWPATH_MEDIA'))
{
	define('MFWPATH_MEDIA', JPATH_SITE . '/media/mfw');
}

// Define a legacy directory separator as a constant if not exist
if(!defined('DS')) {
	define('DS', '/');
}

// Init the factory if necessary.
if (!class_exists('MFWFactory'))
{
	require_once (MPATH_FRAMEWORK . '/factory.php');
}