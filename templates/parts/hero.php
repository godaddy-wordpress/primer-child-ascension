<?php
/**
 * Displays the site header.
 *
 * @package Ascension
 */
?>

<?php if ( primer_has_hero_image() && is_front_page() && is_active_sidebar( 'hero' ) ) : ?>

	<div class="hero" <?php if( primer_has_hero_image() ): ?> style="background-image: url(<?php echo primer_get_hero_image(); ?>);"<?php endif; ?>>

		<?php dynamic_sidebar( 'hero' ); ?>

	</div>

<?php endif; ?>
