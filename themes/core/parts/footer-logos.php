<?
	// 1. Grab the custom post type.
	$logoLoop = new WP_Query( array( 'post_type' => 'partners', 'name' => 'footer-logos' ) );

	// 2. Check if anything returned.
	if ($logoLoop->have_posts()) :

		// 3. Loop through, and set up each post that it finds.
		while ($logoLoop->have_posts()) : $logoLoop->the_post();

			// 4. Now look for the repeater.
			if (have_rows('logos')) :

				echo('<table class="partner_logos"><tr>');
				// 5. Put the repeater in the loop.
				while(have_rows('logos')) : the_row();

					// 6. Grab info, and print out.
					$the_logo = get_sub_field('partner_logo');
					$the_caption = get_sub_field('partner_logo_caption');
					?>
					<td class="partner_logo">
						<?php if ($the_caption != '') { ?><span><? echo($the_caption); ?></span><? } ?>
						<img src="<? echo($the_logo['sizes']['partner-logo']); ?>" alt="<?php echo($the_logo['title']); ?>" />
					</td>
				<? endwhile;
				echo('</tr></table>');
			endif;
		endwhile;
	endif;
?>