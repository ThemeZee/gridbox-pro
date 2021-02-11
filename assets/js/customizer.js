/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Gridbox Pro
 */

( function( $ ) {

	/* Header Search checkbox */
	wp.customize( 'gridbox_theme_options[header_search]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.primary-navigation .main-navigation li.header-search' );
			} else {
				showElement( '.primary-navigation .main-navigation li.header-search' );
			}
		} );
	} );

	/* Author Bio checkbox */
	wp.customize( 'gridbox_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.type-post .entry-footer .entry-author' );
			} else {
				showElement( '.type-post .entry-footer .entry-author' );
			}
		} );
	} );

	/* Top Navigation Color Option */
	wp.customize( 'gridbox_theme_options[top_navi_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color;

			custom_css = '.header-bar-wrap, .top-navigation ul ul { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.1)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			custom_css += '.top-navigation ul, .top-navigation ul a, .top-navigation ul ul a, .top-navigation ul li ul ul { border-color: ' + border_color + '; }';
			custom_css += '.header-bar-wrap, .top-navigation ul a, .top-navigation ul a:link, .top-navigation ul a:visited, .secondary-menu-toggle, .secondary-menu-toggle:focus, .header-bar .social-icons-menu li a, .header-bar .social-icons-menu li a:link, .header-bar .social-icons-menu li a:visited { color: ' + text_color + '; }';
			custom_css += '.top-navigation ul a:hover, .top-navigation ul a:active, .secondary-menu-toggle:hover, .secondary-menu-toggle:active, .header-bar .social-icons-menu li a:hover, .header-bar .social-icons-menu li a:active { color: ' + hover_color + '; }';
			custom_css += '.secondary-menu-toggle .icon, .top-navigation .dropdown-toggle .icon, .top-navigation ul .menu-item-has-children > a > .icon { fill: ' + text_color + '; }';
			custom_css += '.secondary-menu-toggle:hover .icon, .secondary-menu-toggle:active .icon, .top-navigation .dropdown-toggle:hover .icon, .top-navigation .dropdown-toggle:active .icon, .top-navigation ul .menu-item-has-children > a:hover > .icon, .top-navigation ul .menu-item-has-children > a:active > .icon { fill: ' + hover_color + '; }';

			addColorStyles( custom_css, 1 );
		} );
	} );

	/* Header Color Option */
	wp.customize( 'gridbox_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color;

			custom_css = '.site-header, .main-navigation ul ul { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.1)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			custom_css += '.main-navigation ul, .main-navigation ul a, .main-navigation ul ul a, .main-navigation ul li ul ul, .header-search .header-search-form { border-color: ' + border_color + '; }';
			custom_css += '.site-title, .site-title a:link, .site-title a:visited, .site-description, .main-navigation ul a, .main-navigation ul a:link, .main-navigation ul a:visited, .primary-menu-toggle, .primary-menu-toggle:focus, .header-search .header-search-icon { color: ' + text_color + '; }';
			custom_css += '.site-title a:hover, .site-title a:active, .main-navigation ul a:hover, .main-navigation ul a:active, .primary-menu-toggle:hover, .primary-menu-toggle:active, .header-search .header-search-icon:hover { color: ' + hover_color + '; }';
			custom_css += '.primary-menu-toggle .icon, .main-navigation .dropdown-toggle .icon, .main-navigation ul .menu-item-has-children > a > .icon { fill: ' + text_color + '; }';
			custom_css += '.primary-menu-toggle:hover .icon, .primary-menu-toggle:active .icon, .main-navigation .dropdown-toggle:hover .icon, .main-navigation .dropdown-toggle:active .icon, .main-navigation ul .menu-item-has-children > a:hover > .icon, .main-navigation ul .menu-item-has-children > a:active > .icon { fill: ' + hover_color + '; }';

			addColorStyles( custom_css, 2 );
		} );
	} );

	/* Content Primary Color Option */
	wp.customize( 'gridbox_theme_options[content_primary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = '.widget-title, .widget-title a:link, .widget-title a:visited, .archive-title, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited, .comments-header .comments-title, .comment-reply-title span, .related-posts-title { color: ' + newval + '; }';
			custom_css += 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .post-navigation .nav-links a, .pagination a, .pagination .current, .infinite-scroll #infinite-handle span, .reply .comment-reply-link, .tzwb-tabbed-content .tzwb-tabnavi li a, .scroll-to-top-button, .scroll-to-top-button:focus, .scroll-to-top-button:active { background: ' + newval + '; }';
			custom_css += '.widget-header, .comments-header, .comment-reply-title, .related-posts-header { border-left: 6px solid ' + newval + '; }';
			custom_css += '.widget-title a:hover, .widget-title a:active, .entry-title a:hover, .entry-title a:active { color: #4477aa; }';

			addColorStyles( custom_css, 3 );

			custom_css = '';
			custom_css += 'a:hover, a:focus, a:active { color: ' + newval + '; }';
			custom_css += '.widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:active, .entry-tags .meta-tags a:hover, .entry-tags .meta-tags a:active, .tzwb-social-icons .social-icons-menu li a:hover, .tzwb-social-icons .social-icons-menu li a:active { background: ' + newval + '; }';

			addColorStyles( custom_css, 5 );

			$( '.has-primary-color' ).css( 'color', newval );
			$( '.has-primary-background-color' ).css( 'background-color', newval );
		} );
	} );

	/* Content Secondary Color Option */
	wp.customize( 'gridbox_theme_options[content_secondary_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css;

			custom_css = 'a, a:link, a:visited, .widget-title a:hover, .widget-title a:active, .entry-title a:hover, .entry-title a:active { color: ' + newval + '; }';
			custom_css += 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, button:active, input[type="button"]:active, input[type="reset"]:active, input[type="submit"]:active, .more-link:hover, .more-link:focus, .more-link:active, .widget_tag_cloud .tagcloud a, .entry-tags .meta-tags a, .post-navigation .nav-links a:hover, .post-navigation .nav-links a:active, .pagination a:hover, .pagination a:active, .pagination .current, .infinite-scroll #infinite-handle span:hover, .infinite-scroll #infinite-handle span:active, .reply .comment-reply-link:hover, .reply .comment-reply-link:active, .tzwb-tabbed-content .tzwb-tabnavi li a:hover, .tzwb-tabbed-content .tzwb-tabnavi li a:active, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .tzwb-social-icons .social-icons-menu li a, .scroll-to-top-button:hover { background: ' + newval + '; }';
			custom_css += 'a:hover, a:focus, a:active { color: #111133; }';

			addColorStyles( custom_css, 4 );

			$( '.has-secondary-color' ).css( 'color', newval );
			$( '.has-secondary-background-color' ).css( 'background-color', newval );
		} );
	} );

	/* Footer Color Option */
	wp.customize( 'gridbox_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color, bg_color;

			custom_css = '.footer-widgets-wrap, .footer-wrap { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.1)';
				bg_color = 'rgba(0,0,0,0.2)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.1)';
				bg_color = 'rgba(255,255,255,0.2)';
			}

			custom_css += '.footer-widget-column, .footer-widget-column .widget-header { border-color: ' + border_color + '; }';
			custom_css += '.site-footer .site-info a, .site-footer .site-info a:link, .site-footer .site-info a:visited, .footer-navigation-menu a, .footer-navigation-menu a:link, .footer-navigation-menu a:visited, .footer-widget-column .widget-title, .footer-widget-column .widget-title a, .footer-widget-column .widget a:link, .footer-widget-column .widget a:visited, #footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a { color: ' + text_color + '; }';
			custom_css += '.site-footer .site-info, .site-footer .site-info a:hover, .site-footer .site-info a:active, .footer-navigation-menu a:hover, .footer-navigation-menu a:active, .footer-widget-column .widget, .footer-widget-column .widget-title a:hover, .footer-widget-column .widget-title a:active, .footer-widget-column .widget a:hover, .footer-widget-column .widget a:hover { color: ' + hover_color + '; }';
			custom_css += '#footer-widgets .tzwb-social-icons .social-icons-menu li a, #footer-widgets .widget_tag_cloud .tagcloud a, #footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a { background: ' + border_color + '; }';
			custom_css += '#footer-widgets .tzwb-social-icons .social-icons-menu li a:hover, #footer-widgets .widget_tag_cloud .tagcloud a:hover, #footer-widgets .widget_tag_cloud .tagcloud a:active, #footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:hover, #footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:active, #footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab { color: ' + text_color + '; background: ' + bg_color + '; }';

			addColorStyles( custom_css, 6 );
		} );
	} );

	/* Text Font */
	wp.customize( 'gridbox_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'text-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--text-font', newFont );
		} );
	} );

	/* Title Font */
	wp.customize( 'gridbox_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--title-font', newFont );
		} );
	} );

	/* Title Font Weight */
	wp.customize( 'gridbox_theme_options[title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--title-font-weight', fontWeight );
		} );
	} );

	/* Title Text Transform */
	wp.customize( 'gridbox_theme_options[title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--title-text-transform', textTransform );
		} );
	} );

	/* Navi Font */
	wp.customize( 'gridbox_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'navi-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--navi-font', newFont );
		} );
	} );

	/* Navi Font Weight */
	wp.customize( 'gridbox_theme_options[navi_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--navi-font-weight', fontWeight );
		} );
	} );

	/* Navi Text Transform */
	wp.customize( 'gridbox_theme_options[navi_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--navi-text-transform', textTransform );
		} );
	} );

	/* Widget Title Font */
	wp.customize( 'gridbox_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Load Font in Customizer.
			loadCustomFont( newval, 'widget-title-font' );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			document.documentElement.style.setProperty( '--widget-title-font', newFont );
		} );
	} );

	/* Widget Title Font Weight */
	wp.customize( 'gridbox_theme_options[widget_title_is_bold]', function( value ) {
		value.bind( function( newval ) {
			var fontWeight = newval ? 'bold' : 'normal';
			document.documentElement.style.setProperty( '--widget-title-font-weight', fontWeight );
		} );
	} );

	/* Widget Title Text Transform */
	wp.customize( 'gridbox_theme_options[widget_title_is_uppercase]', function( value ) {
		value.bind( function( newval ) {
			var textTransform = newval ? 'uppercase' : 'none';
			document.documentElement.style.setProperty( '--widget-title-text-transform', textTransform );
		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

	function writeColorStyles() {
		for( var i = 1; i < 7; i++) {
			$( 'head' ).append( '<style id="gridbox-pro-colors-' + i + '"></style>' );
		}
	}

	function addColorStyles( colorRules, priority ) {

		// Write Color Styles if they do not exist.
		if ( ! $( '#gridbox-pro-colors-1' ).length ) {
			writeColorStyles();
		}

		$( '#gridbox-pro-colors-' + priority ).html( colorRules );
	}

	function loadCustomFont( font, type ) {
		var fontFile = font.split( " " ).join( "+" );
		var fontFileURL = "https://fonts.googleapis.com/css?family=" + fontFile + ":400,700";

		var fontStylesheet = "<link id='gridbox-pro-custom-" + type + "' href='" + fontFileURL + "' rel='stylesheet' type='text/css'>";
		var checkLink = $( "head" ).find( "#gridbox-pro-custom-" + type ).length;

		if (checkLink > 0) {
			$( "head" ).find( "#gridbox-pro-custom-" + type ).remove();
		}
		$( "head" ).append( fontStylesheet );
	}

} )( jQuery );
