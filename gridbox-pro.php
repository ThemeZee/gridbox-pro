<?php
/*
Plugin Name: Gridbox Pro
Plugin URI: http://themezee.com/addons/gridbox-pro/
Description: Adds additional features like custom colors, google fonts, widget areas and footer copyright to the Gridbox theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0.4
Text Domain: gridbox-pro
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Gridbox Pro
Copyright(C) 2016, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Main Gridbox_Pro Class
 *
 * @package Gridbox Pro
 */
class Gridbox_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Gridbox_Pro::constants() Setup the constants needed
	 * @uses Gridbox_Pro::includes() Include the required files
	 * @uses Gridbox_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {

		// Setup Constants.
		self::constants();

		// Setup Translation.
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );

		// Include Files.
		self::includes();

		// Setup Action Hooks.
		self::setup_actions();

	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {

		// Define Plugin Name.
		define( 'GRIDBOX_PRO_NAME', 'Gridbox Pro' );

		// Define Version Number.
		define( 'GRIDBOX_PRO_VERSION', '1.0.4' );

		// Define Plugin Name.
		define( 'GRIDBOX_PRO_PRODUCT_ID', 62420 );

		// Define Update API URL.
		define( 'GRIDBOX_PRO_STORE_API_URL', 'https://themezee.com' );

		// Plugin Folder Path.
		define( 'GRIDBOX_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL.
		define( 'GRIDBOX_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File.
		define( 'GRIDBOX_PRO_PLUGIN_FILE', __FILE__ );

	}

	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'gridbox-pro', false, dirname( plugin_basename( GRIDBOX_PRO_PLUGIN_FILE ) ) . '/languages/' );

	}

	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {

		// Include Admin Classes.
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/admin/class-plugin-updater.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/admin/class-settings.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/admin/class-settings-page.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/admin/class-admin-notices.php';

		// Include Customizer Classes.
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/customizer/class-customizer.php';

		// Include Pro Features.
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-custom-colors.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-custom-fonts.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-footer-line.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-footer-widgets.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-header-bar.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/modules/class-header-spacing.php';

		// Include Magazine Widgets.
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-boxed.php';
		require_once GRIDBOX_PRO_PLUGIN_DIR . '/includes/widgets/widget-magazine-posts-columns.php';

	}

	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {

		// Enqueue Frontend Widget Styles.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );

		// Register additional Magazine Post Widgets.
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );

		// Add Settings link to Plugin actions.
		add_filter( 'plugin_action_links_' . plugin_basename( GRIDBOX_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );

		// Add automatic plugin updater from ThemeZee Store API.
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );

	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Enqueue RTL or default Plugin Stylesheet.
		if ( is_rtl() ) {
			wp_enqueue_style( 'gridbox-pro', GRIDBOX_PRO_PLUGIN_URL . 'assets/css/gridbox-pro-rtl.css', array(), GRIDBOX_PRO_VERSION );
		} else {
			wp_enqueue_style( 'gridbox-pro', GRIDBOX_PRO_PLUGIN_URL . 'assets/css/gridbox-pro.css', array(), GRIDBOX_PRO_VERSION );
		}

		// Get Custom CSS.
		$custom_css = apply_filters( 'gridbox_pro_custom_css_stylesheet', '' );

		// Sanitize Custom CSS.
		$custom_css = wp_kses( $custom_css, array( '\'', '\"' ) );
		$custom_css = str_replace( '&gt;', '>', $custom_css );
		$custom_css = preg_replace( '/\n/', '', $custom_css );
		$custom_css = preg_replace( '/\t/', '', $custom_css );

		// Add Custom CSS.
		wp_add_inline_style( 'gridbox-pro', $custom_css );

	}

	/**
	 * Register Magazine Widgets
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		register_widget( 'Gridbox_Pro_Magazine_Posts_Boxed_Widget' );
		register_widget( 'Gridbox_Pro_Magazine_Posts_Columns_Widget' );

	}

	/**
	 * Add Settings link to the plugin actions
	 *
	 * @param array $actions Plugin action links.
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=gridbox-pro' ), __( 'Settings', 'gridbox-pro' ) ) );

		return array_merge( $settings_link, $actions );
	}

	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		if ( ! is_admin() ) :
			return;
		endif;

		$options = Gridbox_Pro_Settings::instance();

		if ( $options->get( 'license_key' ) <> '' ) :

			$license_key = $options->get( 'license_key' );

			// Setup the updater.
			$gridbox_pro_updater = new Gridbox_Pro_Plugin_Updater( GRIDBOX_PRO_STORE_API_URL, __FILE__, array(
					'version' 	=> GRIDBOX_PRO_VERSION,
					'license' 	=> $license_key,
					'item_name' => GRIDBOX_PRO_NAME,
					'item_id'   => GRIDBOX_PRO_PRODUCT_ID,
					'author' 	=> 'ThemeZee',
				)
			);

		endif;

	}
}

// Run Plugin.
Gridbox_Pro::setup();
