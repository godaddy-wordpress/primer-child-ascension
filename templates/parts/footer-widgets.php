<?php
/**
 * Displays the footer widget zones.
 *
 * @package ascension
 */
?>

<?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ): ?>

<div class="footer-widget-area columns-<?php echo primer_count_footer_columns(); ?>">

	<?php if( is_active_sidebar( 'footer-1' ) ): ?>
		<div class="footer-widget">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>

	<?php if( is_active_sidebar( 'footer-2' ) ): ?>
		<div class="footer-widget">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
	<?php endif; ?>

	<?php if( is_active_sidebar( 'footer-3' ) ): ?>
		<div class="footer-widget">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
	<?php endif; ?>

	<?php if( is_active_sidebar( 'footer-4' ) ): ?>
		<div class="footer-widget">
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>
	<?php endif; ?>

</div>

<?php endif; ?>
