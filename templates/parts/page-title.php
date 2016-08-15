<?php
/**
 * Displays page titles.
 *
 * @package Ascension
 */
?>

<?php if ( primer_get_the_page_title() ) : ?>

	<div class="page-title-container">

		<header class="page-header"<?php if ( primer_has_hero_image() ) : ?> style="background:url('<?php echo primer_get_hero_image(); ?>') no-repeat top center; background-size: cover;"<?php endif; ?>>

			<?php
			/**
			 * Fires before the page title element.
			 *
			 * @since 1.0.0
			 */
			do_action( 'primer_before_page_title' );
			?>

			<h1 class="page-title"><?php primer_the_page_title() ?></h1>

			<?php
			/**
			 * Fires after the page title element.
			 *
			 * @since 1.0.0
			 */
			do_action( 'primer_after_page_title' );
			?>

		</header><!-- .entry-header -->

	</div><!-- .page-title-container -->

</div><!-- .hero -->

<?php endif; ?>
