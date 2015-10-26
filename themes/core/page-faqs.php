<?php
/*
	Template Name: FAQs
*/

	/*
	 * Output of the listing
	 */
	function output_listing( $loop ) { global $post; ?>
		<ul class="noContent faqs">
			<?php while ( $loop->have_posts() ) { $loop->the_post(); ?>
				<li>
					<h3 class="faq_title"><?= $post->post_title ?>
						<i class="fa fa-caret-down open_faq"></i><i class="fa fa-caret-up close_faq" style="display: none;"></i>
					</h3>

					<div class="faq_content"><?= $post->post_content ?></div>
				</li>
			<?php } wp_reset_postdata(); ?>
		</ul>
<?php }
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php include('parts/page-banner.php'); ?>

<div id="content" class="faqs_page">
	<div class="container_24">

		<div id="copy" class="grid_18 grid_16_m float_right">
	        <div class="inner">
				<?php page_title(); ?>

				<?php the_content(); ?>
				<?php
					// Setup the config
					$post_type = 'faqs';
					$tax = 'faq-categories';
					$terms = get_terms( $tax );

					if (count($terms) > 0) {
						// Grab items by Taxonomy/Category
						foreach( $terms as $category ) {
							// Query to pull the posts belonging to this
							$faq_loop = new WP_Query( array(
								'post_type' => $post_type,
								$tax => $category->slug
							));

							if ($faq_loop->have_posts()) { ?>
								<h2><?=$category->name;?></h2>
								<?php output_listing( $faq_loop ); ?>
								<br />
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<?php
							// Query to pull all the posts
							$faq_loop = new WP_Query( array( 'post_type' => $post_type ));
							if ($faq_loop->have_posts()) { ?>
							<?php output_listing( $faq_loop ); ?>
						<?php } ?>
					<?php } ?>
			</div><!-- /.inner -->
		</div><!-- /.grid -->

		<?php include('parts/sidebar.php'); ?>

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
