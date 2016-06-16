<?php

function basis_enqueue_jquery() {

	add_filter( 'script_loader_tag', function( $tag, $handle ) {
		if ( $handle === 'jquery-core' ) {
			$tag = "<!--[if (gte IE 9) | (!IE)]><!-->$tag<!--<![endif]-->";
		}
		return $tag;
	}, 10, 2 );

	//wp_enqueue_script( 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'basis_enqueue_jquery', 0 );

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';



function basis_font_switcher($wp_customize) {
	$fonts = basis_get_fonts();
	$default_font = $fonts[0];

	$wp_customize->add_setting( 'main_font', array(
		'default'			=> 'Open Sans',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'main_font', array(
		'label'    => __( 'Font', 'twentysixteen' ),
		'section'  => 'title_tagline',
		'type'     => 'select',
		'choices'  => basis_get_font_choices()
	) );
}
add_action('customize_register', 'basis_font_switcher');

function basis_get_fonts() {
	return apply_filters( 'basis_fonts', array(
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

function basis_get_font() {
	$font_option    = get_theme_mod( 'main_font', 'default' );
	$fonts          = basis_get_fonts();

	if ( in_array( $font_option, $fonts ) ) {
		return $font_option;
	}

	return $fonts[ 0 ];
}

function basis_get_font_choices() {
	$fonts                  = basis_get_fonts();
	$font_control_options   = array();

	foreach ( $fonts as $font ) {
		$font_control_options[ $font ] = $font;
	}

	return $font_control_options;
}

function basis_fonts_css() {
	$fonts                  = basis_get_fonts();
	$default_font           = $fonts[0];
	$main_font              = get_theme_mod( 'main_font', $default_font );

	$font = basis_get_font();
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

	wp_add_inline_style( 'basis', sprintf( $css, $main_font ) );
}
add_action( 'wp_enqueue_scripts', 'basis_fonts_css', 11 );





function basis_full_width_customizer($wp_customize) {
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
add_action('customize_register', 'basis_full_width_customizer');




function basis_full_width_classes( $classes ) {
	if( get_theme_mod('full_width') == 1 ) {
		$classes[] = 'no-max-width';
	}
	return $classes;
}
add_filter( 'body_class', 'basis_full_width_classes' );



function basis_theme_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 62,
		'width'       => 352,
		'flex-width'  => true,
	) );

	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );

	add_editor_style();

}
add_action( 'after_setup_theme', 'basis_theme_setup' );

function basis_replace_navigation() {
	wp_dequeue_script( 'basis-navigation' );
	wp_enqueue_script( 'basis-navigation-2', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array('jquery'), '20120206', true );
}
add_action( 'wp_print_scripts', 'basis_replace_navigation', 100 );

function basis_add_mobile_menu(){
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'basis_header', 'basis_add_mobile_menu', 0 );

function basis_move_navigation(){
	remove_action( 'basis_header_after', 'basis_add_primary_navigation', 20 );
	add_action( 'basis_header', 'basis_add_primary_navigation', 20 );
}
add_action( 'init', 'basis_move_navigation', 100 );

function basis_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'basis' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'The primary sidebar appears alongside the content of every page, post, archive, and search template.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'basis' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'The secondary sidebar will only appear when you have selected a three-column layout.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'basis' ),
		'id'            => 'footer-1',
		'description'   => __( 'The footer sidebar appears in the first column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'basis' ),
		'id'            => 'footer-2',
		'description'   => __( 'The footer sidebar appears in the second column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'basis' ),
		'id'            => 'footer-3',
		'description'   => __( 'The footer sidebar appears in the third column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'basis' ),
		'id'            => 'footer-4',
		'description'   => __( 'The footer sidebar appears in the fourth column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Hero', 'basis' ),
		'id'            => 'hero',
		'description'   => __( 'The hero appears in the hero widget area on the front page', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}



function basis_get_featured_image() {
	$post_id = get_queried_object_id();
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, 'hero' );
		if( getimagesize( $image ) ) {
				return $image;
		}
	}

	return header_image();
}

function basis_count_footer_columns() {
	$sidebars = array( 'footer-1', 'footer-2', 'footer-3', 'footer-4' );
	$count = 0;

	foreach( $sidebars as $sidebar ) {
		if( is_active_sidebar( $sidebar ) ) $count++;
	}

	return $count;
}

?>
