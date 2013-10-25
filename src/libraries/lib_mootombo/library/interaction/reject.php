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
 * MOOTOMBO!Framework Interaction class
 *
 * @package  Browser
 * @since    1.0
 */
abstract class MFWInteractionBrowser
{
	/**
	 * @var    array  Array containing information for loaded files
	 * @since  1.0
	 */
	protected static $loaded = array();

	/**
	 * Add javascript functions for right click context menus
	 *
	 * @param     string    $selector    Common id for the contextmenu
	 * @param     array     $params      Time in milliseconds the alert box should remove
	 *
	 * @return    void
	 *
	 * @since     1.0
	 */
	public function load( $selector = 'bsxContextMenu', $target = '.bsxCMTarget', $params = array() )
	{
		$sig = md5( serialize( array($selector, $params) ) );

		// Only load once
		if (isset(self::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// Load Dependencies
		MFWJavascriptDependencies::reject();

		// Setup options object
//		$opt['bindings'] = (isset($params['bindings']) && ($params['bindings'])) ? $params['bindings'] : null;

//		$options = NFWHtml::getJSObject($opt);

		// Attach the function to the document
//		JFactory::getDocument()->addScriptDeclaration(
//			"jQuery(function($){
//				$('#." . $selector . "').bsxContextMenu('" . $target . "', " . $options . ");
//			});\n"
//		);

		self::$loaded[__METHOD__][$sig] = true;

		return;
	}
}