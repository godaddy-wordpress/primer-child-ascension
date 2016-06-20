<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Basis
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<!--[if lt IE 9]>

	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/ie.css">

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/respond.min.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/nwmatcher.min.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.min.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/html5shiv.min.js"></script>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/selectivizr.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/rem.min.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.backgroundSize.js"></script>

	<script type="text/javascript">
	$(document).ready(function($){
		$('body .hero').css({backgroundSize: "cover"});
	});
	</script>

<![endif] -->

</head>
<body <?php body_class(); ?>>

<?php do_action( 'primer_body_inside' ); ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ascension' ); ?></a>

	<?php do_action( 'primer_header_before' ); ?>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-header-wrapper">

			<?php do_action( 'primer_header' ); ?>

		</div>

	</header><!-- #masthead -->

	<?php do_action( 'primer_header_after' ); ?>

		<?php
			if( ! is_404() && ! is_page_template( 'templates/page-builder-default-header.php' ) ) {
				get_template_part( 'templates/parts/hero' );
			}
		?>

		<div id="content" class="site-content">
