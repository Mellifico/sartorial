<?php get_header(); ?>

<?php do_action('foundationPress_before_content'); ?>


	<?php $random_item = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'published',
    'numberposts' => 1,
    'orderby' => 'rand',
    	'tax_query'	=> array(
    	        array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'covers',
            'operator'  => 'IN')
            ),
);  
$bg_item = get_posts($random_item);

?>
<?php 
if ($bg_item) {
    foreach ($bg_item as $bg) {

    $bg_full = wp_get_attachment_image_src($bg->ID,'full');

			}
		}

	?>
<div class="wrapper brand CoverImage bg-fixed alphalayer" style="background-image:url(<?php echo $bg_full[0]; ?>);">
<?php wp_reset_postdata(); ?>
<?php
$count_posts = wp_count_posts();
$published_posts = $count_posts->publish;
?>
<h2 class="smallcaps text-center"><small>parisian gentleman</small></h2>
<p class="text-center"><em>présente&nbsp;:</em></p>
<h1 id="big" class="text-center">Le guide</h1>
<h3 class="text-center">des <?php echo $published_posts; ?> maisons de qualité</h3>
</div>

<div class="wrapper seals">
	
<div role="main">

<div id="seals-wall">

	<?php if ( have_posts() ) : ?>
 
		<?php do_action('foundationPress_before_content'); ?>
		<?php query_posts('orderby=rand'); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

		<?php do_action('foundationPress_before_pagination'); ?>

	<?php endif;?>

</div>

	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>


</div>
</div>
    <?php $random_detail = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'published',
    'numberposts' => 1,
    'orderby' => 'rand',
        'tax_query' => array(
                array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'details',
            'operator'  => 'IN')
            ),
);  
$bg_detail = get_posts($random_detail);

?>
<?php 
if ($bg_detail) {
    foreach ($bg_detail as $bg_d) {

    $bg_d_full = wp_get_attachment_image_src($bg_d->ID,'full');

            }
        }

    ?>
<div class="wrapper brand CoverImage bg-fixed FlexEmbed FlexEmbed--5by1" style="background-image:url(<?php echo $bg_d_full[0]; ?>);">
</div>
<?php wp_reset_postdata(); ?>
<div class="wrapper">
	<?php $all_items = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'published',
    'numberposts' => -1,
    	'tax_query'	=> array(
    	        array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => array('details', 'items', 'covers'),
            'operator'  => 'IN')
            ),
);  
$all_items_loop = get_posts($all_items);
$count_items = count($all_items_loop);

?>
<h2 class="text-center"><?php echo $count_items; ?> images</h2>
<?php wp_reset_postdata(); ?>


	<?php $args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'numberposts' => 42,
    'orderby' => 'rand',
    	'tax_query'	=> array(
    	        array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'details',
            'operator'  => 'IN')
            ),
);  

$attachments = get_posts($args);
$attachments_count = count($attachments);
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
	?>

	<?php
        echo '<a class="item small-4 medium-2 large-2" href="'.$parent_permalink.'">
        <img id="item-'.$attachment->ID.'"
          src="'.$attimg_medium[0].'"
           alt="'.$parent_title.'"
           title="'.$parent_title.'"/></a>';
        ?>
    <?php } ?>  
<?php } ?>
<?php wp_reset_postdata(); ?>
</div>

</div>
<?php do_action('foundationPress_after_content'); ?>


<?php get_footer(); ?>
