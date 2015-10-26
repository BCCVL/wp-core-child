<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php include('parts/page-banner.php'); ?>

<div id="content" class="page">
	<div class="container_24">

		<div id="copy" class="grid_18 grid_16_m float_right">
	        <div class="inner">
	        	<?php page_title(); ?>
				<?php the_content(); ?>
				<?php editButton(); ?>
			</div><!--/.inner-->
		</div><!-- /.grid -->

		<?php include('parts/sidebar.php'); ?>

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
