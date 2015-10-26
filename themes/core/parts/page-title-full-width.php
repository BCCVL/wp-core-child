<?php
/*
	Name: UNIVERSAL PAGE HEADER
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
*/
	if ( !function_exists( 'page_title_full_width' ) ) {
		function page_title_full_width() { ?>

<div id="title">
	<div class="container_24">
		<div class="grid_24 inner">
			<h1>
			<?php
				if ( is_category() ) :
					$title = single_cat_title("", false);
				elseif ( is_home() ) :
					$page = get_page_by_title('blog');
					$title = get_the_title($page->ID);
				elseif ( is_tag() ) :
					$title = single_tag_title("", false);
				elseif ( is_search() ) :
					$title = 'Search results for: "' . $_GET['s'] . '"';
				else :
					$title = get_the_title();
				endif;

				customPageTitle( get_post_custom_values("page_title"), $title );
			?></h1>
			<?php if( !empty($subtitle) ) : ?>
				<div class="title_sub"><?php echo $subtitle; ?></div>
			<?php endif; ?>

			<?php if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
		</div> <!-- /.grid -->
	</div><!-- /.container -->
</div><!-- /#title -->
<?php
		}
	} ?>
