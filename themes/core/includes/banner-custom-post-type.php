<?php
	/*
	Name: Custom Post Type - Banners
	Description: Setup Custom Post Types and their categories + add defaults
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
	*/

	/**
	 * Initialise it all
	 */
	add_action('init', 'create_post_type_banners');

	/**
	 * Create the new post types
	 */
	function create_post_type_banners() {
		register_post_type('banners',
			array(
				'labels'       => array(
					'name'         => __('Banners'),
					'singular_name'=> __('Banner'),
					'all_items'    => __('View All'),
					'add_new_item' => __('New Banner'),
					'add_new'      => __('Add Banner'),
					'edit_item'    => __('Edit Banner')
				),
				'public'         => true,
				'hierarchical'   => true,
				'menu_position'  => 21,
				'menu_icon'      => 'dashicons-images-alt2',
				'capability_type'=> 'page',
				'supports'       => array('title', 'editor', 'order')
			)
		);
		/**
		 * You can add more here
		 */
	}
