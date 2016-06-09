<?php
/**
 * Displays the footer widget zones.
 *
 * @package basis
 */
?>

<?php if( is_active_sidebar( 'footer-1' ) && is_active_sidebar( 'footer-2' ) && is_active_sidebar( 'footer-3' ) && is_active_sidebar( 'footer-4' ) ): ?>

<div class="footer-widget-area">

	<div class="footer-widget">
		<?php get_template_part( 'templates/parts/site-title' ); ?>
		<?php if( is_active_sidebar( 'footer-4' ) ): ?>
			<?php dynamic_sidebar( 'footer-4' ); ?>
		<?php endif;?>
		<?php if( has_nav_menu( 'social' ) ): ?>
			<div class="social-menu">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'social',
						'depth'          => 1,
						'fallback_cb'    => false
					) ); ?>
			</div><!-- .social-menu -->
		<?php endif; ?>
	</div>

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

</div>

<?php endif; ?>
