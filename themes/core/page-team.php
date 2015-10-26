<?php
/*
Template Name: Team Page
*/

	/*
	 * Output of the listing
	 */
	function output_listing( $loop ) { global $post; ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="team_member">
				<? $member_photo = get_field('team_photo');?>
				<div class="grid_6 inner_r">
					<img src="<?=$member_photo['sizes']['medium'];?>" class="team_photo" />
				</div>

				<div class="grid_18 inner_l">
					<blockquote class="team_member_content">
						<h3 class="team_member_name"><?=$post->post_title;?></h3>
						<?=get_field('team_details');?>
					</blockquote>
				</div>

			</div>
		<?php endwhile; ?>
<?php }
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php include('parts/page-banner.php'); ?>

<div id="content" class="team_page">
	<div class="container_24">

		<div id="copy" class="grid_18 grid_16_m float_right">
			<div class="inner">
				<?php page_title(); ?>
				<?php the_content(); ?>
				<?php editButton(); ?>

				<?php
					/* Setup the config */
					$post_type = 'team';
					$tax = 'team-categories';
					$terms = get_terms( $tax );

					if( count($terms) > 0 ) :
						/* Grab items by Taxonomy/Category */
						foreach( $terms as $category ) :
							/* Query to pull the posts belonging to this */
							$faq_loop = new WP_Query( array(
								'post_type' => $post_type,
								$tax => $category->slug
							));

							if ($faq_loop->have_posts()) : ?>
							<h2><?=$category->name;?></h2>
							<?php output_listing( $faq_loop ); ?>
							<br />
							<?php endif; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php
							/* Query to pull all the posts */
							$faq_loop = new WP_Query( array( 'post_type' => $post_type ));
							if ($faq_loop->have_posts()) : ?>
							<?php output_listing( $faq_loop ); ?>
						<?php endif; ?>
					<?php endif; ?>
			</div><!--/.inner-->
		</div><!-- /.grid -->

		<?php include('parts/sidebar.php'); ?>

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>