<?php if( primer_get_custom_header() ): ?>
<div class="hero" style="background:url('<?php echo primer_get_custom_header(); ?>') no-repeat top center; background-size: cover;">
<?php else: ?>
<div class="hero">
<?php endif; ?>
	<div class="hero-wrapper<?php if( is_front_page() && is_active_sidebar( 'hero' ) ): ?> home<?php endif; ?>">
		<div class="hero-inner">
			<?php if( is_front_page() && is_active_sidebar( 'hero' ) ): ?>
				<?php dynamic_sidebar( 'hero' ); ?>
			<?php elseif( is_page() ): ?>
				<?php get_template_part( 'templates/parts/loop/page-title' ); ?>
			<?php elseif( is_search() ): ?>
				<header class="page-header">
					<h1 class="page-title"><?php printf( esc_html_x( 'Search Results for: %s', 'search term(s)', 'ascension' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->
			<?php elseif( get_post_type() == 'post' ): ?>
				<h1><?php esc_html_e( 'Blog', 'ascension' ) ?></h1>
			<?php endif; ?>
		</div>
	</div>
</div>
