<?php
/* Checks if there is a featured banner on a page. */

$has_banner = NULL;

$bannerLoop = new WP_Query( array( 'post_type' => 'banners', 'name' => 'home-page' ) );

if (has_post_thumbnail()) {
	$page_banner = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-banner' );
	$page_banner_url = $page_banner[0];
	$has_banner = 'banner_page';

} elseif ($bannerLoop->have_posts()) {
	$bannerLoop->the_post();
	$rows = get_field('banner_images');
	$row_count = count($rows);
	$i = rand(0, $row_count - 1);

	$page_banner_url = $rows[$i]['banner_image']['sizes']['page-banner'];
	$has_banner = 'banner_page';
}?>

<div class="page_banner" style="background-image: url(<?=$page_banner_url;?>);"></div>

<? unset($bannerLoop); wp_reset_postdata(); ?>