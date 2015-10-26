<div id="footer">
	<div class="container_24 inner">
		<div class="grid_20 grid_21_xl">
			<h3>Partners</h3>
			<?php include('parts/footer-logos.php'); ?>
		</div><!--/grid-->

		<div class="grid_4 grid_3_xl text_align_right float_right quick_links">
			<h3>Quick Links</h3>
			<?php wp_nav_menu( array( 'menu' => 'Footer Menu', 'container_id' => false, 'menu_id' => false, 'menu_class' => 'footer_sub_menu', 'depth' => '1' ) ); ?>
		</div><!--/grid-->
	</div> <!-- /.container -->
</div><!-- /#footer -->

<div id="footer_credits">
	<div class="container_24 inner">
		<?php echo $footer_text = get_option('nbm_footer_text'); if( !empty($footer_text) ) { echo '<br />'; } ?>
		&copy; <?php echo date('Y'); ?> <?php bloginfo('description'); ?>
	</div>
</div><!-- /#footer_credits -->

<!-- WORDPRESS FOOTER -->
<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47948311-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
