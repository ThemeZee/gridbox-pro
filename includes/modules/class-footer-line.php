<?php
/**
 * Footer Line
 *
 * Displays credit link and footer text based on theme options
 * Registers and displays footer navigation
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Footer Line Class
 */
class Gridbox_Pro_Footer_Line {

	/**
	 * Footer Line Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}
		// Remove default footer text function and replace it with new one.
		remove_action( 'gridbox_footer_text', 'gridbox_footer_text' );
		add_action( 'gridbox_footer_text', array( __CLASS__, 'display_footer_text' ) );

		// Display footer navigation.
		add_action( 'gridbox_footer_menu', array( __CLASS__, 'display_footer_navigation' ) );

		// Add Footer Settings in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'footer_settings' ) );

	}

	/**
	 * Displays Credit Link and user defined Footer Text based on theme settings.
	 *
	 * @return void
	 */
	static function display_footer_text() {

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Display Footer Text.
		if ( '' !== $theme_options['footer_text'] ) :

			echo do_shortcode( wp_kses_post( $theme_options['footer_text'] ) );

		endif;

		// Call Credit Link function of theme if credit link is activated.
		if ( true === $theme_options['credit_link'] ) :

			if ( function_exists( 'gridbox_footer_text' ) ) :

				gridbox_footer_text();

			endif;

		endif;

	}

	/**
	 * Display footer navigation menu
	 *
	 * @return void
	 */
	static function display_footer_navigation() {

		// Check if there is a footer menu.
		if ( has_nav_menu( 'footer' ) ) {

			echo '<nav id="footer-navigation" class="footer-navigation navigation clearfix" role="navigation">';

			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => false,
				'menu_class' => 'footer-navigation-menu',
				'echo' => true,
				'fallback_cb' => '',
				'depth' => 1,
				)
			);

			echo '</nav><!-- #footer-navigation -->';

		}

	}

	/**
	 * Adds footer text and credit link setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function footer_settings( $wp_customize ) {

		// Add Sections for Footer Settings.
		$wp_customize->add_section( 'gridbox_pro_section_footer', array(
			'title'    => __( 'Footer Settings', 'gridbox-pro' ),
			'priority' => 90,
			'panel' => 'gridbox_options_panel',
			)
		);

		// Add Footer Text setting.
		$wp_customize->add_setting( 'gridbox_theme_options[footer_text]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => array( __CLASS__, 'sanitize_footer_text' ),
			)
		);
		$wp_customize->add_control( 'gridbox_theme_options[footer_text]', array(
			'label'    => __( 'Footer Text', 'gridbox-pro' ),
			'section'  => 'gridbox_pro_section_footer',
			'settings' => 'gridbox_theme_options[footer_text]',
			'type'     => 'textarea',
			'priority' => 30,
			)
		);

		// Add Credit Link setting.
		$wp_customize->add_setting( 'gridbox_theme_options[credit_link]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'gridbox_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'gridbox_theme_options[credit_link]', array(
			'label'    => __( 'Display Credit Link to ThemeZee on footer line', 'gridbox-pro' ),
			'section'  => 'gridbox_pro_section_footer',
			'settings' => 'gridbox_theme_options[credit_link]',
			'type'     => 'checkbox',
			'priority' => 40,
			)
		);

	}

	/**
	 *  Sanitize footer content textarea
	 *
	 * @param String $value / Value of the setting.
	 * @return string
	 */
	static function sanitize_footer_text( $value ) {

		if ( current_user_can( 'unfiltered_html' ) ) :
			return $value;
		else :
			return stripslashes( wp_filter_post_kses( addslashes( $value ) ) );
		endif;
	}

	/**
	 * Register footer navigation menu
	 *
	 * @return void
	 */
	static function register_footer_menu() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		register_nav_menu( 'footer', esc_html__( 'Footer Navigation', 'gridbox-pro' ) );

	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Footer_Line', 'setup' ) );

// Register footer navigation in backend.
add_action( 'after_setup_theme', array( 'Gridbox_Pro_Footer_Line', 'register_footer_menu' ), 30 );
