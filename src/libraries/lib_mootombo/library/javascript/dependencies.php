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
 * MFW Dependency Class
 * Support for Javascript dependencies (Load files from the media folder)
 *
 * Please note the example method at the bottom of this file!
 *
 *
 * To reduce massively the pageload, we try to load only those files we really need for a specific function.
 * Feel free to post any suggestion or pull request to the MOOTOBO!Framework branch on https://github.com/mootombo/Framework
 */
abstract class MFWJavascriptDependencies
{
	/**
	 * @var      string    Media folder name where local files should be loaded from
	 * @since    1.0
	 */
	protected static $libFolder = MFWDIRNAME . '/';

	/**
	 * @var    array  Array containing information for loaded files
	 * @since  1.0
	 */
	protected static $loaded = array();


	/**
	 * Framework File Importer Method
	 *
	 * @param     array    $files    Files to be load
	 *                                 Format:
	 *                                   $files->local:  For files stored in the library folder
	 *                                   $files->remote: For files stored anywhere in the web or in an other folder than the library folder
	 *
	 * @return    void
	 *
	 * @since   1.0
	 */
	function import( $files ) {
		if ( $files->local ) {
			foreach( $files->local as $file) {
				if ( preg_match('/\.css/', $file) ) {
					JHtml::_('stylesheet', self::$libFolder . $file, false, true);
				}

				if ( preg_match('/\.js/', $file) ) {
					JHtml::_('script', self::$libFolder . $file, false, true, false, false, $debug);
				}
			}
		}

		if ( $files->remote ) {
			foreach( $files->remote as $file) {
				if ( preg_match('/\.css/', $file) ) {
					JFactory::getDocument()->addStyle($file);
				}

				if ( preg_match('/\.js/', $file) ) {
					JFactory::getDocument()->addScript($file);
				}
			}
		}
	}


	/**
	 * JQueryUI
	 *
	 * @param     array      $options      jQueryUI options (optional)
	 *                                         theme: base|no-theme (Note: no-theme loads the no-theme.css files)
	 *                                         function: sortable|
	 *
	 * @param     mixed      $debug        Debug (Standard: null)
	 *
	 * @since   1.0
	 */
	public function jQueryUI( $options = array(), $debug = null )
	{
		$files = new StdClass();

		$sig = md5( serialize( array($options) ) );

		// Only load once
		if (isset(self::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// If no debugging value is set, use the configuration setting
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug = (boolean) $config->get('debug');
		}

		// Include JS framework (Core JQuery, Core Bootstrap)
		MFWCoreFramework::loadJS();

		$files->local = array(
			'local' => ''
		);

		$files->remote = array(
			'local' => ''
		);

		$theme = $options['theme'] ? $options['theme'] : false;

		self::import( $files );

		self::$loaded[__METHOD__][$sig] = true;

		return;
	}


	/**
	 * Example
	 *
	 * @param    array    $options    Options (optional)
	 * @param    mixed    $debug      Debug (Standard: null)
	 *
	 * @since    1.0
	 */
	public function example( $options = array(), $debug = null )
	{
		$files = new StdClass();

		$sig = md5( serialize( array($options) ) );

		// Only load once
		if (isset(self::$loaded[__METHOD__][$sig]))
		{
			return;
		}

		// If no debugging value is set, use the configuration setting
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug = (boolean) $config->get('debug');
		}

		// Include JS framework (Core JQuery, Core Bootstrap)
		MFWCoreFramework::loadJS();

		$files->local = array(
			'local.js',
			'local.css'
		);

		$files->remote = array(
			'http://remote.js',
			'http://remote.css'
		);

		self::import( $files );

		self::$loaded[__METHOD__][$sig] = true;

		return;
	}
}