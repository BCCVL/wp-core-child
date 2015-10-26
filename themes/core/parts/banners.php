<?php
	$bannerLoop = new WP_Query( array( 'post_type' => 'banners', 'name' => 'home-page' ) );
	if ($bannerLoop->have_posts()) : ?>

<div id="home_banner" class="flexslider">
	<ul class="slides">
	<?php
		$find_characters = array('>', '.');
		$replace_characters = array('<i class="fa fa-caret-right"></i>', '<i class="fa fa-circle"></i>');

		while ( $bannerLoop->have_posts() ) : $bannerLoop->the_post();
            $rows = get_field('banner');
            if( !empty($rows) ) :
                foreach( (array)$rows as $gallery_image) :
                	$replacement_count = 0;
	?>
	<?php if ( !empty($gallery_image['image']['url']) ) { ?>
		<li style="background-image:url(<?php echo $gallery_image['image']['url']; ?>);">
	<?php } else { ?>
		<li>
	<? } ?>
			<div class="container_24 banner_text">
				<div class="grid_24">
					<?php if (!empty($gallery_image['description'])) { ?>
						<div class="hero_subtitle">
							<? echo $gallery_image['description']; ?>
						</div>
					<?php } ?>

					<?php if (!empty($gallery_image['title']) AND !empty($gallery_image['description'])) { ?>
						<div class="hero_dots">
							<i class="fa fa-circle"></i>
							<i class="fa fa-circle"></i>
							<i class="fa fa-circle"></i>
						</div>
					<? } ?>

					<?php if (!empty($gallery_image['title'])) { ?>
						<h2 class="hero_title">
							<? echo str_replace($find_characters, $replace_characters, $gallery_image['title']); ?>
						</h2>
					<?php } ?>

					<?php if (!empty($gallery_image['button_text'])) { ?>
						<a class="hero_button" href="<?php if( !empty($gallery_image['button_link']) ) : $link = true; ?><? echo $gallery_image['button_link']; ?><?php endif; ?>"><? echo $gallery_image['button_text']; ?></a>
					<?php } ?>
				</div>
			</div> <!-- /.container_24 -->
        </li>
        <?php endforeach; endif; endwhile; rewind_posts(); ?>
	</ul> <!-- /.slides -->
</div> <!-- /.flexslider -->
<?php endif; unset($bannerLoop); ?>