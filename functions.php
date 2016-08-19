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
 * Set the default hero image description.
 *
 * @filter primer_default_hero_images
 * @since  1.0.0
 *
 * @param  array $defaults
 *
 * @return array
 */
function ascension_default_hero_images( $defaults ) {

	$defaults['default']['description'] = esc_html__( 'Professional woman reading a tablet', 'ascension' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'ascension_default_hero_images' );

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
		$colors['menu_background_color']
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
				'.main-navigation ul li.current-menu-item, .main-navigation ul li:hover' => array(
					'border-color' => '%1$s',
				),
				'.main-navigation ul ul, .main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#39baf3',
		),
		'button_color' => array(
			'default'  => '#39baf3',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation ul li.menu-item-has-children .sub-menu li a' => array(
					'color' => '%1$s',
				),
			),
		),
		'hero_background_color' => array(
			'default' => '#194f6e',
		),
		'footer_widget_background_color' => array(
			'default' => '#f9f9fa',
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
				'header_textcolor'   => '#b84247',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#b84247',
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor'   => '#a0917d',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#a0917d',
			),
		),
		'canary' => array(
			'colors' => array(
				'header_textcolor'   => '#d2b160',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#d2b160',
			),
		),
		'dark' => array(
			'colors' => array(
				'hero_background_color' => '#333333',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor'   => '#58ac70',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#58ac70',
			),
		),
		'muted' => array(
			'colors' => array(
				'header_textcolor'   => '#5a6175',
				'tagline_text_color' => '#5a6175',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor'   => '#54496d',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#54496d',
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor'   => '#dc8582',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#dc8582',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor'   => '#e38f47',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#e38f47',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor'   => '#41cfaf',
				'tagline_text_color' => '#686868',
				'menu_text_color'    => '#41cfaf',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'ascension_color_schemes' );
