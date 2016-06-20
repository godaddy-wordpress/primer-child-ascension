<div class="entry-meta">

	<span class="posted-date"><?php the_date(); ?></span>

	<span class="posted-author"><?php the_author_posts_link(); ?></span>

	<span class="comments-number">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<a href="<?php the_permalink(); ?>#comments">
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'ascension' ), __( '1 Comment', 'ascension' ), __( '% Comments', 'ascension' ) ); ?></span>
			</a>
		<?php endif; ?>
	</span>

</div><!-- .entry-meta -->
