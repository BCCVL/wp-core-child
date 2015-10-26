<?php
	/*
	Name: Custom Post Types - FAQs
	Description: Setup Custom Post Types and their categories + add defaults
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
	*/

	/**
	 * Initialise it all
	 */
	add_action('init', 'create_post_type_faqs');

	/**
	 * Create the new post types
	 */
	function create_post_type_faqs() {
		register_post_type('faqs',
			array(
				'labels'       => array(
					'name'         => __('FAQs'),
					'singular_name'=> __('FAQ'),
					'all_items'    => __('View All'),
					'add_new_item' => __('New FAQ'),
					'add_new'      => __('Add FAQ'),
					'edit_item'    => __('Edit FAQ')
				),
				'public'         => true,
				'hierarchical'   => true,
				'menu_position'  => 22,
				'menu_icon'      => 'dashicons-exerpt-view',
				'capability_type'=> 'page',
				'supports'       => array('title', 'editor', 'order')
			)
		);
		/**
		 * You can add more here
		 */
	}

    /**
     * Add new taxonomy(i.e. Category), make it hierarchical + add defaults
     */
    add_action('init', 'create_featured_taxonomies_faqs', 0);

    function create_featured_taxonomies_faqs() {
        $labels=array(
            'name'         => __('Categories'),
            'singular_name'=> __('Category')
        );
        register_taxonomy('faq-categories', array('faqs'), array(
            'hierarchical'=> true,
            'labels'      => $labels,
            'show_ui'     => true,
            'query_var'   => true
        ));

        // Add Defaults to the Categories
        $parent_term  = term_exists('faq-categories'); // array is returned if taxonomy is given
        $parent_term_id = $parent_term[ 'term_id']; // get numeric term id
        wp_insert_term(
            'General', // the term
            'faq-categories', // the taxonomy
            array(
                'description'=> 'General FAQs.',
                'slug'       => 'general',
                'parent'     => $parent_term_id
            )
        );
        /**
         * You can add more here
         */
    }
