<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
?>

<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="seal small-6 medium-3 large-2">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header>
<div class="full">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('full'); ?>
			<?php elseif ( !has_post_thumbnail() ): ?>
				<?php lorempixel(); ?>
			<?php endif; ?>
			</div>
				<?php 
		$cover = array(
			'post_type'      => 'attachment',
			'post_parent'    => $post->ID,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => 1,
			'tax_query'	=> array(
		        array(
		            'taxonomy'  => 'classification',
		            'field'     => 'slug',
		            'terms'     => 'covers'
		            )
		            ),
		);
		$cover_info = get_posts($cover);

		if ($cover_info) {
			foreach ($cover_info as $sealcover) {
				$attcover_med  = wp_get_attachment_image_src($sealcover->ID,'medium');	
				echo '<img class="full" src="';
				echo $attcover_med[0];
				echo '" alt="" />';
			}
		}
		?>
	</header>
</article>
</a>
