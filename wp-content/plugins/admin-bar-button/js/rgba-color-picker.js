/**
 * @package:		WordPress
 * @subpackage:		Admin Bar Button Plugin
 * @description:	RGBA colour picker
 * @since:			3.2.2
 */

$(document).ready(function(){

	Color.prototype.toString = function(remove_alpha) {
		if (remove_alpha == 'no-alpha') {
			return this.toCSS('rgba', '1').replace(/\s+/g, '');
		}
		if (this._alpha < 1) {
			return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
		}
		var hex = parseInt(this._color, 10).toString(16);
		if (this.error) return '';
		if (hex.length < 6) {
			for (var i = 6 - hex.length - 1; i >= 0; i--) {
				hex = '0' + hex;
			}
		}
		return '#' + hex;
	};
 
	$('.abb-colour-picker').each(function(){
	
		var control = $(this);	// This control
		
		/**
		 * Change some of the default methods from the WordPress colour picker
		 */
		control.wpColorPicker({
		
			change: function(event, ui){
				// send ajax request to wp.customizer to enable Save & Publish button
				var _new_value = control.val(),
					key = control.attr('data-customize-setting-link');
				
				// change the background color of our transparency container whenever a color is updated
				var $transparency = control.parents('.wp-picker-container:first').find('.transparency');
				
				// we only want to show the color at 100% alpha
				$transparency.css('backgroundColor', ui.color.toString('no-alpha'));
			}
			
		});
		
		/**
		 * Create the slider and append it to the WP colour picker control
		 */
		$('<div class="abb-alpha-container"><div class="slider-alpha"></div><div class="transparency"></div></div>').appendTo(control.parents('.wp-picker-container'));
		
		/**
		 * Calculate the alpha value
		 */
		var value = control.val().replace(/\s+/g, '');	// The initial value of the colour control
		
		if(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)){
			var alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
			var alpha_val = parseInt(alpha_val);
		} else{
			var alpha_val = 100;
		}
		
		/**
		 * Declaration of the 'slider' object
		 */
		var $alpha_slider = control.parents('.wp-picker-container:first').find('.slider-alpha');
		
		/**
		 * Add aditional methods and propertiesto the '$alpha_silder' object
		 */
		$alpha_slider.slider({
		
			value:	alpha_val,
			range:	"max",
			step:	1,
			min:	1,
			max:	100,
			
			/**
			 * Called upon creation of the alpha slider
			 */
			create: function(event, ui){
				var v = $(this).slider('value');			// Grab the value of the slider
				$(this).find('.ui-slider-handle').text(v);	// Show the value on the slider handle
			},
			
			/**
			 * Update the slider value
			 */
			slide: function(event, ui){
				$(this).find('.ui-slider-handle').text(ui.value);	// Show the new value on the slider handle
			}
			
		});
		
		/**
		 * Handle 'sliderchange' events
		 */
		$alpha_slider.slider().on('slide', function(event, ui){
		
			var new_alpha_val = parseFloat(ui.value),
				iris = control.data('a8cIris'),
				color_picker = control.data('wpWpColorPicker');
			
			iris._color._alpha = new_alpha_val / 100.0;	// Pass the alpha colour to the colour control
			control.val(iris._color.toString());		// Update the control colour
			
			color_picker.toggler.css({					// Update the colour picker CSS
				backgroundColor: control.val()
			});
			
			var get_val = control.val();				// Grab the current colour control value
			$(control).wpColorPicker('color', get_val);	// Update the 'color' picker within the 'wpColorPicker' object (to fix relationship between 'alpha' slider and the 'side' slider)
			
		});
		
	});
 
});