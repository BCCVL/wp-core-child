<?php
	/*
	Name: Create Theme Settings Page in Admin
	Author: Matt Mcnamee
	Version: 1.0
	Author URI: http://www.mcnamee.co
	*/

	// ************************************************
	// Create the New Settings Page
	// ************************************************
	if ( !function_exists( 'nbm_theme_page' ) ) {
		function nbm_theme_page () {
			if ( count($_POST) > 0 && isset($_POST[ 'nbm_settings' ]) ) {
				$options = array(
					'custom_logo', 'footer_text'
					);

				foreach ( $options as $opt ) {
					delete_option('nbm_' . $opt, $_POST[ $opt ]);
					add_option('nbm_' . $opt, $_POST[ $opt ]);
				}
				wp_redirect("themes.php?page=theme-settings.php&saved=true");
				die;
			}
			add_theme_page(__('Theme Settings'), __('Theme Settings'), 'edit_themes', basename(__FILE__), 'nbm_settings');
		}

		add_action('admin_menu', 'nbm_theme_page');
	}

	// ************************************************
	// Add the Settings
	// ************************************************
	if ( !function_exists( 'nbm_settings' ) ) {
		function nbm_settings () { ?>

			<style type="text/css">
				.form-table th, #wpbody-content .describe th { width : 160px; font-weight : bold; font-size : 11px; }
				.form-table input.regular-text, #adduser
				.form-field input { width : 45em; }
				hr { border : 0; background-color : #999; height : 1px; }
				h3 { background : #DFDFDF; text-shadow : 0 1px 0 #FFFFFF; padding : 6px 6px; }
			</style>

			<?php
				if ( isset($_REQUEST[ 'saved' ]) )
				echo '<div id="message" class="updated fade"><p><strong>' . __('Options saved.') . '</strong></p></div>';
			?>

	    <div class="wrap">
	        <h2>Theme Settings</h2>

	        <form method="post" action="">
	            <table class="form-table">
	                <tr>
	                    <td colspan="2">
	                        <br /><h3>General Theme Options:</h3>
	                    </td>
	                </tr>

	                <tr valign="top">
	                    <th scope="row"><label for="footer_text">Footer  Text</label></th>
	                    <td>
	                        <input name="footer_text" type="text" id="footer_text" value="<?php echo htmlspecialchars(stripslashes(get_option('nbm_footer_text'))); ?>" class="regular-text" />
	                        <br /><small>Enter the text that you'd like to show up in the footer.</small>
	                    </td>
	                </tr>

	            </table>

	            <p class="submit">
	                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
	                <input type="hidden" name="nbm_settings" value="save" style="display:none;" />
	            </p>

	        </form>

	    </div>
		<?php
		}
	}

?>
