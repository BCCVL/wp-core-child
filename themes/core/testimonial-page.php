<?php
/*
Template Name: Testimonial Page
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php include('parts/page-banner.php'); ?>

<div id="content" class="testimonial_page">
	<div class="container_24">

		<div id="copy" class="grid_18 grid_16_m float_right">
	        <div class="inner">
	        	<?php page_title(); ?>
				<?php the_content(); ?>
				<?php editButton(); ?>

				<?php // If there are testimonials on the page, start printing them out.
				if (have_rows('testimonial')) {
					$testimonial_count = 0;
					while(have_rows('testimonial')) {
						the_row();

						$testimonial_name = get_sub_field('testimonial_name');
						$testimonial_content = get_sub_field('testimonial_content');
						$testimonial_photo = get_sub_field('testimonial_photo');
						$has_photo = (bool)$testimonial_photo;

						$testimonial_classes = array('testimonial');
						$testimonial_classes[] = ($testimonial_count % 2 == 0) ? 'left':'right';
						if ($has_photo) { $testimonial_classes[] = 'image'; }
						?>
						<div class="<?php echo implode(' ', $testimonial_classes); ?>">
							<? if ($has_photo) { ?>
								<div class="grid_8 grid_7_xl image_section">
									<img src="<?php echo $testimonial_photo['sizes']['medium'] ;?>" />
								</div>
							<? } ?>

							<? if ($has_photo) { ?>
								<div class="grid_16 grid_17_xl text_section">
							<? } else { ?>
								<div class="grid_24 text_section">
							<? } ?>
								<blockquote>
									<?php echo $testimonial_content; ?>
									<h4><?php echo $testimonial_name;?></h4>
								</blockquote>
							</div>
							<div class="clear"></div>
						</div>
				<?php $testimonial_count++; }
				} ?>
			</div><!--/.inner-->
		</div><!-- /.grid -->

		<?php include('parts/sidebar.php'); ?>

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
