<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
?>
<a href="<?php the_permalink(); ?>">
<article id="post-<?php the_ID(); ?>" <?php post_class('small-6 medium-3 large-3 columns'); ?>>
<header>
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail(); ?>
			<?php elseif ( !has_post_thumbnail() ): ?>
				<?php lorempixel(); ?>
			<?php endif; ?>
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
				$attcover_full   = wp_get_attachment_image_src($sealcover->ID,'medium');	
				echo '<img src="';
				echo $attcover_full[0];
				echo '" alt="" />';
			}
		}
		?>
	</header>
</article>
</a>
