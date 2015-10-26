<?php
// ************************************************
// HEADER HTML
// ************************************************
	require_once(TEMPLATEPATH . '/parts/header-html.php');


// ************************************************
// SUBPAGE MENU
// ************************************************
	require_once(TEMPLATEPATH . '/parts/sub-page-menu.php');


// ************************************************
// FOOTER MENU
// ************************************************
	require_once(TEMPLATEPATH . '/includes/get-menu-list.php');


// ************************************************
// PAGE TITLES
// ************************************************
	require_once(TEMPLATEPATH . '/parts/page-title.php');


// ************************************************
// CUSTOM POST TYPES
// ************************************************
	require_once(TEMPLATEPATH . '/includes/banner-custom-post-type.php');
	require_once(TEMPLATEPATH . '/includes/partner-custom-post-type.php');
	require_once(TEMPLATEPATH . '/includes/faqs-custom-post-type.php');
	require_once(TEMPLATEPATH . '/includes/team-custom-post-type.php');


// ************************************************
// ADMINISTRATION SETTINGS
// ************************************************
	require_once(TEMPLATEPATH . '/includes/theme-settings.php');


// ************************************************
// REGISTER SIDEBARS
// ************************************************
	require_once(TEMPLATEPATH . '/includes/widgets.php');


// ************************************************
// SHORTCODES
// ************************************************
	require_once(TEMPLATEPATH . '/config/shortcodes.php');



// ************************************************
// PAGE TITLE
// ************************************************
	function customPageTitle ( $custom_value, $page_title ) {
		if ( isset($custom_value[ 0 ]) ) {
			echo $custom_value[ 0 ];
		}
		else {
			echo $page_title;
		}
	}

// ************************************************
// Common Edit Button
// ************************************************
	function editButton () {
		edit_post_link('Edit', '<br /><p class="btn"><i class="fa fa-edit"></i> ', '</p>');
	}

// ************************************************
// THUMBNAIL SUPPORT
// ************************************************
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(200, 113); // 200 wide by 113 tall, box resize mode
	add_image_size('hero-banner', 2000, 760, true); // Slider Featured image size
	add_image_size('page-banner', 2000, 245, true); // Page Banner image size
	add_image_size('partner-logo', 200, 50, false); // Page Banner image size


// ************************************************
// GRAB CUSTOM FIELDS
// ************************************************
	function get_custom_field_value ( $szKey, $bPrint = false ) {
		global $post;
		$szValue = get_post_meta($post->ID, $szKey, true);
		if ( $bPrint == false )
			return $szValue;
		else echo $szValue;
	}


// ************************************************
// WP3 MENU
// ************************************************
	register_nav_menus(array(
		'primary' => __('Primary Navigation', 'theme'),
	));

	function theme_page_menu_args ( $args ) {
		$args[ 'show_home' ] = true;
		return $args;
	}

	add_filter('wp_page_menu_args', 'theme_page_menu_args');


// ************************************************
// Other Handy Stuff
// ************************************************

// Trim Summary (Cut string to closest word under max length)
if (!function_exists('TrimSummary')) {
	function TrimSummary($summary, $max_length = 100) {
		$summary = preg_replace('/[\n\r]/i', ' ', strip_tags($summary)); // Strip Tags and Newlines
		$summary = preg_replace('/\s{2,}/i', ' ', trim($summary)); // Remove Double-Spaces
		if (strlen($summary) < $max_length) return $summary;

		// Summary Oversize - Trim it
		$cut_length = strrpos(substr($summary, 0, $max_length), ' ');
		$summary = substr($summary, 0, $cut_length);
		$summary .= (substr($summary, -1) == '.') ? '..' : '...'; // Add Trailing Dots
		return $summary;
	}
}

