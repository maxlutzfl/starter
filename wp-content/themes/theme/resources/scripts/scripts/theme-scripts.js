/**
 * =========================
 * Theme Scripts
 * =========================
 */

jQuery(function($){

	/**
	 * no-js
	 */

	$('html').removeClass('no-js').addClass('js');

	/**
	 * Mobile Menu JS
	 */

	function toggleMobileMenu() {
		var html = $('html');
		if ( html.attr('data-mobile-menu-is') == 'opened' ) {
			html.attr('data-mobile-menu-is', 'closed');

		} else {
			html.attr('data-mobile-menu-is', 'opened');
		}
	}

	$('[data-mobile-menu-close], [data-mobile-menu-close], [data-mobile-menu-toggle]').on('click', function() {
		toggleMobileMenu();
	});

	/**
	 * Wordpress navigation
	 */

	$(document).ready(function() {

		$('#site-navigation.SimpleResponsiveNav .menu-item-has-children > a').each(function(){
			$(this).on('click', function(){
				if ( $(window).width() <= 750 ) {
					$(this).next().slideToggle();
				}
			});
		});

		$('#site-navigation.PopoutResponsiveNav #MobileToggle').click(function(){
			if ( $(window).width() <= 750 ) {
				toggleMobileMenu();
			}
		});

		$('#site-navigation.SimpleResponsiveNav #MobileToggle').click(function(){
			if ( $(window).width() <= 750 ) {
				$(this).next().slideToggle();
			}
		});
	});

	/**
	 * Lazyload images/backgrounds
	 * <div data-src="image.jpg"></div> or <img data-src="image.jpg">
	 */

	setTimeout(function(){
		$('[data-src]').unveil(-100, function() {
			$(this).load(function() {
				$(this).css({
					'opacity': 1,
				})
			});
		});
	}, 500);

	/**
	 * For styling form fields
	 */

	$(document).ready(function(){
		$('.formField-select, .gform_wrapper select').wrap('<div class="formField-select-holder"></div>');
		$('.InputSearch, .widget_search input[type="search"]').wrap('<div class="formField-search-holder"></div>');
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

	$(document).ready(function() {
		$('#main-navigation .menu-item-has-children > a').wrapInner('<span></span>');
		$('#main-navigation .menu-item-has-children > a').append('<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>');
	});

	$('#mobile-navigation .menu-item-has-children > a').click(function(){
		$(this).next().slideToggle( 300 );
	});

	/**
	 * Responsive video wrap
	 */

	$(document).ready(function() {
		$('iframe[src*="youtube.com"]').wrap('<div class="responsive-video"></div>');
		$('iframe[src*="youtube-nocookie.com"]').wrap('<div class="responsive-video"></div>');
		$('iframe[src*="player.vimeo.com"]').wrap('<div class="responsive-video"></div>');
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

	/**
	 * Magnific popup
	 */

	$(document).ready(function() {

		$('.gallery .gallery-item, [data-image-expand]').magnificPopup({
			// delegate: 'a',
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			image: {
				verticalFit: true
			},
			gallery: {
				enabled: true
			},
			zoom: {
				enabled: true,
				duration: 300, // don't foget to change the duration also in CSS
				opener: function(element) {
					return element.find('img');
				}
			}
		});
	});

	/**
	 * Fixed navigation header
	 */

	function stickyNav_setup() {
		var nav = $('[data-fixed-masthead]');
		var navHeight = nav.outerHeight();

		nav.wrap('<div id="masthead-wrapper"></div>');
		$('#masthead-wrapper').height(navHeight);
	}

	stickyNav_setup();

	function stickyNav_siteMastheadWrapperHeightFix() {
		var nav = $('[data-fixed-masthead]');
		var navHeight = nav.outerHeight();
		$('#masthead-wrapper').height(navHeight);
	}

	function stickyNav_scroll() {
		var distanceToScroll = $('#masthead-wrapper').offset().top;
		var distanceScrolled = $(window).scrollTop();
		if ( distanceScrolled >= distanceToScroll ) {
			$('body').addClass('nav-is-stuck');
		} else {
			$('body').removeClass('nav-is-stuck');
		}
	}

	$(window).scroll(function() {
		window.requestAnimationFrame(stickyNav_scroll);
	});

	$(window).resize(function() {
		stickyNav_siteMastheadWrapperHeightFix();
		window.requestAnimationFrame(stickyNav_scroll);
	});

	/**
	 * Sliders
	 */

	$('[data-slider="test-main"]').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		dots: true,
		fade: true,
		draggable: true,
		asNavFor: '[data-slider="test-buttons"]',
		responsive: [
			{
				breakpoint: 1000,
				settings: {
					fade: false,
					draggable: false,
				}
			}
		],
	});

	$('[data-slider="test-buttons"]').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '[data-slider="test-main"]',
		arrows: true,
		dots: true,
		centerMode: true,
		focusOnSelect: true
	});

	/**
	 * doubleTapToGo
	 */

	$('.menu-item-has-children').doubleTapToGo();

});
