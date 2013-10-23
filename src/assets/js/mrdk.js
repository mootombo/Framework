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