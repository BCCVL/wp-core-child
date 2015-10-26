<div class="grid_6 grid_8_m sidebar float_left">
	<?php the_sub_pages($has_banner); ?>
	<?php if(is_page()) : include('recent-blog.php'); endif; ?>
	<?php dynamic_sidebar('Page Sidebar'); ?>
</div><!-- /.grid -->