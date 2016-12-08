/**
 * Convert php var_dump to javascript console.log
 */
jQuery(function($) {

	var selectVarDump = $('[data-console-log]');

	if ( selectVarDump.length > 0 ) {
		
		// Grab the data
		var varDump = selectVarDump.attr('data-console-log');

		// Parse the data to json
		var varDumpJson = $.parseJSON(varDump);

		// Log to developer tools console
		console.log(varDumpJson);
	}
});