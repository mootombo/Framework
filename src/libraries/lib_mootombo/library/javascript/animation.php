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
 * MOOTOMBO!Framework Javascript class
 *
 * @package  Framework
 * @since    1.0
 */
abstract class MFWJavascriptAnimation
{
	/**
	 * @var    array  Array containing information for loaded files
	 * @since  1.0
	 */
	protected static $loaded = array();

	/**
	 * Add javascript and css support for icon animations.
	 *
	 * @param     string    $selector    Common class/id for the wrapping element (Standard Class: a) - icon-animations mainly used in header or sidebar navigation
	 * @param     array     $closet      If "closet" is set to true, then icon animation class will be removed on click.
	 *
	 * @return    void
	 *
	 * @since     1.0
	 */
	public function loadIcon( $selector = 'a', $closet = true )
	{
		$sig = md5( serialize( array($selector, $closet) ) );

		// Only load once
		if (isset(self::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// Load Dependencies
		MFWJavascriptDependencies::loadIcon();

		// Setup options object
//		$opt['bindings'] = (isset($params['bindings']) && ($params['bindings'])) ? $params['bindings'] : null;

//		$options = NFWHtml::getJSObject($opt);

		if ( $closet ) {
			// Attach the function to the document
			JFactory::getDocument()->addScriptDeclaration(
				"jQuery(function($){
					$('[class*=\"icon-animated-\"]').parents('" . $selector . "').on('click', function(e) {
						e.preventDefault();

						var icon = $(this).find('[class*=\"icon-animated-\"]').eq(0);
						var match = icon.attr('class').match(/icon\-animated\-([\d\w]+)/);

						icon.removeClass(match[0]);
						$(this).off('click');
					});
				});\n"
			);
		}

		self::$loaded[__METHOD__][$sig] = true;

		return;
	}
}