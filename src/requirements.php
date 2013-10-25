<?php
/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          Framework
 * @subPackage       Library
 * @version          1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 *
 * @since            1.0
 */

$errors = array();
if (version_compare(PHP_VERSION, '5.3.2', '<=')) {
    $errors[] = 'Needs a minimum PHP version of 5.3.2. You are running PHP version ' . PHP_VERSION;
}

$jversion = new JVersion();
if (!$jversion->isCompatible('3.1')) {
	$errors[] = '<i class="icon-warning"></i> This will only run on MOOTOMBO!WebOS v3.1+';
}

if (defined('MFWVERSION')) {
	$mfwversion = new MFWCoreVersion();
	if (version_compare($mfwversion->getShortVersion(), '1.0.0', 'gt')) {
		$errors[] = '<i class="icon-warning"></i> Please update MOOTOMBO!Framework to the latest version. You are running ' . $mfwversion->getLongVersion();
	}
}

if (!function_exists('gd_info')) {
    $errors[] = '<i class="icon-warning"></i> The PHP GD2 module is needed but not installed.';
}

if (!phpversion('PDO')) {
    $errors[] = '<i class="icon-warning"></i> The PHP PDO module is needed but not installed.';
}

if (!phpversion('pdo_mysql')) {
    $errors[] = '<i class="icon-warning"></i> The PHP MySQL PDO driver is needed but not installed.';
}

if (!empty($errors)) {
	return $errors;
} else {
	return true;
}

return true;
