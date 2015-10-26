<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">No Comments</p>
	<?php
		return;
	}
?>

<!--COMMENTS-->
<div class="comments" id="comments">
	<?php if ( have_comments() ) : ?>
	<h5><?php comments_number('No Response', 'One Response', '% Responses' ); ?></h5>
	<ul>
 		<?php 
 			$args = array ('type' => 'comment');
			wp_list_comments( $args ); 		
 		?>
 	</ul>
	 	<?php
		else :    
			if ('open' == $post->comment_status) : 
				?>
					<h5>
						No Comments Yet
					</h5>
				<?php else : ?>            
					<h5>Comments are closed</h5>
			<?php endif; ?>
    <?php endif; ?>
</div>

<!--COMMENT FORM-->

<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields = array(
			'author' => '<li><label for="author">Name<span>(Required)</span></label><input type="text" id="author" name="author" ' . $aria_req . ' value="' .
        esc_attr( $commenter['comment_author'] ) . '" tabindex="1" /></li>',
			'email' => '<li><label for="email">Email<span>(Required)</span></label><input type="text" id="email" name="email" ' . $aria_req . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" tabindex="2" /></li>',
			'URL' => '<li class="last"><label for="url">Website</label><input type="text" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" /></li>'
	);

	$comm = "Leave a Comment";

	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields),
		'title_reply' => '<h5>'. $comm .'</h5>',
		'cancel_reply_link' => '',
		'comment_field' => '<li class="msg"><label for="comment">Your Comment</label><textarea id="comment" name="comment" ' . $aria_req . ' tabindex="4" rows="0" cols="0"></textarea></li>',
		'label_submit' => 'Leave a Comment',
		'comment_notes_before' => '<ul>',
		'comment_notes_after' => '</ul>',
	);
	comment_form($args); 
?>
