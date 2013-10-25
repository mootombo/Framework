<?php
/**
 * Prepares a minimalist framework for unit testing.
 *
 * MOOTOMBO!Framework is assumed to include the /unittest/ directory.
 * eg, /path/to/mfw/unittest/
 *
 * @package     MOOTOMBO!Framework.UnitTest
 *
 * @copyright   Copyright (C) 1997 - 2013 devXive - reseach and development. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        http://www.phpunit.de/manual/current/en/installation.html
 */

// set for no direct access functionality in applications (MRDK Restricted Access)
define('_MFWRA', 1);

// Fix magic quotes.
ini_set('magic_quotes_runtime', 0);

// Maximise error reporting.
ini_set('zend.ze1_compatibility_mode', '0');
error_reporting(E_ALL & ~E_STRICT);
ini_set('display_errors', 1);

/*
 * Ensure that required path constants are defined.  These can be overridden within the phpunit.xml file
 * if you chose to create a custom version of that file.
 */
if (!defined('MFWPATH_TESTS'))
{
	define('MFWPATH_TESTS', realpath(__DIR__));
}
if (!defined('MFWPATH_LIBRARIES'))
{
	define('MFWPATH_LIBRARIES', realpath(dirname(dirname(__DIR__)) . '/libraries'));
}
if (!defined('MFWPATH_BASE'))
{
	define('MFWPATH_BASE', realpath(dirname(dirname(__DIR__))));
}
if (!defined('MFWPATH_ROOT'))
{
	define('MFWPATH_ROOT', realpath(MFWPATH_BASE));
}

// Import the entrypoint
require_once MFWPATH_LIBRARIES . '/lib_mootombo/factory.php';