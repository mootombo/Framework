<?php

/**
 * Prepares a minimalist framework for unit testing.
 *
 * MOOTOMBO!RDK is assumed to include the /unittest/ directory.
 * eg, /path/to/mrdk/unittest/
 *
 * @package     mRDK.UnitTest
 *
 * @copyright   Copyright (C) 1997 - 2013 devXive - reseach and development. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        http://www.phpunit.de/manual/current/en/installation.html
 */

// set for no direct access functionality in applications (MRDK Restricted Access)
define('_MRDKRA', 1);

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
if (!defined('MPATH_TESTS'))
{
	define('MPATH_TESTS', realpath(__DIR__));
}
if (!defined('MPATH_LIBRARIES'))
{
	define('MPATH_LIBRARIES', realpath(dirname(dirname(__DIR__)) . '/libraries'));
}
if (!defined('MPATH_BASE'))
{
	define('MPATH_BASE', realpath(dirname(dirname(__DIR__))));
}
if (!defined('MPATH_ROOT'))
{
	define('MPATH_ROOT', realpath(MPATH_BASE));
}

// Import the entrypoint
require_once MPATH_TESTS . '/includes/framework.php';