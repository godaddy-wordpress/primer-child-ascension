<?php
/**
 * Displays the primary navigation.
 *
 * @package ascension
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) :  ?>
	<div class="main-navigation-container">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'link_after' => '<span></span>',
				)
			); ?>
		</nav><!-- #site-navigation -->
	</div>
<?php endif; ?>
