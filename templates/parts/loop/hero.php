<div class="hero<?php if( is_front_page() ): ?> home<?php endif; ?>">
	<div class="hero-inner">
		<?php if( is_front_page() ): ?>
			<blockquote>
			<p>“For the first time, I have
					a plan for the future,
					and I couldn’t be more
					relieved and excited.”<br>
			<cite>Christine, New York City</cite></p>
			</blockquote>
			<a class="button large" href="#">Plan your future</a>

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
