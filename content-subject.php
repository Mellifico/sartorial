<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
?>

<a class="item small-6 medium-3 large-2" id="attachment-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<article>
				<?php 


				$subject_item_med  = wp_get_attachment_image_src($subject_item->ID,'medium');	
				echo '<img class="full" src="';
				echo $subject_item_med[0];
				echo '" alt="" />';


		?>	
</article>
</a>
