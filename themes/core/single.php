<?php get_header(); ?>

<div id="content" class="single_page">
	<div class="container_24">

		<div class="grid_18">
	        <div class="inner">
				<?php page_title(); ?>

		        <?php if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>

		        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		            <?php the_content(); ?>
			        <?php include('parts/post-meta.php'); ?>

		            <?php comments_template(); ?>
				<?php endwhile; endif; ?>
			</div><!--/.inner-->
		</div><!-- /.grid -->

		<div class="grid_6 sidebar">
			<div class="inner">
				<?php dynamic_sidebar('Blog Sidebar'); ?>
			</div><!-- /.inner -->
		</div><!-- /.grid -->

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php get_footer(); ?>
