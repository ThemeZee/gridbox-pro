<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customizer Class
 */
class Gridbox_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'gridbox_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		$theme_options = wp_parse_args( get_option( 'gridbox_theme_options', array() ), self::get_default_options() );

		// Return theme options.
		return $theme_options;

	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'logo_spacing'            => 10,
			'navi_spacing'            => 10,
			'author_bio'              => false,
			'scroll_to_top'           => false,
			'footer_text'             => '',
			'credit_link'             => true,
			'top_navi_color'          => '#4477aa',
			'header_color'            => '#111133',
			'content_primary_color'   => '#111133',
			'content_secondary_color' => '#4477aa',
			'footer_widgets_color'    => '#111133',
			'footer_color'            => '#111133',
			'text_font'               => 'Roboto',
			'title_font'              => 'Roboto Slab',
			'navi_font'               => 'Roboto',
			'widget_title_font'       => 'Roboto Slab',
			'available_fonts'         => 'favorites',
		);

		return $default_options;

	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {

		wp_enqueue_script( 'gridbox-pro-customizer-js', GRIDBOX_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), GRIDBOX_PRO_VERSION, true );

	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {

		wp_enqueue_style( 'gridbox-pro-customizer-css', GRIDBOX_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), GRIDBOX_PRO_VERSION );

	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Customizer', 'setup' ) );
