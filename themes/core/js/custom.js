
/* Superfish */
/* ========================================== */
jQuery(document).ready(function ($) {
	$('ul.header_menu').superfish({
	speed:         'normal',
	autoArrows:    false,
	dropShadows:   false,
	onInit:        function(){
	$('ul.header_menu' + ' li').each(function(){
		$(this).addClass('sfHover');
	});
	}
	}).supposition();
});


/* Custom Select Boxes */
/* ========================================== */
jQuery(function(){
	jQuery('select').customSelect();
});

/* INIT Colourbox */
/* ========================================== */
jQuery(document).ready(function ($) {
	// colorbox
	$('a.colorbox').colorbox();
	$('a.colorbox_video').colorbox({
		iframe:true,
		innerWidth:900,
		innerHeight: 650,
		maxWidth:"80%"
	});
});


/* INIT Addthis */
/* ========================================== */
/* function initAddThis() { addthis.init() }
   jQuery(document).ready( function(){ initAddThis(); } );
*/

/* INIT Banner */
/* ========================================== */
jQuery(window).ready(function ($) {
	$('.flexslider').flexslider({
		controlNav: false,
		animation: "slide",
		pauseOnAction: false,
		pauseOnHover: true
	});

	// If the home banner exists, parallax it.
	if ($('#home_banner_image').length) {
		//$(window).on('touchmove scroll', function(e){
		$(window).on('scroll', function(e){
			parallax();
		});

		function parallax(){
			var scrolled = $(window).scrollTop();
			$('#home_banner_image').css('bottom',-(scrolled*0.6)+'px');
		}
	}

});


/*  ============================================
FAQ Drop Down
============================================ */
jQuery(function () {
	// Hide the FAQ Content on page load
	jQuery('.faq_content').slideUp();

	// Show the FAQ Content on click of question
	jQuery('.faq_title').click(function(){
		faqContent =  jQuery(this).closest('li').find('.faq_content');

		if(!faqContent.hasClass('active_faq')){
			// Open and Close respective content areas
			jQuery('.faq_content').removeClass('active_faq').slideUp();
			faqContent.addClass('active_faq').slideDown('fast');

			// Switch the carets
			jQuery('.close_faq').hide(); jQuery('.open_faq').show();
			jQuery(this).children('.open_faq').hide();
			jQuery(this).children('.close_faq').show();
		} else {
			jQuery('.faq_content').removeClass('active_faq').slideUp();
			jQuery('.close_faq').hide(); jQuery('.open_faq').show();
		}
		return false;
	});
});