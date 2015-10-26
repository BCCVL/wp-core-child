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
	add_action('init', 'create_post_type_team');

	/**
	 * Create the new post types
	 */
	function create_post_type_team() {
		register_post_type('team',
			array(
				'labels'       => array(
					'name'         => __('Team Members'),
					'singular_name'=> __('Team Member'),
					'all_items'    => __('View All'),
					'add_new_item' => __('New Team Member'),
					'add_new'      => __('Add Team Member'),
					'edit_item'    => __('Edit Team Member')
				),
				'public'         => true,
				'hierarchical'   => true,
				'menu_position'  => 21,
				'menu_icon'      => 'dashicons-groups',
				'capability_type'=> 'page',
				'supports'       => array('title', 'editor', 'order')
			)
		);
	}

	/**
     * Add new taxonomy(i.e. Category), make it hierarchical + add defaults
     */
    add_action('init', 'create_featured_taxonomies_team', 0);

    function create_featured_taxonomies_team() {
        $labels=array(
            'name'         => __('Categories'),
            'singular_name'=> __('Category')
        );
        register_taxonomy('team-categories', array('team'), array(
            'hierarchical'=> true,
            'labels'      => $labels,
            'show_ui'     => true,
            'query_var'   => true
        ));

        // Add Defaults to the Categories
        /*
        $parent_term  = term_exists('team-categories'); // array is returned if taxonomy is given
        $parent_term_id = $parent_term[ 'term_id']; // get numeric term id
        wp_insert_term(
            'General', // the term
            'team-categories', // the taxonomy
            array(
                'description'=> 'General FAQs.',
                'slug'       => 'general',
                'parent'     => $parent_term_id
            )
        );
        */
        /**
         * You can add more here
         */
    }