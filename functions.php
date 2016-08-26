<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function ascension_move_elements() {

	remove_action( 'primer_header',       'primer_add_hero' );
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_after_header', 'primer_add_hero' );
	add_action( 'primer_header',       'primer_add_primary_navigation' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'ascension_move_elements' );

/**
 * Set hero image target element.
 *
 * @filter primer_hero_image_selector
 * @since  1.0.0
 *
 * @return string
 */
function ascension_hero_image_selector() {

	return '.hero';

}
add_filter( 'primer_hero_image_selector', 'ascension_hero_image_selector' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function ascension_custom_logo_args( $args ) {

	$args['width']  = 325;
	$args['height'] = 70;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'ascension_custom_logo_args' );

/**
 * Set sidebars.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
 *
 * @return array
 */
function ascension_sidebars( $sidebars ) {

	$sidebars['footer-4'] = array(
		'name'          => esc_html__( 'Footer 4', 'ascension' ),
		'description'   => esc_html__( 'This sidebar is the fourth column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'ascension_sidebars' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function ascension_fonts( $fonts ) {

	$fonts[] = 'Open Sans';

	return $fonts;

}
add_filter( 'primer_fonts', 'ascension_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function ascension_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Open Sans',
		),
		'navigation_font' => array(
			'default' => 'Open Sans',
		),
		'heading_font' => array(
			'default' => 'Open Sans',
		),
		'primary_font' => array(
			'default' => 'Open Sans',
		),
		'secondary_font' => array(
			'default' => 'Open Sans',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'ascension_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function ascension_colors( $colors ) {

	unset(
		$colors['content_background_color'],
		$colors['footer_widget_content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default'  => '#194f6e',
		),
		'tagline_text_color' => array(
			'default'  => '#686868',
		),
		'menu_text_color' => array(
			'default' => '#194f6e',
			'css'     => array(
				'.main-navigation ul li a:hover,
				.main-navigation ul li.current-page-item a,
				.main-navigation ul li.current-menu-item a,
				.main-navigation ul li.current_page_ancestor a,
				.main-navigation ul li.current_page_parent a,
				.main-navigation ul li.current-menu-ancestor a' => array(
					'border-color' => '%1$s',
				),
			),
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#00bfff',
		),
		'button_color' => array(
			'default'  => '#00bfff',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'menu_background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_widget_background_color' => array(
			'default' => '#f5f5f5',
		),
		'footer_background_color' => array(
			'default' => '#ffffff',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'ascension_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function ascension_color_schemes( $color_schemes ) {

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'header_textcolor'      => '#cc494f',
				'menu_text_color'       => '#cc494f',
				'menu_background_color' => '#ffffff',
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor'      => '#b1a18b',
				'menu_text_color'       => '#b1a18b',
				'menu_background_color' => '#ffffff',
			),
		),
		'canary' => array(
			'colors' => array(
				'header_textcolor'      => '#e9c46a',
				'menu_text_color'       => '#e9c46a',
				'menu_background_color' => '#ffffff',
			),
		),
		'dark' => array(
			'colors' => array(
				'link_color'   => '#00bfff',
				'button_color' => '#00bfff',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor'      => '#62bf7c',
				'menu_text_color'       => '#62bf7c',
				'menu_background_color' => '#ffffff',
			),
		),
		'muted' => array(
			'colors' => array(
				'background_color'               => '#ffffff',
				'hero_background_color'          => '#4f5875',
				'menu_background_color'          => '#5a6175',
				'footer_widget_background_color' => '#d5d6e0',
				'footer_background_color'        => '#ffffff',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor'      => '#5d5179',
				'menu_text_color'       => '#5d5179',
				'menu_background_color' => '#ffffff',
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor'      => '#f49390',
				'menu_text_color'       => '#f49390',
				'menu_background_color' => '#ffffff',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor'      => '#fc9e4f',
				'menu_text_color'       => '#fc9e4f',
				'menu_background_color' => '#ffffff',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor'      => '#48e5c2',
				'menu_text_color'       => '#48e5c2',
				'menu_background_color' => '#ffffff',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'ascension_color_schemes' );
