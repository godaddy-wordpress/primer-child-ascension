<?php

function primer_add_image_sizes() {
	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );
	add_image_size( 'hero-2x', 2120, 1100, array( 'center', 'center' ) );
}
add_action( 'after_setup_theme', 'primer_add_image_sizes' );

function primer_update_custom_logo_args( $args ) {
	$args['width'] = 352;
	$args['height'] = 62;

	return $args;
}
add_filter( 'primer_custom_logo_args', 'primer_update_custom_logo_args' );

function primer_update_custom_header_args( $args ) {
	$args['width'] = 2120;
	$args['height'] = 1100;

	return $args;
}
add_filter( 'primer_custom_header_args', 'primer_update_custom_header_args' );

function primer_update_custom_fonts_css( $css ) {
	$css = '/* Custom Fonts */
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

	return $css;
}
add_filter( 'custom_fonts_css', 'primer_update_custom_fonts_css' );

function ascension_navigation() {
	wp_dequeue_script( 'primer-navigation' );
	wp_enqueue_script( 'ascension-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120206', true );
}
add_action( 'wp_print_scripts', 'ascension_navigation', 100 );

function primer_add_mobile_menu() {
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'primer_header', 'primer_add_mobile_menu', 0 );

function primer_move_navigation() {
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
		if ( 'jquery-core' === $handle ) {
			$tag = "<!--[if (gte IE 9) | (!IE)]><!-->$tag<!--<![endif]-->";
		}
		return $tag;
	}, 10, 2 );

}
add_action( 'wp_enqueue_scripts', 'primer_enqueue_jquery', 0 );



/**
 * Get the ID of an image for a given URL
 *
 * @note Let's do something different here...
 */
function primer_get_image_id( $image_url ) {
	global $wpdb;
	return $wpdb->get_var(
		$wpdb->prepare(
			"SELECT ID FROM $wpdb->posts WHERE guid='%s';",
			$image_url
		)
	);
}

/**
 * Get the custom header or feauterd image if available
 *
 */
function primer_get_custom_header() {
	$post_id = get_queried_object_id();

	if ( get_theme_mod('full_width') == 1 ) {
		$image_size = 'hero-2x';
	} else {
		$image_size = 'hero';
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $image_size );

		if ( getimagesize( $image ) ) {
				return $image;
		}
	}

	$header_image = get_header_image();
	$image_id = primer_get_image_id( $header_image );

	if ( empty( $image_id ) ) {
		return $header_image;
	}

	$image = wp_get_attachment_image_src( $image_id, $image_size, true );
	return $image[0];
}

?>
