<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php include('parts/page-banner.php'); ?>

<div id="content" class="full_width_page">
	<div class="container_24">
		<div id="copy" class="grid_24">
			<?php page_title(); ?>
            <?php the_content(); ?>
            <?php editButton(); ?>
		</div><!-- /.grid -->
	</div><!-- /.container -->
</div> <!-- /#content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>