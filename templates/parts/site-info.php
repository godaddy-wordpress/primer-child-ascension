<?php
/**
 * Displays the footer site info.
 *
 * @package ascension
 */
?>

<div class="site-info-wrapper">
	<div class="site-info">
		<div class="site-info-inner">
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

			<div class="site-info-text">
				<p>Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</p>
				<p>Built with <a href="https://www.godaddy.com/" target="_blank">GoDaddy</a></p>
			</div><!-- .site-info-text -->

		</div><!-- .site-info-inner -->
	</div><!-- .site-info -->
</div><!-- .site-info-wrapper -->
