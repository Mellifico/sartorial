<?php get_header(); ?>

<div role="main">	

	<?php do_action('foundationPress_before_content'); ?>

	<?php while (have_posts()) : the_post(); ?>
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
		$cover_src_full   = wp_get_attachment_image_src($cover_info->ID,'full');
		if ($cover_info) {
			foreach ($cover_info as $sealcover) {
				$attcover_full   = wp_get_attachment_image_src($sealcover->ID,'full');	
			}
		}
		?>

<div class="wrapper CoverImage FlexEmbed FlexEmbed--16by9" style="background-image:url(<?php echo $attcover_full[0]; ?>);" >
<figure class="centered"><?php the_post_thumbnail('medium'); ?></figure>
</div>


		<article <?php post_class('wrapper') ?> id="post-<?php the_ID(); ?>">
		<h1 id="big" class="text-center uppercase"><?php the_title(); ?></h1>
			<header class="row">
			<div class="large-12 columns">

			<?php the_content(); ?>
			</div>
			</header>
<?php do_action('foundationPress_post_before_entry_content'); ?>
						<?php 
				$args = array(
					'orderby'          => 'rand',
					'post_type'      => 'attachment',
					'post_parent'    => $post->ID,
					'post_mime_type' => 'image',
					'post_status'    => null,
					'numberposts'    => -1,
					'tax_query'	=> array(
				        array(
				            'taxonomy'  => 'classification',
				            'field'     => 'slug',
				            'terms'     => 'items',
				            'operator'  => 'IN')
				            ),
				);
				$attachments = get_posts($args);
				?>
				<div class="row">
				<div class="large-12 columns">

				<?php
				if ($attachments) {
					foreach ($attachments as $attachment) {
						$item_th = wp_get_attachment_image_src($attachment->ID,'large');
						$item_full   = wp_get_attachment_image_src($attachment->ID,'full');
						$detail1_th = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'thumbnail');
						$detail2_th = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'thumbnail');
						$detail3_th = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'thumbnail');
						$detail1_full = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'full');
						$detail2_full = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'full');
						$detail3_full = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'full');
						$img_title = apply_filters('the_title', $attachment->post_title);
						$attslug = sanitize_title($img_title);
						$postparent_title = apply_filters('the_title', $attachment->post_parent -> post_title);

						echo '<figure id="'.$attslug.'-item-'.$attachment->ID.'"';
						echo '<a href="'.$item_full[0].'">';
						echo '<img src="';
						echo $item_th[0];
						echo '" alt="'.$img_title.'"/></a>';
						
						if ($detail1_th) {echo '<a class="th" href="'.$detail1_full[0].'"><img src="'.$detail1_th[0].'" alt="'.$img_title.'" /></a>'; }
						if ($detail2_th) {echo '<a class="th" href="'.$detail2_full[0].'"><img src="'.$detail2_th[0].'" alt="'.$img_title.'" /></a>'; }
						if ($detail3_th) {echo '<a class="th" href="'.$detail3_full[0].'"><img src="'.$detail3_th[0].'" alt="'.$img_title.'" /></a>'; }
						
						echo '<figcaption>';
						echo '<h2>'.apply_filters('the_title', $attachment->post_title).'</h2>';
						echo apply_filters('the_title', $attachment->post_content);
						echo '</figcaption>';
						echo '</figure>';
					}
				}
				?>
				</div>
				</div>

			
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				
			</footer>

		</article>
		
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>


	
</div>


<?php get_footer(); ?>