<?php
/**
 * Header Search
 *
 * Displays header search in main navigation menu
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Search Class
 */
class Gridbox_Pro_Header_Search {

	/**
	 * Header Search Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Enqueue Header Search JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add search icon on main navigation menu.
		add_filter( 'wp_nav_menu_items', array( __CLASS__, 'add_header_search' ), 10, 2 );

		// Add Header Search checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_search_settings' ) );

		// Hide Header Search if disabled.
		add_filter( 'gridbox_hide_elements', array( __CLASS__, 'hide_header_search' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Embed header search JS if enabled.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) :

			wp_enqueue_script( 'gridbox-pro-header-search', GRIDBOX_PRO_PLUGIN_URL . 'assets/js/header-search.js', array( 'jquery' ), GRIDBOX_PRO_VERSION, true );

		endif;
	}

	/**
	 * Add search form to navigation menu
	 *
	 * @return void
	 */
	static function add_header_search( $items, $args ) {

		// Return early if not main navigation.
		if ( 'primary' !== $args->theme_location ) {
			return $items;
		}

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) :

			$items .= '<li class="header-search menu-item menu-item-search">';
			$items .= '<a class="header-search-icon">';
			$items .= '<span class="genericon-search"></span>';
			$items .= '<span class="screen-reader-text">' . esc_html_x( 'Search', 'gridbox-pro' ) . '</span>';
			$items .= '</a>';
			$items .= '<div class="header-search-form">';
			$items .= get_search_form( false );
			$items .= '</div>';
			$items .= '</li>';

		endif;

		return $items;
	}

	/**
	 * Adds header search checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_search_settings( $wp_customize ) {

		// Add Header Search Headline.
		$wp_customize->add_control( new Gridbox_Customize_Header_Control(
			$wp_customize, 'gridbox_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_header',
				'settings' => array(),
				'priority' => 30,
			)
		) );

		// Add Header Search setting and control.
		$wp_customize->add_setting( 'gridbox_theme_options[header_search]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'gridbox_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'gridbox_theme_options[header_search]', array(
			'label'    => esc_html__( 'Enable search field in header', 'gridbox-pro' ),
			'section'  => 'gridbox_pro_section_header',
			'settings' => 'gridbox_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 40,
		) );
	}

	/**
	 * Hide Header Search if deactivated.
	 *
	 * @param array $elements / Elements to be hidden.
	 * @return array $elements
	 */
	static function hide_header_search( $elements ) {

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Hide Header Search?
		if ( false === $theme_options['header_search'] ) {
			$elements[] = '.primary-navigation .main-navigation-menu li.header-search';
		}

		return $elements;
	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Header_Search', 'setup' ) );