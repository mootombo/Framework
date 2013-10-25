/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          MFW.library
 * @subPackage       Librarie
 * @version          1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 */

// Initialize Core Objects
MFW = {};
MFW.web = {};
MFW.system = {};
MFW.filesAdded = ''; //List of files added by loadJsCssFile() in the form "[filename1],[filename2],etc"

// Set Variables and Objects
MFW.web.online = navigator.onLine;
MFW.web.location = location.protocol;



/* #####################
 * # Load JS/CSS Files #
 * #####################
 */

 /*
  * Function to dynamically loading external JavaScript and CSS files
  *
  * To load a .js or .css file dynamically, in a nutshell, it means using DOM methods to first create a swanky new "SCRIPT" or "LINK" element,
  * assign it the appropriate attributes, and finally, use element.appendChild() to add the element to the desired location within the document tree.
  * It sounds a lot more fancy than it really is. Lets see how it all comes together:
  *
  * Example: 
  * loadjscssfile("myscript.js", "js") //dynamically load and add this .js file
  * loadjscssfile("javascript.php", "js") //dynamically load "javascript.php" as a JavaScript file
  * loadjscssfile("mystyle.css", "css") ////dynamically load and add this .css file
  *
  * Based on: http://www.javascriptkit.com/javatutors/loadjavascriptcss.shtml
  */
  function loadJsCssFile(filename, filetype, debug) {
	// Check first if we already have this file in space
	if (MFW.filesAdded.indexOf("[" + filename + "]") == -1) {
		MFW.filesAdded += "[" + filename + "]";

		// If filename is an external JavaScript file
		if (filetype === "js")
		{
			var fileref=document.createElement('script');

			fileref.setAttribute("type","text/javascript");
			fileref.setAttribute("src", filename);
		}
		// If filename is an external CSS file
		else if (filetype === "css")
		{
			var fileref=document.createElement("link");

			fileref.setAttribute("rel", "stylesheet");
			fileref.setAttribute("type", "text/css");
			fileref.setAttribute("href", filename);
		}

		if (typeof fileref != "undefined")
		{
			document.getElementsByTagName("head")[0].appendChild(fileref);
		}
	}
	else
	{
		if (debug)
		{
			console.log("File already added: " + filename);
		}
	}
  }


/* ################
 * # AJAX SECTION #
 * ################
 */
 
 /*
  * Function to save data via ajax and the PHP Class MRDKDatabase::save() Method
  *
  * @param    url     string    URL or Link to save the request
  * @param    data    object    The data object (Should contain the structure of the database tables/rows)
  *                             data: {
  *                                 table: 'name_without_prefix',
  *                                 where: {
  *                                     col: 'value'
  *                                 }
  *                             }
  *
  *                             First:  The method check available columns and build the array to store the data. Cols that does not exist, are ignored
  *                             Second: Checks if the appropriate entry exist
  *                                     => If exist    : throw an update
  *                                     => If not exist: throw an insert
  *                                     => If its empty: throw an update // TODO: May need an overhaul because if all is empty we can also delete them?!
  */
  function MFWSave(url, data) {
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
	});
  }


 /*
  * Function to read data via ajax and the PHP Class MFWDatabase::select() Method ( Simple usage )
  *
  * @param    url     string    URL or Link to save the request
  * @param    data    object    The data object (Should contain the structure of the database tables/rows)
  *                             data: {
  *                                 table: 'name_without_prefix',
  *                                 where: {
  *                                     col1: 'value1',
  *                                     col2: 'value2',
  *                                     col3: 'value3'
  *                                 }
  *                             }
  */
  function MFWSelect(url, data) {
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
	});
  }


 /*
  * Function to remove data via ajax and the PHP Class MFWDatabase::select() Method ( Simple usage )
  *
  * @param    url     string    URL or Link to save the request
  * @param    data    object    The data object (Should contain the structure of the database tables/rows)
  *                             data: {
  *                                 table: 'name_without_prefix',
  *                                 where: {
  *                                     id: 'id'
  *                                 }
  *                             }
  */
  function MFWRemove(url, data) {
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
	});
  }