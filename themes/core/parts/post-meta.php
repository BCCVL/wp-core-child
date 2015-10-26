<p class="post_meta">
	<i class="fa fa-calendar"></i> <?php the_time('F jS, Y') ?> &nbsp; | &nbsp;
	<i class="fa fa-user"></i> <?php the_author() ?> &nbsp; | &nbsp;
	<?php the_tags('<i class="fa fa-tag"></i> <span class="label">', '</span> <span class="label">', '</span> &nbsp; | &nbsp; '); ?>
	<i class="fa fa-suitcase"></i> <?php the_category(', ') ?> &nbsp; | &nbsp;
	<?php edit_post_link('<i class="fa fa-edit"></i>  Edit', '', ' &nbsp; | &nbsp; '); ?>
	<i class="fa fa-comments"></i> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
</p>
