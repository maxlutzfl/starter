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
	 * Mobile check
	 */

	function isMobile() {
		if ( $('html').hasClass('bco-touchevents') ) {
			return true;
		} else {
			return false;
		}
	}

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
	}, 300);

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
		$('#site-navigation .menu-item-has-children > a').wrapInner('<span></span>');
		$('#site-navigation .menu-item-has-children > a').append('<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>');
		$('#mobile-navigation .menu-item-has-children > a').wrapInner('<span></span>');
		$('#mobile-navigation .menu-item-has-children > a').append('<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 736q0 13-10 23l-466 466q-10 10-23 10t-23-10l-466-466q-10-10-10-23t10-23l50-50q10-10 23-10t23 10l393 393 393-393q10-10 23-10t23 10l50 50q10 10 10 23z"/></svg>');
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

	// $('.sidebar-widget .wolfnet_widgetTitle').addClass('widget-title');
	// $('.wolfnet_widgetBaths option:first-of-type').text('Baths');
	// $('.wolfnet_widgetBeds option:first-of-type').text('Beds');
	// $('.wolfnet_quickSearchFormButton button').text('Search');

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

	/** Inview JS */

	$(document).ready(function() {
		var inviewOffset = (isMobile() === true) ? 0 : 100;
		inView.offset(inviewOffset); 
		inView('.element-inview').on('enter', function(event, handler) {
			var element = $(event);
			element.addClass('element-inview-animated');
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
		if ( $('#masthead-wrapper').length === 0 ) { return; }
		
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
	 * doubleTapToGo
	 */
	function initDoubleTap() {

		// Primary menu
		if ( isMobile() ) {
			$('#primary-menu .menu-item-has-children').doubleTapToGo();
		}

		// Mobile menu
		$('#mobile-navigation .menu-item-has-children').doubleTapToGo();
	}

	$(document).ready(function() {
		initDoubleTap();
	});

	/**
	 * Skrollr
	 */
	function initSkrollr() {
		if ( !isMobile() ) {
			var s = skrollr.init({
				forceHeight: false,
				smoothScrolling: true,
				smoothScrollingDuration: 200
			});
		} else {
			$('html').addClass('no-skrollr');
		}
	}

	$(document).ready(function() {
		initSkrollr();
	});
});
