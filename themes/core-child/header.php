<?php wp_head_open(); ?>

<?php wp_head(); ?>
<?php if(is_page('testpage')){
           echo ('<script type="text/javascript" src="'. get_stylesheet_directory_uri() . '/js/demosdm.js"> </script>'); 
        } ?>
</head>

<body id="<?php echo $post->post_name; ?>-<?php if( is_single() ) { echo 'post'; } elseif( is_category() ) { echo 'archive'; } else { echo 'page'; } ?>" itemscope itemtype="http://schema.org/WebPage">

<div id="header">
	<div class="container_24">
	    <div class="inner" id="navigation">
	    	<a href="<?php bloginfo('url'); ?>" class="logo">
				<img src="<?=get_template_directory_uri();?>/images/backgrounds/logo@2x.png" width="143" height="43" alt="<?php bloginfo('name'); ?>" />
			</a>
			<div class="menu_wrapper">
			    <?php wp_nav_menu( array( 'menu' => 'Header Menu', 'container' => false, 'menu_id' => false, 'menu_class' => 'header_menu hidden_phone' ) ); ?>
			    <?php wp_nav_menu( array( 'menu' => 'Header Login', 'container' => false, 'menu_id' => false, 'menu_class' => 'header_links hidden_phone' ) ); ?>
			</div>
		</div><!--/#navigation-->

	</div><!-- /.container -->
</div><!--/#header-->
