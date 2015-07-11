<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('small-6 medium-4 large-4 columns'); ?>>
<header>
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail(); ?>
			<?php elseif ( !has_post_thumbnail() ): ?>
				<?php lorempixel(); ?>
			<?php endif; ?>
		<h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>
</article>

