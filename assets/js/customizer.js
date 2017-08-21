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
				hideElement( '.primary-navigation .main-navigation-menu li.header-search' );
			} else {
				showElement( '.primary-navigation .main-navigation-menu li.header-search' );
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

			custom_css = '.header-bar-wrap, .top-navigation-menu ul { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.1)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			custom_css += '.top-navigation-menu, .top-navigation-menu a, .top-navigation-menu ul a, .top-navigation-menu li ul ul { border-color: ' + border_color + '; }';
			custom_css += '.header-bar-wrap, .top-navigation-menu a, .top-navigation-menu a:link, .top-navigation-menu a:visited, .top-navigation-toggle, .top-navigation-toggle:focus, .top-navigation-menu .submenu-dropdown-toggle, .header-bar .social-icons-menu li a, .header-bar .social-icons-menu li a:link, .header-bar .social-icons-menu li a:visited { color: ' + text_color + '; }';
			custom_css += '.top-navigation-menu a:hover, .top-navigation-menu a:active, .top-navigation-toggle:hover, .top-navigation-toggle:active, .top-navigation-menu .submenu-dropdown-toggle:hover, .top-navigation-menu .submenu-dropdown-toggle:active, .header-bar .social-icons-menu li a:hover, .header-bar .social-icons-menu li a:active { color: ' + hover_color + '; }';

			addColorStyles( custom_css, 1 );
		} );
	} );

	/* Header Color Option */
	wp.customize( 'gridbox_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			var custom_css, text_color, hover_color, border_color;

			custom_css = '.site-header, .main-navigation-menu ul { background: ' + newval + '; }';

			if( isColorLight( newval ) ) {
				text_color = '#222222';
				hover_color = 'rgba(0,0,0,0.6)';
				border_color = 'rgba(0,0,0,0.1)';
			} else {
				text_color = '#ffffff';
				hover_color = 'rgba(255,255,255,0.6)';
				border_color = 'rgba(255,255,255,0.1)';
			}

			custom_css += '.main-navigation-menu, .main-navigation-menu a, .main-navigation-menu ul a, .main-navigation-menu li ul ul, .header-search .header-search-form { border-color: ' + border_color + '; }';
			custom_css += '.site-title, .site-title a:link, .site-title a:visited, .main-navigation-menu a, .main-navigation-menu a:link, .main-navigation-menu a:visited, .main-navigation-toggle, .main-navigation-toggle:focus, .main-navigation-menu .submenu-dropdown-toggle { color: ' + text_color + '; }';
			custom_css += '.site-title a:hover, .site-title a:active, .main-navigation-menu a:hover, .main-navigation-menu a:active, .main-navigation-toggle:hover, .main-navigation-toggle:active, .main-navigation-menu .submenu-dropdown-toggle:hover, .main-navigation-menu .submenu-dropdown-toggle:active { color: ' + hover_color + '; }';

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

	/* Theme Fonts */
	wp.customize( 'gridbox_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='gridbox-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#gridbox-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#gridbox-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'gridbox_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='gridbox-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#gridbox-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#gridbox-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.site-title, .archive-title, .page-title, .entry-title' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'gridbox_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='gridbox-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#gridbox-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#gridbox-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.main-navigation-menu a' )
				.css( 'font-family', newval );

		} );
	} );

	wp.customize( 'gridbox_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='gridbox-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#gridbox-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#gridbox-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set CSS.
			$( '.comments-header .comments-title, .comment-reply-title span, .widget-title' )
				.css( 'font-family', newval );

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

} )( jQuery );
