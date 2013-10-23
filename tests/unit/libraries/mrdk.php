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

// Set the Nawala Framework root path as a constant if necessary.
if (!defined('MPATH_RDK'))
{
	define('MPATH_RDK', MPATH_BASE . '/libraries/mrdk');
}

// Set the Nawala Framework root path as a constant if necessary.
if (!defined('MPATH_MEDIA'))
{
	define('MPATH_MEDIA', MPATH_BASE . '/media/mrdk');
}

// Define legacy directory separator as a constant if not exist
if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// Init MLoader to work in nimport function
require_once (MPATH_RDK . '/core/loader.php');

/**
 * @param  string $path the nawala path to the class to import
 *
 * @return void
 */
function nimport($path, $config)
{
	return NLoader::import($path, $config);
}

// Import the framework version class if necessary.
if (!class_exists('NFramework'))
{
	nimport('core.version', 'once');
}

// Init the factory
require_once (NPATH_FRAMEWORK . '/factory.php');

