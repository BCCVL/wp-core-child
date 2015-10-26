<?php
	/*
	Name: Footer Menu
	Author: Matt Mcnamee
	Version: 2.0
	Author URI: http://www.mcnamee.co
	*/

if ( !function_exists( 'get_menu_list' ) ) {
	function get_menu_list( $menu_type = 'Main Menu', $id = 0, $main_menu = '', $level = FALSE, $deep = FALSE, $type = 'post_type' ) {

		/* Config */
		$show_top_page = FALSE;
		$type =( empty($type) ) ? 'post_type' : $type;

		/* If the menu wasn't passed in, create it */
		if( empty($main_menu) ) :
			$main_menu_result = array();
			$main_menu = array();

			/* Get Main Menu */
			if( is_array($menu_type) ) {
				foreach( $menu_type as $menu_to_get ) {
					$this_menu_result = wp_get_nav_menu_items( $menu_to_get, array('orderby' => 'menu_order') );
					$main_menu_result = array_merge( $main_menu_result, $this_menu_result );
				}
			} else {
				$main_menu_result = wp_get_nav_menu_items( $menu_type, array('orderby' => 'menu_order') );
			}

			/* Put into usable Array */
			if( is_array($main_menu_result) ) {
				foreach( $main_menu_result as $key => $menu_item ) {
					$main_menu[$menu_item->type . '-' . $menu_item->object_id] = array(
						'page_id' => $menu_item->object_id,
						'menu_item_id' => $menu_item->ID,
						'db_id' => $menu_item->db_id,
						'title' => $menu_item->title,
						'url' => $menu_item->url,
						'parent' => $menu_item->menu_item_parent,
						'order' => $menu_item->menu_order,
						'status' => $menu_item->post_status
					);
				}
			}
		endif;

		/* If ID set get just this ID's list */
		if( is_array($main_menu) && $id != 0 ) {
			ob_start();
			foreach( $main_menu as $key => $item ) {
				if( !$level && $item['page_id'] == $id ) : ?>
					<?php if( $show_top_page ) : ?>
						<li<?php if( get_permalink() == $item['url'] ) { echo ' class="current_page_item"'; } ?>>
							<a href="<?php echo $item['url'];?>"><?php echo $item['title']; ?></a>
							<?php if( $deep ) : get_menu_list($menu_type, $item['page_id'], $main_menu, TRUE, $deep, $type); endif; ?>
						</li>
					<?php else : ?>
						<!-- WE'RE NOT SHOWING THE TOP LEVEL PAGE HERE -->
						<?php get_menu_list($menu_type, $item['page_id'], $main_menu, TRUE); ?>
					<? endif; ?>
				<?php elseif( $level && $item['parent'] == $main_menu[$type.'-'.$id]['menu_item_id'] ) : ?>
					<li<?php if( get_permalink() == $item['url'] ) { echo ' class="current_page_item"'; } ?>>
						<a href="<?php echo $item['url'];?>"><?php echo $item['title']; ?></a>
						<?php if( $deep ) : get_menu_list($menu_type, $item['page_id'], $main_menu, TRUE, $deep, $type); endif; ?>
					</li>
			<?php endif;
			}
			$output = ob_get_clean();
			if( !empty($output) ) {
				$output =( $show_top_page || $level ) ? '<ul>' . $output . '</ul>' : $output;
				echo $output;
			}

		/* Else get whole menu */
		} else {
			ob_start();
			foreach( $main_menu as $key => $item ) :
				if( $item['parent'] == 0 ) : ?>
					<li<?php if( get_permalink() == $item['url'] ) { echo ' class="current_page_item"'; } ?>>
						<a href="<?php echo $item['url'];?>"><?php echo $item['title']; ?></a>
					</li>
				<? endif;
			endforeach;

			$output = ob_get_clean();
			if( !empty($output) ) {
				echo '<ul>' . $output . '</ul>';
			}
		}
		unset($output);
	}
}
