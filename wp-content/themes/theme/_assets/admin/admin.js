jQuery(function($){
	$(document).ready(function(){

		// Move subtitle area
		$('#titlewrap').append( $('#acf_after_title-sortables') );
		$('#acf_after_title-sortables label').hide();

		$('#bco-subtitle').parent().appendTo( $('#titlewrap') );
		$('#bco_subtitle_metabox').hide();

	});
});