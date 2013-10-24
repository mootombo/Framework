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
 * Version information class for the MOOTOMBO!Framework.
 */
final class MFW
{
	// Product name.
	const MFWPRODUCT = 'MOOTOMBO!RDK';

	// Release version.
	const MFWRELEASE = '1.0';

	// Maintenance version.
	const MFWMAINTENANCE = '0';

	// Development STATUS.
	const MFWSTATUS = 'Alpha';

	// Build number.
	const MFWBUILD = 0;

	// Code name.
	const MFWCODE_NAME = 'Bagong Simula';

	// Release date.
	const MFWRELEASE_DATE = '2013-11-01';

	// Release time.
	const MFWRELEASE_TIME = '10:00';

	// Release timezone.
	const MFWRELEASE_TIME_ZONE = 'GMT';

	// Copyright Notice.
	const MFWCOPYRIGHT = 'Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.';

	// Link text.
	const MFWLINK_TEXT = '<a href="http://devxive.com/mootombo/framework">The MOOTOMBO!Framework</a> is Free Software released under the GNU General Public License.';

	/**
	 * Compares two a "PHP standardized" version number against the current MOOTOMBO!Framework version.
	 *
	 * @param     string     $minimum    The minimum version of the MOOTOMBO!Framework which is compatible.
	 *
	 * @return    boolean                True if the version is compatible.
	 *
	 * @see                              http://www.php.net/version_compare
	 */
	public static function isCompatible($minimum)
	{
		return (version_compare(self::getShortVersion(), $minimum, 'eq') == 1);
	}

	/**
	 * Gets a "PHP standardized" version string for the current MOOTOMBO!Framework.
	 *
	 * @return    string    Version string.
	 */
	public static function getShortVersion()
	{
		return self::MFWRELEASE . '.' . self::MFWMAINTENANCE;
	}

	/**
	 * Gets a version string for the current MOOTOMBO!Framework with all release information.
	 *
	 * @return    string    Complete version string.
	 */
	public static function getLongVersion()
	{
		return self::MFWPRODUCT . ' ' . self::MFWRELEASE . '.' . self::MFWMAINTENANCE . ' ' . self::MFWSTATUS . ' [ ' . self::MFWCODE_NAME . ' ] ' . self::MFWRELEASE_DATE . ' ' . self::MFWRELEASE_TIME . ' ' . self::MFWRELEASE_TIME_ZONE;
	}
}