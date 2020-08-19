<?php
/**
 * Header Spacing
 *
 * Adds extra settings to handle spacings in the header area
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Spacing Class
 */
class Gridbox_Pro_Header_Spacing {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Add Custom Spacing CSS code to custom stylesheet output.
		add_filter( 'gridbox_pro_custom_css_stylesheet', array( __CLASS__, 'custom_spacing_css' ) );

		// Add Header Spacing Settings.
		add_action( 'customize_register', array( __CLASS__, 'header_spacing_settings' ) );
	}

	/**
	 * Adds custom Margin CSS styling for the logo and navigation spacing
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_spacing_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Set Logo Spacing.
		if ( 10 !== $theme_options['logo_spacing'] ) {

			$margin = $theme_options['logo_spacing'] / 10;

			$custom_css .= '
				@media only screen and (min-width: 60em) {
					.site-branding {
						margin-top: ' . $margin . 'em;
						margin-bottom: ' . $margin . 'em;
					}
				}
				';
		}

		// Set Navigation Spacing.
		if ( 10 !== $theme_options['navi_spacing'] ) {

			$margin = $theme_options['navi_spacing'] / 10;

			$custom_css .= '
				@media only screen and (min-width: 60em) {
					.primary-navigation {
						margin-top: ' . $margin . 'em;
						margin-bottom: ' . $margin . 'em;
					}
				}
				';
		}

		// Set Header alignment.
		if ( 10 !== $theme_options['logo_spacing'] || 10 !== $theme_options['navi_spacing'] ) {

			$custom_css .= '
				@media only screen and (min-width: 60em) {
					.header-main,
					.primary-navigation {
						align-items: initial;
					}
				}
				';
		}

		return $custom_css;
	}

	/**
	 * Adds header spacing settings
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_spacing_settings( $wp_customize ) {

		// Add Section for Header Settings.
		$wp_customize->add_section( 'gridbox_pro_section_header', array(
			'title'    => esc_html__( 'Header Settings', 'gridbox-pro' ),
			'priority' => 20,
			'panel'    => 'gridbox_options_panel',
		) );

		// Add Logo Spacing setting.
		$wp_customize->add_setting( 'gridbox_theme_options[logo_spacing]', array(
			'default'           => 10,
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'gridbox_theme_options[logo_spacing]', array(
			'label'    => esc_html__( 'Logo Spacing (default: 10)', 'gridbox-pro' ),
			'section'  => 'gridbox_pro_section_header',
			'settings' => 'gridbox_theme_options[logo_spacing]',
			'type'     => 'text',
			'priority' => 10,
		) );

		// Add Navigation Spacing setting.
		$wp_customize->add_setting( 'gridbox_theme_options[navi_spacing]', array(
			'default'           => 10,
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'gridbox_theme_options[navi_spacing]', array(
			'label'    => esc_html__( 'Navigation Spacing (default: 10)', 'gridbox-pro' ),
			'section'  => 'gridbox_pro_section_header',
			'settings' => 'gridbox_theme_options[navi_spacing]',
			'type'     => 'text',
			'priority' => 20,
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Header_Spacing', 'setup' ) );
