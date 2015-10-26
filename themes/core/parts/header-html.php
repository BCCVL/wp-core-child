<?php
/*
	Name: HTML Theme Header Content
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
*/

// ************************************************
// HEADER OPENING
// ************************************************
if ( !function_exists( 'wp_head_open' ) ) {
	function wp_head_open() { ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" prefix="og: http://ogp.me/ns#"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php wp_title('|', true); ?></title>
<meta name="author" content="Matt Mcnamee - www.mcnamee.co" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- BROWSER/DEVICE ICONS -->
<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/ms-tile-icon.png" />
<meta name="msapplication-TileColor" content="#ffffff" />
<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png" />
<link rel="icon"  href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico"  type="image/x-icon" />

<!-- FONTS -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,600,700,300' rel='stylesheet' type='text/css'>

<?php
	}
}

// ************************************************
// STYLES
// ************************************************
if ( !function_exists( 'theme_styles' ) ) {
	function theme_styles() {
		$last_update = '130816';

		$stylesheets = array(
			array('grid', get_template_directory_uri() . '/css/grid.css'),
			array('plugins', get_template_directory_uri() . '/css/plugins.css'),
			array('style', get_bloginfo('stylesheet_url')),
			array('layout', get_template_directory_uri() . '/css/layout.css'),
		);

		foreach( $stylesheets as $stylesheet ) {
			wp_register_style( $stylesheet[0], $stylesheet[1], array(), $last_update );
			wp_enqueue_style( $stylesheet[0] );
		}

	}

	add_action('wp_enqueue_scripts', 'theme_styles');
}

// ************************************************
// SCRIPTS
// ************************************************
if ( !function_exists( 'theme_scripts' ) ) {
	function theme_scripts() {

		$last_update = '130816';

		$javascripts = array(
			array('plugins', get_template_directory_uri() . '/js/plugins.js'),
			array('custom', get_template_directory_uri() . '/js/custom.js')
		);

		foreach( $javascripts as $javascript ) {
			wp_enqueue_script( $javascript[0], $javascript[1], array( 'jquery' ), $last_update, TRUE );
		}
	}

	add_action( 'wp_enqueue_scripts', 'theme_scripts' );
}
