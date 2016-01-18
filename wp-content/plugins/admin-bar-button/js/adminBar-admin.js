/**
 * @package:		WordPress
 * @subpackage:		Admin Bar Button Plugin
 * @description:	JS for use in the admin area (on the Admin Bar Button settings page)
 * @since:			2.2
 */

$ = jQuery.noConflict();

(function($){
 
    /**
	 * Add Color Picker to all inputs that have the 'colour-picker' class
	 */
    $(function(){
        $('.colour-picker').wpColorPicker();
    });
     
})(jQuery);

$(document).ready(function(){

	$('input[name="delete"]', '#admin-bar-button-page').on('click', function(){
	
		var result = confirm('Are you sure you want to restore the default settings?');
		if(result !== true){
			return false;
		}
		
	});
	
	$('#button_animate').on('change', function(){
	
		var duration = $('#button_duration');
		var direction = $('#button_direction');
		var hidden = $('input[name="' + $(this).attr('name') + '"]');
		
		if($(this).attr('value') !== 'yes'){
			duration.prop('readonly', true);
			direction.prop('disabled', true);
		} else {
			duration.removeProp('readonly');
			direction.removeProp('disabled');
		}
		
		hidden.attr('value', $(this).attr('value'));
		
	});
	
	$('#bar_animate').on('change', function(){
	
		var duration = $('#bar_duration');
		var direction = $('#bar_direction');
		var hidden = $('input[name="' + $(this).attr('name') + '"]');
		
		if($(this).attr('value') !== 'yes'){
			duration.prop('readonly', true);
			direction.prop('disabled', true);
		} else {
			duration.removeProp('readonly');
			direction.removeProp('disabled');
		}
		
		hidden.attr('value', $(this).attr('value'));
		
	});
	
	$('#bar_shown_behaviour').on('click', function(){
	
		var showTime = $('#show_time');
		
		if($(this).attr('value') === 'stay'){
			showTime.prop('readonly', true);
		} else {
			showTime.removeProp('readonly');
		}
		
	});
	
	$(function(){
		$('#abb-tabs').tabs({
			active: 0,
			collapsible: true
		});
	});
	
});