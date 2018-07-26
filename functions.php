<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.4' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function ascension_move_elements() {

	remove_action( 'primer_header',                'primer_add_hero',               7 );
	remove_action( 'primer_after_header',          'primer_add_primary_navigation', 11 );
	remove_action( 'primer_after_header',          'primer_add_page_title',         12 );
	remove_action( 'primer_before_header_wrapper', 'primer_video_header',           5 );

	add_action( 'primer_after_header', 'primer_add_hero',               7 );
	add_action( 'primer_header',       'primer_add_primary_navigation', 11 );
	add_action( 'primer_pre_hero',     'primer_video_header',           5 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

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
		'hero_text_color' => array(
			'default' => '#ffffff',
		),
		'menu_text_color' => array(
			'default' => '#194f6e',
		),
		'heading_text_color' => array(
			'default' => '#353535',
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#353535',
		),
		'footer_widget_text_color' => array(
			'default' => '#252525',
		),
		'footer_menu_text_color' => array(
			'default' => '#686868',
		),
		'footer_text_color' => array(
			'default' => '#686868',
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
		'button_text_color' => array(
			'default'  => '#ffffff',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#252525',
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
				'header_textcolor' => $color_schemes['blush']['base'],
				'menu_text_color'  => $color_schemes['blush']['base'],
				'link_color'       => $color_schemes['blush']['base'],
				'button_color'     => $color_schemes['blush']['base'],
			),
		),
		'bronze' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['bronze']['base'],
				'menu_text_color'  => $color_schemes['bronze']['base'],
				'link_color'       => $color_schemes['bronze']['base'],
				'button_color'     => $color_schemes['bronze']['base'],
			),
		),
		'canary' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['canary']['base'],
				'menu_text_color'  => $color_schemes['canary']['base'],
				'link_color'       => $color_schemes['canary']['base'],
				'button_color'     => $color_schemes['canary']['base'],
			),
		),
		'cool' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['cool']['base'],
				'menu_text_color'  => $color_schemes['cool']['base'],
				'link_color'       => $color_schemes['cool']['base'],
				'button_color'     => $color_schemes['cool']['base'],
			),
		),
		'dark' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#ffffff',
				'tagline_text_color'               => '#999999',
				'menu_text_color'                  => '#ffffff',
				'heading_text_color'               => '#ffffff',
				'primary_text_color'               => '#e5e5e5',
				'secondary_text_color'             => '#c1c1c1',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				// Backgrounds
				'background_color'               => '#222222',
				'hero_background_color'          => '#282828',
				'menu_background_color'          => '#333333',
				'footer_widget_background_color' => '#282828',
				'footer_background_color'        => '#222222',
			),
		),
		'iguana' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['iguana']['base'],
				'menu_text_color'  => $color_schemes['iguana']['base'],
				'link_color'       => $color_schemes['iguana']['base'],
				'button_color'     => $color_schemes['iguana']['base'],
			),
		),
		'muted' => array(
			'colors' => array(
				// Text
				'header_textcolor'       => '#ffffff',
				'tagline_text_color'     => '#ffffff',
				'menu_text_color'        => '#ffffff',
				'heading_text_color'     => '#4f5875',
				'primary_text_color'     => '#4f5875',
				'secondary_text_color'   => '#888c99',
				'footer_menu_text_color' => $color_schemes['muted']['base'],
				'footer_text_color'      => '#4f5875',
				// Links & Buttons
				'link_color'   => $color_schemes['muted']['base'],
				'button_color' => $color_schemes['muted']['base'],
				// Backgrounds
				'background_color'               => '#ffffff',
				'hero_background_color'          => '#4f5875',
				'menu_background_color'          => '#5a6175',
				'footer_widget_background_color' => '#d5d6e0',
				'footer_background_color'        => '#ffffff',
			),
		),
		'plum' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['plum']['base'],
				'menu_text_color'  => $color_schemes['plum']['base'],
				'link_color'       => $color_schemes['plum']['base'],
				'button_color'     => $color_schemes['plum']['base'],
			),
		),
		'rose' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['rose']['base'],
				'menu_text_color'  => $color_schemes['rose']['base'],
				'link_color'       => $color_schemes['rose']['base'],
				'button_color'     => $color_schemes['rose']['base'],
			),
		),
		'tangerine' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['tangerine']['base'],
				'menu_text_color'  => $color_schemes['tangerine']['base'],
				'link_color'       => $color_schemes['tangerine']['base'],
				'button_color'     => $color_schemes['tangerine']['base'],
			),
		),
		'turquoise' => array(
			'colors' => array(
				'header_textcolor' => $color_schemes['turquoise']['base'],
				'menu_text_color'  => $color_schemes['turquoise']['base'],
				'link_color'       => $color_schemes['turquoise']['base'],
				'button_color'     => $color_schemes['turquoise']['base'],
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'ascension_color_schemes' );
