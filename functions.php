<?php

/**
 * Load custom template tags for this theme.
 *
 * @since 1.0.0
 */
require_once get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Add images sizes.
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function ascension_add_image_sizes() {

	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'ascension_add_image_sizes' );

/**
 * Update custom logo width and height
 *
 * @action primer_custom_logo_args
 * @param $args
 * @return array
 */
function ascension_update_custom_logo_args( $args ) {

	$args['width'] = 352;
	$args['height'] = 62;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'ascension_update_custom_logo_args' );

/**
 * Update custom header width and height
 *
 * @action primer_custom_header_args
 * @param $args
 * @return array
 */
function ascension_update_custom_header_args( $args ) {

	$args['width'] = 2120;
	$args['height'] = 1100;

	return $args;

}
add_filter( 'primer_custom_header_args', 'ascension_update_custom_header_args' );

/**
 * Move Navigation from after header to inside header.
 *
 * @action after_setup_theme
 */
function ascension_move_navigation() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20 );
	add_action( 'primer_header', 'primer_add_primary_navigation', 20 );

}
add_action( 'after_setup_theme', 'ascension_move_navigation' );

/**
 * Display the hero before the header.
 *
 * @action after_setup_theme
 * @since 1.0.0
 */
function stout_add_site_header() {

	remove_action( 'primer_header', 'primer_add_site_header', 10 );

	if ( is_404() || is_page_template( 'templates/page-builder-default-header.php' ) ) {
		return;
	}

	add_action( 'primer_after_header', 'primer_add_site_header', 10 );

}
add_action( 'template_redirect', 'stout_add_site_header' );

/**
 * Add additional sidebars
 *
 * @action primer_register_sidebars
 * @since 1.0.0
 * @param $sidebars
 * @return array
 */
function ascension_add_sidebars( $sidebars ) {

	$new_sidebars = array(
		array(
			'name'          => __( 'Footer 4', 'ascension' ),
			'id'            => 'footer-4',
			'description'   => __( 'The footer sidebar appears in the fourth column of the footer widget area.', 'ascension' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
		array(
			'name'          => __( 'Hero', 'ascension' ),
			'id'            => 'hero',
			'description'   => __( 'The hero appears in the hero widget area on the front page', 'ascension' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		),
	);

	return array_merge( $sidebars, $new_sidebars );

}
add_filter( 'primer_register_sidebars', 'ascension_add_sidebars' );

/**
 * Change Stout font types.
 *
 * @action primer_font_types
 * @since 1.0.0
 * @return array
 */
function ascension_font_types() {

	return array(
		array(
			'name'    => 'primary_font',
			'label'   => esc_html__( 'Primary Font', 'primer' ),
			'default' => 'Open Sans',
			'css'     => array(
				'body,
				p,
				h1, h2, h3, h4, h5, h6,
				ul, ol, dl,
				blockquote,
				blockquote .aligncenter, blockquote .aligncenter cite,
				button, a.button, .social-menu a, input, select, textarea,
				label,
				legend,
				.main-navigation ul li a, 
				.widget-title,
				.entry-footer,
				.entry-meta,
				.event-meta, .sermon-meta, .location-meta, .person-meta,
				.post-format,
				.more-link,
				article.format-link,
				.comment-list li .comment-author, .comment-list li .comment-metadata,
				#respond,
				.site-title,
				.site-description,
				.featured-content .entry-header .entry-title,
				.featured-content .entry-header .read-more' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

}
add_action( 'primer_font_types', 'ascension_font_types' );

/**
 * Change Stout colors
 *
 * @action primer_colors
 * @since 1.0.0
 * @return array
 */
function ascension_colors() {

	return array(
		array(
			'name'    => 'header_textcolor',
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'background_color',
			'default' => '#',
		),
		array(
			'name'    => 'header_background_color',
			'label'   => esc_html__( 'Header Background Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'tagline_text_color',
			'label'   => esc_html__( 'Tagline Text Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'menu_background_color',
			'label'   => esc_html__( 'Menu Background Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'link_color',
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
				'' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
				'' => array(
					'background-color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		array(
			'name'    => 'main_text_color',
			'label'   => esc_html__( 'Main Text Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
					'color' => '%1$s',
				),
			),
		),
		array(
			'name'    => 'secondary_text_color',
			'label'   => esc_html__( 'Secondary Text Color', 'primer' ),
			'default' => '#',
			'css'     => array(
				'' => array(
						'color' => '%1$s',
				),
			),
		),
	);

}
add_action( 'primer_colors', 'ascension_colors' );
