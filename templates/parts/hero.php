<div class="hero<?php if( is_front_page() ): ?> home<?php endif; ?>" style="background:url('<?php echo get_featured_image( ); ?>') no-repeat top center; background-size: cover;">
	<div class="hero-inner">
		<?php if( is_front_page() && is_active_sidebar( 'hero' ) ): ?>
			<?php dynamic_sidebar( 'hero' ); ?>
		<?php elseif( is_page() ): ?>
			<?php get_template_part( 'templates/parts/loop/page-title' ); ?>
		<?php elseif( is_search() ): ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'basis' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
		<?php elseif( get_post_type() == 'post' ): ?>
			<h1>Blog</h1>
		<?php endif; ?>
	</div>
</div>
