<?php
/**
  * @info          $Id$ - $Revision$
  * @package       $mootombo$
  * @subpackage    RDK
  * @author        $Author$ @ devXive - research and development <support@devxive.com>
  * @copyright     Copyright (C) 1997 - 2013 devXive - research and development (http://www.devxive.com)
  * @license       http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
  * @assetsLicense devXive Proprietary Use License (http://www.devxive.com/license)
  */

// no direct access
defined('_MRDKRA') or die;

/**
 * Version information class for the MOOTOMBO!RDK.
 */
final class NRDK
{
	// Product name.
	const MPRODUCT = 'MOOTOMBO!RDK';

	// Release version.
	const MRELEASE = '1.0';

	// Maintenance version.
	const MMAINTENANCE = '0';

	// Development STATUS.
	const MSTATUS = 'Alpha';

	// Build number.
	const MBUILD = 0;

	// Code name.
	const MCODE_NAME = 'Bagong Simula';

	// Release date.
	const MRELEASE_DATE = '2013-11-01';

	// Release time.
	const MRELEASE_TIME = '10:00';

	// Release timezone.
	const MRELEASE_TIME_ZONE = 'GMT';

	// Copyright Notice.
	const MCOPYRIGHT = 'Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.';

	// Link text.
	const MLINK_TEXT = '<a href="http://devxive.com/mootombo/rdk">The MOOTOMBO!RDK</a> is Free Software released under the GNU General Public License.';

	/**
	 * Compares two a "PHP standardized" version number against the current MOOTOMBO!RDK version.
	 *
	 * @param   string  $minimum  The minimum version of the MOOTOMBO!RDK which is compatible.
	 *
	 * @return  boolean  True if the version is compatible.
	 *
	 * @see     http://www.php.net/version_compare
	 */
	public static function isCompatible($minimum)
	{
		return (version_compare(self::getShortVersion(), $minimum, 'eq') == 1);
	}

	/**
	 * Gets a "PHP standardized" version string for the current MOOTOMBO!RDK.
	 *
	 * @return  string  Version string.
	 */
	public static function getShortVersion()
	{
		return self::MRELEASE . '.' . self::MMAINTENANCE;
	}

	/**
	 * Gets a version string for the current MOOTOMBO!RDK with all release information.
	 *
	 * @return  string  Complete version string.
	 */
	public static function getLongVersion()
	{
		return self::MPRODUCT . ' ' . self::MRELEASE . '.' . self::MMAINTENANCE . ' ' . self::MSTATUS . ' [ ' . self::MCODE_NAME . ' ] '
			. self::MRELEASE_DATE . ' ' . self::MRELEASE_TIME . ' ' . self::MRELEASE_TIME_ZONE;
	}
}