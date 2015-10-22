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

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<div class="wrapper row">
<div class="large-6 columns CoverImage FlexEmbed FlexEmbed--1by4" style="background-image:url(<?php echo $attcover_full[0]; ?>);">

</div>
<div class="large-6 columns">
<header class="panel">
<h1 class="uppercase textshadow-basic"><?php the_title(); ?></h1>
<?php the_content(); ?>
</header>
</div>
</div>

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
<?php 
if ($attachments) {
    foreach ($attachments as $attachment) {

    $attimg_full = wp_get_attachment_image_src($attachment->ID,'full');
	$atttitle = apply_filters('the_title',$attachment->post_title);
	$attslug = sanitize_title($atttitle); ?>


	<?php

        echo '<div class="parallax-image-wrapper parallax-image-wrapper-100"
		data-anchor-target="#'.$attslug.'-item-'.$attachment->ID.' + .gap"
		data-bottom-top="transform:translate3d(0px, 200%, 0px)"
		data-top-bottom="transform:translate3d(0px, 0%, 0px)">';

        echo '<div class="parallax-image parallax-image-100"
			style="background-image:url('.$attimg_full[0].')"
			data-anchor-target="#'.$attslug.'-item-'.$attachment->ID.' + .gap"
			data-bottom-top="transform: translate3d(0px, -80%, 0px);"
			data-top-bottom="transform: translate3d(0px, 80%, 0px);"></div>';
		echo '</div>';

		?>

<?php    }  ?> 
<?php } ?>

<div id="skrollr-body">
<?php 
if ($attachments) {
    foreach ($attachments as $attachment) {
    	
	$img = wp_get_attachment_thumb_url($attachment->ID);
	$title = get_the_title($attachment->post_parent);
	$attimg_th = wp_get_attachment_image_src($attachment->ID,'thumbnail');
	$attimg_medium = wp_get_attachment_image_src($attachment->ID,'medium');
    $attimg_large = wp_get_attachment_image_src($attachment->ID,'large');
    $attimg_full = wp_get_attachment_image_src($attachment->ID,'full');
	$atturl = wp_get_attachment_url($attachment->ID);
	$attlink = get_attachment_link($attachment->ID);
	$atttitle = apply_filters('the_title',$attachment->post_title);
	$attslug = sanitize_title($atttitle);
	$parent_id = $attachment->post_parent;
	$parent_title = get_the_title( $parent_id );
	$parent_permalink = get_permalink( $parent_id );
	$detail1_th = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'thumbnail');
	$detail2_th = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'thumbnail');
	$detail3_th = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'thumbnail');
	$detail1_med = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'medium');
	$detail2_med = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'medium');
	$detail3_med = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'medium');
	$detail1_full = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'full');
	$detail2_full = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'full');
	$detail3_full = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'full');
	

        echo '<div class="content content-full" id="'.$attslug.'-item-'.$attachment->ID.'"><div class="row"><div class="bg-light medium-6 medium-centered large-4 large-centered columns"><h2>'.$atttitle.'</h2>';
        echo apply_filters('the_title', $attachment->post_content);
        echo '<ul class="galerie small-block-grid-3 medium-block-grid-3 large-block-grid-3">'; 
	if ($detail1_th) {echo '<li><a class="th" href="'.$detail1_full[0].'"><img src="'.$detail1_th[0].'" alt="'.$img_title.'" /></a></li>'; }
	if ($detail2_th) {echo '<li><a class="th" href="'.$detail2_full[0].'"><img src="'.$detail2_th[0].'" alt="'.$img_title.'" /></a></li>'; }
	if ($detail3_th) {echo '<li><a class="th" href="'.$detail3_full[0].'"><img src="'.$detail3_th[0].'" alt="'.$img_title.'" /></a></li>'; }
        echo '</ul></div></div></div>';
        echo '<div class="gap gap-100" style="background-image:url('.$attimg_full[0].');"></div>';
    }   
} ?>
</div>


			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				
			</footer>

		</article>
		
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>


	
</div>
<?php get_footer(); ?>
