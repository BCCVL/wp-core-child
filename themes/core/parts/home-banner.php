<?php
	$bannerLoop = new WP_Query( array( 'post_type' => 'banners', 'name' => 'home-page' ) );

	if ($bannerLoop->have_posts()) {

		$find_characters = array('>', '.');
		$replace_characters = array('<i class="fa fa-caret-right"></i>', '<i class="fa fa-circle"></i>');

		$bannerLoop->the_post();
		$banner_title = get_field('title');
		$banner_description = get_field('description');
		$banner_text = get_field('button_text');
		$banner_link = get_field('button_link');

		$rows = get_field('banner_images');
		$row_count = count($rows);
		$i = rand(0, $row_count - 1);
	?>

	<div id="home_banner">
		<div id="home_banner_image" style="background-image: url(<?=$rows[$i]['banner_image']['sizes']['hero-banner'];?>);"></div>

		<div class="container_24 banner_text">
			<div class="grid_24">
				<?php if (!empty($banner_description)) { ?>
					<div class="hero_subtitle">
						<? echo $banner_description; ?>
					</div>
				<?php } ?>

				<?php if (!empty($banner_title) AND !empty($banner_description)) { ?>
					<div class="hero_dots">
						<i class="fa fa-circle"></i>
						<i class="fa fa-circle"></i>
						<i class="fa fa-circle"></i>
					</div>
				<? } ?>

				<?php if (!empty($banner_title)) { ?>
					<h2 class="hero_title">
						<? echo str_replace($find_characters, $replace_characters, $banner_title); ?>
					</h2>
				<?php } ?>

				<?php if (!empty($banner_text)) { ?>
					<a class="hero_button" href="<?php if( !empty($banner_link) ) : $link = true; ?><? echo $banner_link; ?><?php endif; ?>"><? echo $banner_text; ?></a>
				<?php } ?>

				<a class="hero_button colorbox_video" href="//www.youtube.com/embed/ACj6BsLoMXo?rel=0" style="margin-left:10px;">Watch the Video</a>

			</div>
		</div> <!-- /.container_24 -->
		<?php ?>
	</div> <!-- /.flexslider -->

	<?php } ?>
<?php unset($bannerLoop); ?>