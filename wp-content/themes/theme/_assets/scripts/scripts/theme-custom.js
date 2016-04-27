jQuery(function($){

	$('html').removeClass('no-js').addClass('js');

	/**
	 * Mobile Menu JS
	 */

	function toggleMobileMenu() {
		var html = document.documentElement;
		
		if ( html.getAttribute('data-mobile-menu-open') === "true" ) {
			html.setAttribute('data-mobile-menu-open', 'false');

		} else {
			html.setAttribute('data-mobile-menu-open', 'true');
		}
	}

	document.getElementById('CloseMobileNavigationLayer').addEventListener('click', function(){
		toggleMobileMenu();
	});	

	document.getElementById('MobileNavigation--CloseButton').addEventListener('click', function(){
		toggleMobileMenu();
	});	

	/**
	 * Wordpress navigation
	 */

	$(document).ready(function() {
		$('.menu-item-has-children > a').attr('onClick', 'return false;');

		$('#SiteNavigation.SimpleResponsiveNav .menu-item-has-children > a').each(function(){
			$(this).on('click', function(){
				if ( $(window).width() <= 750 ) {
					$(this).next().slideToggle();
				}
			});
		});

		$('#SiteNavigation.PopoutResponsiveNav #MobileToggle').click(function(){
			if ( $(window).width() <= 750 ) {
				toggleMobileMenu();
			}
		});

		$('#SiteNavigation.SimpleResponsiveNav #MobileToggle').click(function(){
			if ( $(window).width() <= 750 ) {
				$(this).next().slideToggle();
			}
		});
	});

	/**
	 * Lazyload images/backgrounds
	 * <div data-src="image.jpg"></div> or <img data-src="image.jpg">
	 */

	$('[data-src]').unveil(300, function() {
		$(this).load(function() {
			$(this).removeClass('image-defer');
		});
	});

	/**
	 * For styling form fields
	 */

	$(document).ready(function(){
		$('.Select, .gform_wrapper select').wrap('<div class="select-holder"></div>');
		$('.InputSearch, .widget_search input[type="search"]').wrap('<div class="input-search-holder"></div>');
		$('.Submit').wrap('<div class="input-submit-wrapper"></div>');
		$('.Submit').click(function(){
			$(this).parent().addClass('bco-submit-animation');
		});
	});

	/**
	 * Add class to animate the header after scrolling
	 */

	$(document).ready(function(){
		$(window).scroll(function() {
			var scroll = $(window).scrollTop();
			if (scroll >= 100) {
				$('body').addClass('header-scrolled');
			} else {
				$('body').removeClass('header-scrolled');
			}
		});
	});

	/**
	 * Wordpress Menu
	 */

	$('#menu-toggle').click(function(){
		if ( ! $('html').hasClass('mobile-navigation-active') ) {
			$('html').addClass('mobile-navigation-active');
		} else {
			$('html').removeClass('mobile-navigation-active');
		}
	});

	$('#close-navigation-popout').click(function(){
		$('html').removeClass('mobile-navigation-active');
	});

	$(document).on('click', '#close-navigation', function(){
		$('html').removeClass('mobile-navigation-active');
	});

	$(document).ready(function() {
		$('#mobile-navigation .menu-item-has-children > a').append('<i class="fa fa-angle-down"></i>');
		// $('#mobile-navigation .menu > li:last-of-type').after('<li id="close-navigation" class="menu-item"><a href="#0">Close Menu <i class="fa fa-close"></i></a></li>');
	});

	$('#MobileNavigation .menu-item-has-children > a').click(function(){
		$(this).next().slideToggle( 300 );
	});

	/**
	 * Responsive video wrap
	 */

	$(document).ready(function() {
		$('.entry-content iframe').wrap('<div class="ResponsiveVideo"></div>');
	});

	/**
	 * Gravity Forms "active" and "complete" classes
	 */

	$(document).ready(function(){
		var gfields = $('li.gfield .ginput_container input, li.gfield .ginput_container textarea');
		gfields.focus(function(){
			$(this).parent().parent().addClass('field-active');
		});
		gfields.blur(function(){
			$(this).parent().parent().removeClass('field-active');
			if( $(this).val().length !== 0 ) {
				$(this).parent().parent().addClass('field-complete');
			} else {
				$(this).parent().parent().removeClass('field-complete');
			}
		});
	});

	/**
	 * Wolfnet
	 */

	$('.sidebar-widget .wolfnet_widgetTitle').addClass('widget-title');
	$('.wolfnet_widgetBaths option:first-of-type').text('Baths');
	$('.wolfnet_widgetBeds option:first-of-type').text('Beds');
	$('.wolfnet_quickSearchFormButton button').text('Search');

	/**
	 * Smooth Scrolling from #anchor to ID
	 */

	$(document).ready(function(){
		$('a[href*=\\#]:not([href=\\#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});

	/**
	 * WOW.js - 8.22 KB
	 * For animating elements when they appear in the viewport
	 * https://github.com/matthieua/WOW
	 */

	var wow = new WOW({
		boxClass: 'ElementInview', // animated element css class (default is wow)
		animateClass: 'ElementInview__animated', // animation css class (default is animated)
		offset: 0, // distance to the element when triggering the animation (default is 0)
		mobile: true, // trigger animations on mobile devices (default is true)
		live: true, // act on asynchronously loaded content (default is true)
		callback:     function(box) {
			// the callback is fired every time an animation is started
			// the argument that is passed in is the DOM node being animated
		},
		scrollContainer: null // optional scroll container selector, otherwise use window
	});

	wow.init();

});














