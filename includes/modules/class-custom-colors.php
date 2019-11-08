<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Gridbox Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Colors Class
 */
class Gridbox_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Gridbox Theme is not active.
		if ( ! current_theme_supports( 'gridbox-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'gridbox_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'custom_editor_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Gridbox_Pro_Customizer::get_default_options();

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] !== $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap,
				.top-navigation-menu ul {
					background: ' . $theme_options['top_navi_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['top_navi_color'] ) ) {
				$custom_css .= '
					.top-navigation-menu,
					.top-navigation-menu a,
					.top-navigation-menu ul a,
					.top-navigation-menu li ul ul {
						border-color: rgba(0,0,0,0.1);
					}

					.header-bar-wrap,
					.top-navigation-menu a,
					.top-navigation-menu a:link,
					.top-navigation-menu a:visited,
					.top-navigation-toggle,
					.top-navigation-toggle:focus,
					.top-navigation-menu .submenu-dropdown-toggle,
					.header-bar .social-icons-menu li a,
					.header-bar .social-icons-menu li a:link,
					.header-bar .social-icons-menu li a:visited {
					    color: #222222;
					}

					.top-navigation-menu a:hover,
					.top-navigation-menu a:active,
					.top-navigation-toggle:hover,
					.top-navigation-toggle:active,
					.top-navigation-menu .submenu-dropdown-toggle:hover,
					.top-navigation-menu .submenu-dropdown-toggle:active,
					.header-bar .social-icons-menu li a:hover,
					.header-bar .social-icons-menu li a:active {
						color: rgba(0,0,0,0.6);
					}
				';
			}
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {

			$custom_css .= '
				/* Header Color Setting */
				.site-header,
				.main-navigation-menu ul {
					background: ' . $theme_options['header_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['header_color'] ) ) {
				$custom_css .= '
					.main-navigation-menu,
					.main-navigation-menu a,
					.main-navigation-menu ul a,
					.main-navigation-menu li ul ul,
					.header-search .header-search-form {
						border-color: rgba(0,0,0,0.1);
					}

					.site-title,
					.site-title a:link,
					.site-title a:visited,
					.site-description,
					.main-navigation-menu a,
					.main-navigation-menu a:link,
					.main-navigation-menu a:visited,
					.main-navigation-toggle,
					.main-navigation-toggle:focus,
					.main-navigation-menu .submenu-dropdown-toggle {
					    color: #222222;
					}

					.site-title a:hover,
					.site-title a:active,
					.main-navigation-menu a:hover,
					.main-navigation-menu a:active,
					.main-navigation-toggle:hover,
					.main-navigation-toggle:active,
					.main-navigation-menu .submenu-dropdown-toggle:hover,
					.main-navigation-menu .submenu-dropdown-toggle:active {
						color: rgba(0,0,0,0.6);
					}
				';
			}
		}

		// Set Primary Content Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.archive-title,
				.page-title,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited,
				.comments-header .comments-title,
				.comment-reply-title span,
				.related-posts-title,
				.has-primary-color {
					color: ' . $theme_options['content_primary_color'] . ';
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.more-link,
				.post-navigation .nav-links a,
				.pagination a,
				.pagination .current,
				.infinite-scroll #infinite-handle span,
				.reply .comment-reply-link,
				.tzwb-tabbed-content .tzwb-tabnavi li a,
				.scroll-to-top-button,
				.scroll-to-top-button:focus,
				.scroll-to-top-button:active,
				.has-primary-background-color {
					background-color: ' . $theme_options['content_primary_color'] . ';
				}

				.widget-header,
				.comments-header,
				.comment-reply-title,
				.related-posts-header {
					border-left: 6px solid ' . $theme_options['content_primary_color'] . ';
				}

				.widget-title a:hover,
				.widget-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: #4477aa;
				}
			';
		}

		// Set Link Color.
		if ( $theme_options['content_secondary_color'] !== $default_options['content_secondary_color'] ) {

			$custom_css .= '
				/* Content Secondary Color Setting */
				a,
				a:link,
				a:visited,
				.widget-title a:hover,
				.widget-title a:active,
				.entry-title a:hover,
				.entry-title a:active,
				.has-secondary-color {
					color: ' . $theme_options['content_secondary_color'] . ';
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:focus,
				.more-link:active,
				.widget_tag_cloud .tagcloud a,
				.entry-tags .meta-tags a,
				.post-navigation .nav-links a:hover,
				.post-navigation .nav-links a:active,
				.pagination a:hover,
				.pagination a:active,
				.pagination .current,
				.infinite-scroll #infinite-handle span:hover,
				.infinite-scroll #infinite-handle span:active,
				.reply .comment-reply-link:hover,
				.reply .comment-reply-link:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.tzwb-social-icons .social-icons-menu li a,
				.scroll-to-top-button:hover,
				.has-secondary-background-color {
					background-color: ' . $theme_options['content_secondary_color'] . ';
				}

				a:hover,
				a:focus,
				a:active {
					color: #111133;
				}
			';
		}

		// Set Primary Content Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {

			$custom_css .= '
				/* Content Primary Color Setting */
				a:hover,
				a:focus,
				a:active {
					color: ' . $theme_options['content_primary_color'] . ';
				}

				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:active,
				.tzwb-social-icons .social-icons-menu li a:hover,
				.tzwb-social-icons .social-icons-menu li a:active {
					background: ' . $theme_options['content_primary_color'] . ';
				}
			';
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] !== $default_options['footer_color'] ) {

			$custom_css .= '

				/* Footer Color Setting */
				.footer-widgets-wrap,
				.footer-wrap {
					background: ' . $theme_options['footer_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$custom_css .= '
					.footer-widget-column,
					.footer-widget-column .widget-header {
						border-color: rgba(0,0,0,0.1);
					}

					.site-footer .site-info a,
					.site-footer .site-info a:link,
					.site-footer .site-info a:visited,
					.footer-navigation-menu a,
					.footer-navigation-menu a:link,
					.footer-navigation-menu a:visited,
					.footer-widget-column .widget-title,
					.footer-widget-column .widget-title a,
					.footer-widget-column .widget a:link,
					.footer-widget-column .widget a:visited,
					#footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a {
					    color: #222222;
					}

					.site-footer .site-info,
					.site-footer .site-info a:hover,
					.site-footer .site-info a:active,
					.footer-navigation-menu a:hover,
					.footer-navigation-menu a:active,
					.footer-widget-column .widget,
					.footer-widget-column .widget-title a:hover,
					.footer-widget-column .widget-title a:active,
					.footer-widget-column .widget a:hover,
					.footer-widget-column .widget a:hover {
						color: rgba(0,0,0,0.6);
					}

					#footer-widgets .tzwb-social-icons .social-icons-menu li a,
					#footer-widgets .widget_tag_cloud .tagcloud a,
					#footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a {
						background: rgba(0,0,0,0.1);
					}

					#footer-widgets .tzwb-social-icons .social-icons-menu li a:hover,
					#footer-widgets .widget_tag_cloud .tagcloud a:hover,
					#footer-widgets .widget_tag_cloud .tagcloud a:active,
					#footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:hover,
					#footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:active,
					#footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
						color: #222222;
						background:  rgba(0,0,0,0.2);
					}
				';
			}
		}

		return $custom_css;
	}

	/**
	 * Adds Color CSS styles in the Gutenberg Editor to override default colors
	 *
	 * @return void
	 */
	static function custom_editor_colors_css() {
		$custom_css = '';

		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Gridbox_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {

			$custom_css .= '
				.has-primary-color,
				.edit-post-visual-editor .editor-post-title__block .editor-post-title__input {
					color: ' . $theme_options['content_primary_color'] . ';
				}
				.has-primary-background-color {
					background-color: ' . $theme_options['content_primary_color'] . ';
				}
			';
		}

		// Set Secondary Color.
		if ( $theme_options['content_secondary_color'] !== $default_options['content_secondary_color'] ) {

			$custom_css .= '
				.has-secondary-color,
				.edit-post-visual-editor .editor-block-list__block a {
					color: ' . $theme_options['content_secondary_color'] . ';
				}
				.has-secondary-background-color {
					background-color: ' . $theme_options['content_secondary_color'] . ';
				}
			';
		}

		// Add Custom CSS.
		if ( '' !== $custom_css ) {
			wp_add_inline_style( 'gridbox-editor-styles', $custom_css );
		}
	}

	/**
	 * Change primary color in Gutenberg Editor.
	 *
	 * @return array $editor_settings
	 */
	static function change_primary_color( $color ) {
		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Gridbox_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['content_primary_color'] !== $default_options['content_primary_color'] ) {
			$color = $theme_options['content_primary_color'];
		}

		return $color;
	}

	/**
	 * Change secondary color in Gutenberg Editor.
	 *
	 * @return array $editor_settings
	 */
	static function change_secondary_color( $color ) {
		// Get Theme Options from Database.
		$theme_options = Gridbox_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Gridbox_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['content_secondary_color'] !== $default_options['content_secondary_color'] ) {
			$color = $theme_options['content_secondary_color'];
		}

		return $color;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'gridbox_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'gridbox-pro' ),
			'priority' => 60,
			'panel'    => 'gridbox_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Gridbox_Pro_Customizer::get_default_options();

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'gridbox_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'gridbox_theme_options[top_navi_color]', array(
				'label'    => esc_html_x( 'Top Navigation', 'color setting', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_colors',
				'settings' => 'gridbox_theme_options[top_navi_color]',
				'priority' => 10,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'gridbox_theme_options[header_color]', array(
			'default'           => $default_options['header_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'gridbox_theme_options[header_color]', array(
				'label'    => esc_html_x( 'Header', 'color setting', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_colors',
				'settings' => 'gridbox_theme_options[header_color]',
				'priority' => 20,
			)
		) );

		// Add Content Primary Color setting.
		$wp_customize->add_setting( 'gridbox_theme_options[content_primary_color]', array(
			'default'           => $default_options['content_primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'gridbox_theme_options[content_primary_color]', array(
				'label'    => esc_html_x( 'Content (primary)', 'color setting', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_colors',
				'settings' => 'gridbox_theme_options[content_primary_color]',
				'priority' => 30,
			)
		) );

		// Add Content Secondary Color setting.
		$wp_customize->add_setting( 'gridbox_theme_options[content_secondary_color]', array(
			'default'           => $default_options['content_secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'gridbox_theme_options[content_secondary_color]', array(
				'label'    => esc_html_x( 'Content (secondary)', 'color setting', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_colors',
				'settings' => 'gridbox_theme_options[content_secondary_color]',
				'priority' => 40,
			)
		) );

		// Add Footer Color setting.
		$wp_customize->add_setting( 'gridbox_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'gridbox_theme_options[footer_color]', array(
				'label'    => esc_html_x( 'Footer', 'color setting', 'gridbox-pro' ),
				'section'  => 'gridbox_pro_section_colors',
				'settings' => 'gridbox_theme_options[footer_color]',
				'priority' => 50,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Gridbox_Pro_Custom_Colors', 'setup' ) );
add_filter( 'gridbox_primary_color', array( 'Gridbox_Pro_Custom_Colors', 'change_primary_color' ) );
add_filter( 'gridbox_secondary_color', array( 'Gridbox_Pro_Custom_Colors', 'change_secondary_color' ) );
