<?php get_header(); ?>

<?php include('parts/page-banner.php'); ?>

<?php $has_sidebar = is_dynamic_sidebar('Blog Sidebar');?>

<div id="content" class="index_page">
	<div class="container_24">

		<div id="copy" class="grid_<?php echo($has_sidebar ? 18 : 24);?> float_right">
	        <div class="inner">
	        	<?php page_title(); ?>

				<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

					<div class="post" id="post-<?php the_ID(); ?>">
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

						<?php the_excerpt(); ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Continue reading <?php the_title_attribute(); ?>" class="btn btn-small">Continue Reading</a>

						<?php include('parts/post-meta.php'); ?>

					</div><!-- /.post -->

					<?php endwhile; ?>

			        <div class="pager">
	                    <div class="previous"> <?php next_posts_link('&laquo; Older Entries') ?></div>
	                    <div class="next"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	                </div><!-- /navigation -->

				<?php endif; ?>

			</div><!--/.inner-->
		</div><!-- /.grid -->

		<?php if ($has_sidebar) { ?>
		<div class="grid_6 sidebar float_left">
			<div class="inner">
				<?php dynamic_sidebar('Blog Sidebar'); ?>
			</div><!-- /.inner -->
		</div><!-- /.grid -->
		<?php } ?>

	</div><!-- /.container -->
</div> <!-- /#content -->

<?php get_footer(); ?>
