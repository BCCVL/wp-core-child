<div class="grid_24 inner grid_12_s">
<div class="widget_container recent_blog_post">
	<h2 class="widget_title">News Articles</h2>

	<?php $the_query = new WP_Query( 'showposts=1' ); ?>
	<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
		<p>
			<?php// echo substr(strip_tags($post->post_content), 0, 250);?>
			<?php echo TrimSummary(strip_tags($post->post_content), $max_length = 250); ?>
			<a href="<?php the_permalink() ?>" class="read_more_link">Read More</a>
		</p>
		<div class="clear"></div>
	<?php endwhile;?>

	<!--<div class="text_align_right">
		<a href="/news/" class="btn btn-small">View All</a>
	</div>-->
</div>
</div>