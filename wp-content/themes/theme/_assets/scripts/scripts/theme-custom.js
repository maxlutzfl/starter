/**
 * Mobile Menu JS
 */

function toggleMobileMenu() {
	var html = document.documentElement;
	
	if ( html.dataset.mobileMenuOpen === "true" ) {
		html.dataset.mobileMenuOpen = "false";

	} else {
		html.dataset.mobileMenuOpen = "true";
	}
}

document.getElementById('CloseMobileNavigationLayer').addEventListener('click', function(){
	toggleMobileMenu();
});	

document.getElementById('MobileNavigation--CloseButton').addEventListener('click', function(){
	toggleMobileMenu();
});	


// Parallax plugin
if( ! (/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) ){
	var s = skrollr.init({
		smoothScrolling: false,
		smoothScrollingDuration: 10,
		forceHeight: false,
		edgeStrategy: 'set',
		easing: {
			WTF: Math.random,
			inverted: function(p) {
				return 1-p;
			}
		}
	});
} 
 
jQuery(function($){

	// Optimize Nav Experience
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

		// Placeholder
		$('.gfield').each(function(){
			var PlaceholderText = $(this).find('label').text();
			$(this).find('input, textarea').attr('placeholder', PlaceholderText);
		});
	});

	// Image lazyload
	$(document).ready(function() {
		$('.image-defer').unveil(200, function() {
			$(this).load(function() {
				this.style.opacity = 1;
			});
		});
		// $('.image-defer').lazyload({
		// 	effect : "fadeIn",
		// 	threshold: -200
		// });
	});

	// Slider - slick.js
	$(document).ready(function($) {

		$('.Module__bgslider').owlCarousel({
			items: 1,
			margin: 0,
			stagePadding: 0,
			smartSpeed: 450,
			loop: true,
			mouseDrag: true,
			touchDrag: true,
			autoplay: true
		});

		// $('.Module__bgslider').slick({
		// 	infinite: true,
		// 	slidesToShow: 1,
		// 	slidesToScroll: 1,
		// 	dots: true,
		// 	autoplay: true,
		// 	appendArrows: '#slider-arrows'
		// });		

		$('.gallery').slick({
			centerMode: true,
			centerPadding: '15px',
			lazyLoad: 'ondemand',
			slidesToShow: 3,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						centerMode: true,
						centerPadding: '15px',
						slidesToShow: 3
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: true,
						centerMode: true,
						centerPadding: '15px',
						slidesToShow: 1
					}
				}
			]
		});	
	});

	// Select field holder
	$(document).ready(function(){
		$('select').wrap('<div class="select-holder"></div>');
		$('input[type="search"]').wrap('<div class="input-search-holder"></div>');
		$('input[type="submit"]').wrap('<div class="input-submit-wrapper"></div>');
		$('input[type="submit"]').click(function(){
			$(this).parent().addClass('bco-submit-animation');
		});
	});

	// For loading animation
	$(document).ready(function(){
		setTimeout(function(){ $('html').addClass('after-load-1000'); }, 1000);
		setTimeout(function(){ $('html').addClass('after-load-1500'); }, 1500);
		setTimeout(function(){ $('html').addClass('after-load-2000'); }, 2000);
	});

	// Scroll header class
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

	// Mobile menu stuff
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

	// Fit vids
	$(document).ready(function() {
		$('body').fitVids();
	});

	$(document).ready(function(){
		$('*[class^="wp-image"]').parent().featherlight();
		$('.gallery a').featherlightGallery();
	});

	// Gravity forms field animation classes
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

	// Smooth scroll on anchor links
	$(document).ready(function(){
		$('a[href*=#]:not([href=#])').click(function() {
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

	// Sticky elements
	$(document).ready(function(){
		if ( $('.sticky-element').length ) {
			$('.sticky-element').each(function(){
				var sticky = new Waypoint.Sticky({
					element: $(this)
				});
			});
		}
	});

	// Inview 
	var wow = new WOW({
		boxClass: 'element-inview',
	});
	wow.init();

});














