<?php
/**
 * This is the post excerpt template.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ascension
 */
?>
<div class="entry-summary">
	<?php the_excerpt(); ?>
	<p><a class="button" href="<?php the_permalink(); ?>">Continue Reading &#10142;</a></p>
</div><!-- .entry-summary -->
