/**
 * @package:		WordPress
 * @subpackage:		Admin Bar Button Plugin
 * @description:	Custom jQuery UI 'adminBar' widget for implementing a sliding admin bar, and the invokation of the widget
 */

$ = jQuery.noConflict();

$(function(){
	
	$.widget('DJGUI.adminBar', {
	
		options : {
		
			text:					'Admin bar',	// The text to display in the button
			text_direction:			'ltr',			// The direction of the text
			button_position:		'top-left',		// Where to place the button
			button_animate:			'yes',			// Whether or not to animate the show/hide of the Admin Bar Button
			button_direction:		'left',			// The direction that the Admin Bar Button sldes on/off the screen
			button_duration:		500,			// The length of time to take to show/hide the Admin Bar Button
			bar_animate:			'yes',			// Whether or not to animate the show/hide of the WordPress Admin Bar
			bar_direction:			'right',		// The direction that the WordPress Admin Bar sldes on/off the screen
			bar_duration:			500,			// The length of time to take to show/hide the WordPress Admin Bar
			bar_shown_behaviour:	'go',			// Whether the WordPress Admin Bar should 'stay' or 'go' once it has been shown
			show_time:				5000,			// The length of time to show the WordPress Admin Bar for
			show_hide_button:		true			// Whether or not to show the 'hide' button on the WordPress Admin Bar
			
        }, // options
	
		/**
		 * Constructor
		 */
		_create : function(){
		
			/** Ensure that this is a valid '#wpadminbar' element */
			this._validate_element();
			if(!this.valid){
				return false;
			}
			
			/** Check to see if the show/hide of the Admin Bar Button and the WordPress Admin Bar should be animated */
			this._check_animate_options();
			
			/** Set that the WordPress Admin Bar can be shown */
			this._can_show(true);
			
			/** Initialise the layout of the widget */
			this._create_layout();
			
			/** Initialise the events which can be triggered by this widget */			
			this._create_events();
			
		}, // _create
		
		/**
		 * Validate the selector that this instance of 'adminBar' was called upon and ensure it is the Admin Bar
		 */
		_validate_element : function(){
		
			this.valid = (this.element.attr('id') === 'wpadminbar') ? true : false;
			
		}, // _validate_element
		
		/**
		 * Check to see if the show/hide of the Admin Bar Button and the WordPress Admin Bar should be animated
		 * Set the associated duration option to '0' if the animation is not required
		 */
		_check_animate_options : function(){
		
			if(this.options.button_animate === 'no') this.options.button_duration = 0;
			if(this.options.bar_animate === 'no') this.options.bar_duration = 0;
			
		}, // _check_animate_options
		
		/**
		 * Create the layout of the widget
		 */
		_create_layout : function(){
			
			/** Create the relevant DOM objects for the 'Show admin bar' button */
            this.button = $('<div>').addClass('djg-admin-bar-button');
			this.button_text = $('<span>').addClass('text');
			this.button_icon = $('<span>').addClass('ab-icon-position-'+this.options.button_position);
			
            /** Insert the 'Show admin bar' button in to the DOM */
            this.button.insertAfter(this.element);
			if(this.options.button_position.indexOf('right') > -1) this.button.append(this.button_icon);
			this.button.append(this.button_text);
			if(this.options.button_position.indexOf('left') > -1) this.button.append(this.button_icon);
			
			/** Grab the 'Hide admin bar' object */
			this.buttonHide = $('#wpadminbar #wp-admin-bar-hide a');
			
            /** Format the 'Show admin bar' button */
            this._format_button();
			
		}, // _create_layout
		
		/**
		 * Format the layout of the widget (using the options, either default or supplied by the user)
		 */
		_format_button : function(){
		
			/** Work out if the Admin Bar Button should be shown on the left or the right */
			var top = (this.options.button_position.indexOf('top') > -1) ? '0' : 'auto';
			var bottom = (this.options.button_position.indexOf('bottom') > -1) ? '0' : 'auto';
			var left = (this.options.button_position.indexOf('left') > -1) ? '0' : 'auto';
			var right = (this.options.button_position.indexOf('right') > -1) ? '0' : 'auto';
			
			/** If the Admin Bar Button is to be shown at the bottom of the screen, ensure the Admin Bar is alow shown there */
			if(bottom === '0'){
				this.element.css({
					bottom:	'0',
					top:	'auto'
				});
				
				this.element.find('.ab-sub-wrapper').css({
					bottom:		'32px',
					boxShadow:	'0 -3px 5px rgba(0, 0, 0, 0.2)'
				});
			}
			
			/** Add text to the Admin Bar Button */
			this.button_text.html(this.options.text);
			
			/** Format the Admin Bar Button */
			this.button.css({
				backgroundRepeat:	'repeat',
				bottom:				bottom,
				height:				'32px',
				position:			'fixed',
				left:				left,
				right:				right,
				top:				top,
				zIndex:				'100000'
			});
			
			/** Format the Admin Bar Button text */
			var margin = '0 20px';
			if(this.options.button_position.indexOf('left') > -1){
				margin = '0 5px 0 20px';
			} else if(this.options.button_position.indexOf('right') > -1){
				margin = '0 20px 0 5px';
			}
			this.button_text.css({
				direction:	this.options.text_direction,
				margin:		margin
			});
			
		}, // _format_layout
		
		/**
		 * Create events triggered by actions on this widget
		 */
		_create_events : function(){
		
			var t = this;	// This object
			
			/** Add the Admin Bar Button 'hover' ('mouseenter' and 'mouseleave') events */
			if(t.options.button_activate === 'both' || t.options.button_activate === 'hover'){
			
				/** Capture when the mouse is hovered over the  Admin Bar Button */
				t.button.on('mouseenter', function(){
					t._start_show_admin_bar_timeout();	// Restart the timout
				});
				
				/** Capture when the mouse leaves the  Admin Bar Button */
				t.button.on('mouseleave', function(){
					t._clear_show_admin_bar_timeout();	// Clear the existing timeout
				});
				
			}
			
			/** Add the Admin Bar Button 'click' events */
			if(t.options.button_activate === 'both' || t.options.button_activate === 'click'){
			
				/** Capture when the  Admin Bar Button is clicked */
				t.button.on('click', function(){
					t._manage_show_admin_bar();	// Show the Admin Bar
				});
				
			}
			
			/** Add the Admin Bar hide timeout events */
			if(t.options.bar_shown_behaviour !== 'stay'){
				
				/** Capture when the mouse is hovered over the WordPress admin bar */
				t.element.on('mouseenter', function(){
					t._clear_hide_admin_bar_timeout();	// Clear the existing timeout
				});
				
				/** Capture when the mouse leaves the WordPress admin bar */
				t.element.on('mouseleave', function(){
					t._start_hide_admin_bar_timeout();	// Restart the timout
				});
				
			}
			
			/** Add the Hide Admin Bar Button 'click' event */
			t.buttonHide.on('click', function(e){
			
				e.preventDefault();		// Prevent the default click action occuring to the link
				t._hide_admin_bar();	// Hide the WordPress admin bar and shwo the Admin Bar Button
				
				if(t.options.bar_shown_behaviour !== 'stay'){
					t._clear_hide_admin_bar_timeout();	// Clear the existing timeout
				}
				
			});
			
		}, // _create_events
		
		/**
		 * Get/set whether or not the WordPress admin bar can be shown
		 *
		 * @param boolean|null can_show	If used as a setter, whether or not the WordPress admin bar can be shown
		 * @return boolean|null			If uses as a getter, whether or not the WordPress admin bar can be shown
		 */
		_can_show : function(can_show){
		
			if(typeof can_show !== 'boolean'){
				return this.can_show;
			} else {
				this.can_show = can_show;
			}
			
		}, // _can_show
		
		/**
		 * Setup a timeout to show the Admin Bar
		 */
		_start_show_admin_bar_timeout : function(){
		
			var t = this;	// This object
			
			this.timer_show_admin_bar = setTimeout(function(){
				
				var can_show = t._can_show();	// Whether or not the Admin Bar can currently be shown
				if(can_show === true){
					t._manage_show_admin_bar();
				}
				
			}, 500);
			
		}, // _timeout
		
		/**
		 * Clear the timout that would otherwise show the Admin Bar
		 */
		_clear_show_admin_bar_timeout : function(){
		
			clearTimeout(this.timer_show_admin_bar);
			
		}, // _clear_timeout
		
		/**
		 * Setup a timeout to hide the Admin Bar
		 */
		_start_hide_admin_bar_timeout : function(){
		
			var t = this;	// This object
			
			this.timer = setTimeout(function(){
				t._hide_admin_bar();				// Hide the WordPress admin bar and shwo the Admin Bar Button
				t._clear_hide_admin_bar_timeout();	// Clear the existing timeout
				
			}, t.options.show_time);
			
		}, // _timeout
		
		/**
		 * Clear the timout that would otherwise hide the Admin Bar
		 */
		_clear_hide_admin_bar_timeout : function(){
		
			clearTimeout(this.timer);
			
		}, // _clear_timeout
		
		/**
		 * Manage the showing of the Admin Bar, including handeling all timeouts
		 */
		_manage_show_admin_bar : function(){
		
			this._show_admin_bar();					// Show the WordPress admin bar and hide the Admin Bar Button
			
			/** Only include the Admin Bar hide timeouts if the bar is set to auto-hide */
			if(this.options.bar_shown_behaviour !== 'stay'){
				this._start_hide_admin_bar_timeout();	// Start a new timeout (to hide the Admin Bar if it's not hovered on)
				this._clear_show_admin_bar_timeout();	// Clear the timeout for showing the Admin Bar
			}
			
		}, // _showing_admin_bar
		
		/**
		 * Show the Admin Bar (and hide the Admin Bar Button)
		 */
		_show_admin_bar : function(){
		
			this._can_show(false);	// Set the 'can_show' object variable to 'false' (meaning the Admin Bar can not be shown again at present)
			
			/** Show the Admin Bar */
			if(this.options.bar_duration > 0){
				this.element.show('slide', { 'direction': this.options.bar_direction }, this.options.bar_duration);
			}
			else{
				this.element.show();
			}
			
			/** Hide the Admin Bar Button */
			if(this.options.button_duration > 0){
				this.button.hide('slide', { 'direction': this.options.button_direction }, this.options.button_duration);
			}
			else{
				this.button.hide();
			}
			
		}, // _show_admin_bar
		
		/**
		 * Hide the WordPress admin bar (and show the Admin Bar Button)
		 */
		_hide_admin_bar : function(){
		
			var t = this;	// This object
			
			/** Hide the Admin Bar */
			if(this.options.bar_duration > 0){
				this.element.hide('slide', { 'direction': this.options.bar_direction }, this.options.bar_duration);
			}
			else{
				this.element.hide();
			}
			
			/** Show the Admin Bar Button */
			if(this.options.button_duration > 0){
				this.button.show('slide', { 'direction': this.options.button_direction }, this.options.button_duration, function(){
					t._can_show(true);	// Set the 'can_show' object variable to 'true' (meaning the Admin Bar can be shown again)
				});
			}
			else{
				this.button.show();
				this._can_show(true);	// Set the 'can_show' object variable to 'true' (meaning the Admin Bar can be shown again)
			}
			
		} // _hide_admin_bar
		
	});
	
});

/**
 * Invoke the 'adminBar' widget, hiding the WordPress admin bar and showing a more subtle button
 */
$(document).ready(function(){
	
	if(djg_admin_bar_button !== false){
	
		/**
		 * As the 'button_position' options changes, ensure that the old options are accounted for
		 *
		 * @since 2.2
		 */
		if(djg_admin_bar_button.button_position === 'left') djg_admin_bar_button.button_position = 'top-left';
		if(djg_admin_bar_button.button_position === 'right') djg_admin_bar_button.button_position = 'top-right';
		
		$('#wpadminbar').adminBar(djg_admin_bar_button);
		
	}
});