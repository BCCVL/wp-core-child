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
	add_action('init', 'create_post_type_partners');

	/**
	 * Create the new post types
	 */
	function create_post_type_partners() {
		register_post_type('partners',
			array(
				'labels'       => array(
					'name'         => __('Partner Logos'),
					'singular_name'=> __('Partners'),
					'all_items'    => __('View All'),
					'add_new_item' => __('New Partners'),
					'add_new'      => __('Add Partners'),
					'edit_item'    => __('Edit Partners')
				),
				'public'         => true,
				'hierarchical'   => true,
				'menu_position'  => 22,
				'menu_icon'      => 'dashicons-slides',
				'capability_type'=> 'page',
				'supports'       => array('title', 'editor', 'order')
			)
		);
		/**
		 * You can add more here
		 */
	}
