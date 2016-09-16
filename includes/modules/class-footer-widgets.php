<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Gridbox theme to display widgets
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Footer Widgets Class
 */
class Gridbox_Pro_Footer_Widgets {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Display footer widgets.
		add_action( 'gridbox_before_footer', array( __CLASS__, 'display_widgets' ), 30 );

	}

	/**
	 * Displays Footer Widgets
	 *
	 * Hooks into the gridbox_before_footer action hook in footer area.
	 */
	static function display_widgets() {

		// Check if there are footer widgets.
		if ( is_active_sidebar( 'footer' ) ) : ?>

			<div id="footer-widgets-wrap" class="footer-widgets-wrap">

				<div id="footer-widgets" class="footer-widgets container">

					<div id="footer-widgets-columns" class="footer-widgets-columns clearfix"  role="complementary">

						<?php dynamic_sidebar( 'footer' ); ?>

					</div>

				</div>

			</div>

		<?php endif;

	}

	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Register Footer Left widget area.
		register_sidebar( array(
			'name' => __( 'Footer', 'gridbox-pro' ),
			'id' => 'footer',
			'description' => __( 'Appears on the footer area.', 'gridbox-pro' ),
			'before_widget' => '<div class="footer-widget-column"><aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</aside></div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Footer_Widgets', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Gridbox_Pro_Footer_Widgets', 'register_widgets' ), 20 );
