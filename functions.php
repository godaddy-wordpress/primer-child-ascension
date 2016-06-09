<?php

function check_admin_things(){
  remove_action( 'basis_header_after', 'basis_add_primary_navigation', 20 );
	add_action( 'basis_header', 'basis_add_primary_navigation', 20 );
}
add_action( 'init', 'check_admin_things', 100 );

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
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Left', 'basis' ),
		'id'            => 'footer-1',
		'description'   => __( 'The footer left sidebar appears in the first column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Center', 'basis' ),
		'id'            => 'footer-2',
		'description'   => __( 'The footer center sidebar appears in the second column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'basis' ),
		'id'            => 'footer-3',
		'description'   => __( 'The footer right sidebar appears in the third column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}

?>
