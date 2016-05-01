<?php
/***
 * Gridbox Pro Settings Page Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package Gridbox Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists('Gridbox_Pro_Settings_Page') ) :

class Gridbox_Pro_Settings_Page {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	*/
	static function setup() {
		
		// Add settings page to appearance menu
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ), 12 );
		
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
	
		// Return early if Gridbox Theme is not active
		if ( ! current_theme_supports( 'gridbox-pro'  ) ) {
			return;
		}
			
		add_theme_page(
			esc_html__( 'Pro Version', 'gridbox-pro' ),
			esc_html__( 'Pro Version', 'gridbox-pro' ),
			'manage_options',
			'gridbox-pro',
			array( __CLASS__, 'display_settings_page' )
		);
		
	}
	
	/**
	 * Display settings page
	 *
	 * @return void
	*/
	static function display_settings_page() { 
	
		ob_start();
	?>

		<div id="gridbox-pro-settings" class="gridbox-pro-settings-wrap wrap">
			
			<h1><?php esc_html_e( 'Gridbox Pro', 'gridbox-pro' ); ?></h1>
			<?php settings_errors(); ?>
			
			<form class="gridbox-pro-settings-form" method="post" action="options.php">
				<?php
					settings_fields( 'gridbox_pro_settings' );
					do_settings_sections( 'gridbox_pro_settings' );
					submit_button();
				?>
			</form>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
}

// Run Gridbox Pro Settings Page Class
Gridbox_Pro_Settings_Page::setup();

endif;