<?php
/*
Template Name: Full Width Page DemoSDM
*/
?>

<?php get_header(); ?>

<script> var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>'; </script>

<!-- Canned experiment -->
<div id="demoSDM" class="full_width_page">
	<div id="map"></div>
	<div id="progress"></div>
	<div class="container_24">
		<div id="copya" class="grid_24">
            <?php the_content(); ?> 
		</div><!-- /.grid -->
	</div><!-- /.container -->
</div> <!-- /#content -->

<div id="content" class="full_width_page">
	<div class="container_24">
		<div class="grid_24 inner">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php // If there are sections on the home page, start printing them out.
				if (have_rows('sections')) {
					$section_count = 0;
					while(have_rows('sections')) {
						the_row();

						$section_heading = get_sub_field('section_heading');
						$section_text = get_sub_field('section_text');
						$section_image = get_sub_field('section_image');

						$section_classes = array('home_section');
						if ($section_count == 0) { $section_classes[] = 'first'; }
						$section_classes[] = get_sub_field('section_color');
						$section_classes[] = ($section_count % 2 == 0) ? 'left':'right';
						?>
						<div class="<?php echo implode(' ', $section_classes); ?>">
							<div class="grid_10 image_section">
								<img src="<?php echo $section_image['sizes']['medium'] ;?>" />
							</div>

							<div class="grid_14 text_section">
								<h2><?php echo $section_heading;?></h2>
								<?php echo $section_text; ?>
							</div>
							<div class="clear"></div>
						</div>
				<?php $section_count++; }
				} ?>
				
			<?php endwhile; endif; ?>
		</div><!-- /.grid -->

		<div class="grid_24">
			<?php dynamic_sidebar('Home Widgets'); ?>
		</div> <!-- /.inner -->

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php get_footer(); ?>