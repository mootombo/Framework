/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          MFW.library
 * @subPackage	Librarie
 * @version		1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 */

// Initialize Core Objects
mRDK = {};
mRDK.web = {};
mRDK.system = {};

// Set Variables and Objects
mRDK.web.online = navigator.onLine;
mRDK.web.location = location.protocol;


/* ################
 * # AJAX SECTION #
 * ################
 */
 
 /*
  * Function to save data via ajax and the PHP Class MRDKDatabase::save() Method
  *
  * @param    url     string    URL or Link to save the request
  * @param    data    object    The data object (Should contain the structure of the database tables/rows)
  */
 function mRDKSave(url, data) {
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: data,
		headers: {'X-Requested-With': 'XMKHttpRequest'},
		success: function( responseData, textStatus, jqXHR ) {
			var mSuccess = {};

			mSuccess.status = true;
			mSuccess.data   = responseData,
			mSuccess.text   = textStatus,
			mSuccess.xhr    = jqXHR;

			return mSuccess;
		},
		error:  function( responseData, textStatus, errorThrown ) {
			var mError = {};

			mError.status = false;
			mError.data   = responseData,
			mError.text   = textStatus,
			mError.xhr    = errorThrown;

			return mError;
		}
 }