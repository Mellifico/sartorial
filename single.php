    <?php
    if (in_category('portrait-layout')) {
    	include 'single-portrait.php';
    } elseif (in_category('landscape-layout')) {
    	include 'single-landscape.php';
    } elseif (in_category('mix-layout')) {
    	include 'single-mix.php';
    } elseif (in_category('slider-layout')) {
    	include 'single-slider.php';
    } elseif (in_category('magellan-layout')) {
    	include 'single-magellan.php';
    } elseif (in_category('parallax-layout') || in_category('parallax-layout-en')) {
    	include 'single-parallax.php';
    } else {
    ?>

<?php get_header(); ?>

<div role="main">	

	

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
			 wp_reset_postdata(); 
		}
		?>
<?php if ($attcover_full) { ?>
<div class="wrapper CoverImage FlexEmbed FlexEmbed--16by9" style="background-image:url(<?php echo $attcover_full[0]; ?>);" ></div>
<?php } ?>

		<article <?php post_class('wrapper') ?> id="post-<?php the_ID(); ?>">
		<h1 id="big" class="text-center uppercase"><?php the_title(); ?></h1>
			<header class="row">
			<div class="large-12 columns">
				<?php the_post_thumbnail('medium'); ?>
			<?php the_content(); ?>
			</div>
			</header>


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
<div id="msnry-gallery">
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
	$detail1_full = wp_get_attachment_image_src(get_field('item_detail_1', $attachment->ID), 'full');
	$detail2_full = wp_get_attachment_image_src(get_field('item_detail_2', $attachment->ID), 'full');
	$detail3_full = wp_get_attachment_image_src(get_field('item_detail_3', $attachment->ID), 'full');
	
        echo '<figure id="'.$attslug.'-item-'.$attachment->ID.'" class="ligatures cartel item galerie mosaique small-12 medium-6 large-4">';

        echo '<a title="'.$atttitle.'" href="'.$attimg_full[0].'"><img class="panel" src="'.$attimg_medium[0].'" alt="'.$atttitle.'"/></a>';
        echo '<figcaption class="panel">';

        echo '<ul class="text-center small-block-grid-3 medium-block-grid-3 large-block-grid-3">';
	if ($detail1_th) {echo '<li><a class="th" href="'.$detail1_full[0].'"><img src="'.$detail1_th[0].'" alt="'.$img_title.'" /></a></li>'; }
	if ($detail2_th) {echo '<li><a class="th" href="'.$detail2_full[0].'"><img src="'.$detail2_th[0].'" alt="'.$img_title.'" /></a></li>'; }
	if ($detail3_th) {echo '<li><a class="th" href="'.$detail3_full[0].'"><img src="'.$detail3_th[0].'" alt="'.$img_title.'" /></a></li>'; }
        echo '</ul>';
                echo '<h3 class="text-center">'.$atttitle.'</h3>';
        echo apply_filters('the_title', $attachment->post_content);

        echo '</figcaption></figure>';
    }
     wp_reset_postdata();   
} ?>
</div>


			
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				
			</footer>

		</article>
		
	<?php endwhile;?>

	


	
</div>


<?php get_footer(); ?>
<?php } ?>