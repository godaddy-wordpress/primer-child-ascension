<?php

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Enqueue jQuery.
 *
 * Wraps jQuery in a conditional comment that will allow
 * non-IE 9 (and lower) browsers to use the newest version
 * of jQuery.
 *
 * @action  wp_enqueue_scripts
 */
function primer_enqueue_jquery() {

	add_filter( 'script_loader_tag', function( $tag, $handle ) {
		if ( $handle === 'jquery-core' ) {
			$tag = "<!--[if (gte IE 9) | (!IE)]><!-->$tag<!--<![endif]-->";
		}
		return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'primer_enqueue_jquery', 0 );

/**
 * Font customization controls.
 *
 * Adds control for font pair selection.
 *
 * @action  customize_register
 */
function primer_font_switcher($wp_customize) {
	$fonts = primer_get_fonts();
	$default_font = $fonts[0];

	$wp_customize->add_setting( 'main_font', array(
		'default'			=> 'Open Sans',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'main_font', array(
		'label'    => __( 'Font', 'ascension' ),
		'section'  => 'title_tagline',
		'type'     => 'select',
		'choices'  => primer_get_font_choices()
	) );
}
add_action('customize_register', 'primer_font_switcher');

/**
 * Lists acceptable font pairings
 *
 * Returns a filterable list of font families for site
 * customization.
 *
 * @filter  primer_fonts
 */
function primer_get_fonts() {
	return apply_filters( 'primer_fonts', array(
		'Open Sans',
		'Source Sans Pro',
		'Roboto',
		'Lato',
		'Montserrat',
		'Raleway',
		'PT Sans',
		'Noto Sans',
		'Muli',
		'Oxygen',
		'Source Serif Pro',
		'PT Serif'
	));
}

/**
 * Return primary or default font
 *
 */
function primer_get_font() {
	$font_option    = get_theme_mod( 'main_font', 'default' );
	$fonts          = primer_get_fonts();

	if ( in_array( $font_option, $fonts ) ) {
		return $font_option;
	}

	return $fonts[ 0 ];
}

/**
 * Return font options
 *
 * Return the full set of font family options.
 */
function primer_get_font_choices() {
	$fonts                  = primer_get_fonts();
	$font_control_options   = array();

	foreach ( $fonts as $font ) {
		$font_control_options[ $font ] = $font;
	}

	return $font_control_options;
}

/**
 * Return font options
 *
 * Return the full set of font family options.
 */

function primer_fonts_css() {
	$fonts                  = primer_get_fonts();
	$default_font           = $fonts[0];
	$main_font              = get_theme_mod( 'main_font', $default_font );

	$font = primer_get_font();
	$font_url = '//fonts.googleapis.com/css?family=' . $font . ':600,600italic,800,300,300italic,400,400italic,700,700italic,800italic';
	wp_enqueue_style( 'ascension-google-fonts', $font_url, false );

	if ( $main_font === $default_font ) {
		return;
	}

	$css = '
		/* Custom Fonts */
		body,
		h1, h2, h3, h4, h5, h6,
		blockquote,
		blockquote.aligncenter,
		blockquote.aligncenter cite,
		button, a.button, .social-menu a, input, select, textarea,
		label,
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
		.featured-content .entry-header .read-more,
		.featured-content .entry-title,
		.featured-content .read-more {
			font-family: "%1$s", "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		}
	';

	wp_add_inline_style( 'ascension', sprintf( $css, $main_font ) );
}
add_action( 'wp_enqueue_scripts', 'primer_fonts_css', 11 );





function primer_full_width_customizer($wp_customize) {
	$wp_customize->add_setting('full_width', array(
		'default'				=> 0,
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('full_width', array(
		'label'	 => 'Full Width Header / Footer',
		'section' => 'layout',
		'type'		=> 'radio',
		'choices'	=> array(
			0	=> "Disabled",
			1 => "Enabled",
		),
	));
}
add_action('customize_register', 'primer_full_width_customizer');




function primer_full_width_classes( $classes ) {
	if( get_theme_mod('full_width') == 1 ) {
		$classes[] = 'no-max-width';
	}
	return $classes;
}
add_filter( 'body_class', 'primer_full_width_classes' );



function primer_theme_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 62,
		'width'       => 352,
		'flex-width'  => true,
	) );

	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );

	add_editor_style();

}
add_action( 'after_setup_theme', 'primer_theme_setup' );

function ascension_navigation() {
	wp_dequeue_script( 'basis-navigation' );
	wp_enqueue_script( 'ascension-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20120206', true );
}
add_action( 'wp_print_scripts', 'ascension_navigation', 100 );

function primer_add_mobile_menu(){
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'primer_header', 'primer_add_mobile_menu', 0 );

function primer_move_navigation(){
	remove_action( 'primer_header_after', 'primer_add_primary_navigation', 20 );
	add_action( 'primer_header', 'primer_add_primary_navigation', 20 );
}
add_action( 'init', 'primer_move_navigation', 100 );

function primer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ascension' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'The primary sidebar appears alongside the content of every page, post, archive, and search template.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'ascension' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'The secondary sidebar will only appear when you have selected a three-column layout.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ascension' ),
		'id'            => 'footer-1',
		'description'   => __( 'The footer sidebar appears in the first column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ascension' ),
		'id'            => 'footer-2',
		'description'   => __( 'The footer sidebar appears in the second column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ascension' ),
		'id'            => 'footer-3',
		'description'   => __( 'The footer sidebar appears in the third column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ascension' ),
		'id'            => 'footer-4',
		'description'   => __( 'The footer sidebar appears in the fourth column of the footer widget area.', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Hero', 'ascension' ),
		'id'            => 'hero',
		'description'   => __( 'The hero appears in the hero widget area on the front page', 'ascension' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

function primer_get_featured_image() {
	$post_id = get_queried_object_id();

	if( get_theme_mod('full_width') == 1 ) {
		$image_size = 'hero-2x';
	} else {
		$image_size = 'hero';
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $image_size );

		if( getimagesize( $image ) ) {
				return $image;
		}
	}

	$header_image = get_header_image();
	$image_id = primer_get_image_id( $header_image );

	if( empty( $image_id ) ) {
		return $header_image;
	}

	$image = wp_get_attachment_image_src( $image_id, $image_size, true );
	return $image[0];
}

function primer_count_footer_columns() {
	$sidebars = array( 'footer-1', 'footer-2', 'footer-3', 'footer-4' );
	$count = 0;

	foreach( $sidebars as $sidebar ) {
		if( is_active_sidebar( $sidebar ) ) $count++;
	}

	return $count;
}

function primer_get_image_id( $image_url ) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}

?>
