<?php
	/*
	Name: Subpages
	Description: Show page hierarchy based on current page
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co

	Result will be:

	<div id="sub-page-menu" class="widget_container widget_subpages">
		<h2 class="widget_title"><a href="http://www.example.com/?page_id=2">About</a></h2>
		<div class="hr"></div>

		<ul>
			<li class="page_item page-item-15"><a href="http://www.example.com/?page_id=15">Subpage</a>
				<ul class='children'>
					<li class="page_item page-item-29"><a href="http://www.example.com/?page_id=29">3rd level subpage</a>
						<ul class='children'>
							<li class="page_item page-item-34"><a href="http://www.example.com/?page_id=34">forth level page</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="page_item page-item-32"><a href="http://www.example.com/?page_id=32">Another Page under about</a></li>
		</ul>

	</div>


	*/

	/*
	Change log:
	  Version 1.0:
	*/


	/**
	 * Create the page hierarchy
	 * Call the function where the menu
	 * Should be shown
	 *
	 * Returns the result html
	 */
	if ( !function_exists( 'the_sub_pages' ) ) {
		function the_sub_pages($wrapper_class = NULL) {

			if (!is_string($wrapper_class)) {
				$wrapper_class = NULL;
			}

			$wrapper_class = 'banner_page';

			global $post;
			$parent_id_result = '';

			// Id of current page's parent
			$parent_id = $post->ID;

			do {
				// Get Post's Parent Page
				$post_parent = get_post($parent_id, ARRAY_A);

				// Reset Parent ID
				$parent_id = $post_parent['post_parent'];
				if( $parent_id != 0 ) { $parent_id_result = $parent_id; }

			} while( !empty($post_parent['post_parent']) && $post_parent['post_parent'] != 0 );

			if( empty($parent_id_result) ) {
				$parent_id_result = $post->ID;
			}

			$children_pages = wp_list_pages("title_li=&child_of=" . $parent_id_result . '&echo=0');

			// If there's a result - OUTPUT
			if( !empty($children_pages) && $parent_id_result != 0 ) {

				echo "<div class=\"grid_24 inner grid_12_s\"><div id=\"sub-page-menu\" class=\"widget_container widget_subpages " . $wrapper_class . "\">\n";

				// Push out the current parent page
				$parent = get_post($parent_id_result, ARRAY_A);

				echo "<h2 class=\"widget_title\"><a href=\"" . get_permalink($parent['ID']) . "\">" . $parent['post_title'] . "</a></h2>";

				// Push out all children pages
				echo "<ul>\n";
				echo $children_pages;
				echo "\n</ul>\n</div></div>";
			}
		}
	}
