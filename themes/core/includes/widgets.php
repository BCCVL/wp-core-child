<?php
	/*
	Name: Register Widgets
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
	*/

	function is_sidebar_active( $index = 1 ){
		$sidebars	= wp_get_sidebars_widgets();
		$key		= (string) 'sidebar-'.$index;

		return (isset($sidebars[$key]));
	}

	if ( !function_exists( 'nbm_widgets_init' ) ) {
		function nbm_widgets_init() {
			if ( !function_exists('register_sidebars') )
				return;

			register_sidebar(array(
				'name'          => 'Home Widgets',
				'before_widget' => '<div class="grid_8 grid_12_s inner"><div id="%1$s" class="widget_container home_widget_container %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="widget_title home_widget_title">',
				'after_title'   => '</h2>',
			));

			register_sidebar(array(
				'name'          => 'Page Sidebar',
				'before_widget' => '<div class="grid_24 inner grid_12_s"><div id="%1$s" class="widget_container %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="widget_title">',
				'after_title'   => '</h2><div class="hr"></div>',
			));

			register_sidebar(array(
				'name'          => 'Blog Sidebar',
				'before_widget' => '<div class="grid_24 inner grid_12_s"><div id="%1$s" class="widget_container %2$s">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="widget_title">',
				'after_title'   => '</h2><div class="hr"></div>',
			));

		}

		// Runs our code at the end to check that everything needed has loaded
		add_action( 'init', 'nbm_widgets_init' );
}

?>
