<?php get_header(); ?>


	<?php $random_item = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'publish',
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
             wp_reset_postdata();
		}

	?>
<div class="wrapper row CoverImage" style="background-image:url(<?php echo $bg_full[0]; ?>);">
    <?php
$count_posts = baw_count_posts( 'post' );
$published_posts = $count_posts->publish;
?>
  <?php $all_items = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'publish',
    'numberposts' => -1,
        'tax_query' => array(
                array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => array('details', 'items', 'covers', 'logotypes'),
            'operator'  => 'IN')
            ),
);  
$all_items_loop = get_posts($all_items);
$count_items = count($all_items_loop);
?>

<div class="medium-6 large-6 columns bg-white">

<div class="padded inline-block bg-white text-center">
<h3 class="smallcaps text-center"><small>parisian gentleman;</small></h3>
<h1 class="text-center"><?php echo __('The Guide', 'FoundationPress'); ?></h1>
    <h2 class="text-center"><small><span><?php echo $published_posts; ?></span> <?php echo __('Seals of Quality', 'FoundationPress'); ?>, <?php echo __('illustrated with', 'FoundationPress'); ?> <?php echo $count_items; ?> <?php echo __('pictures', 'FoundationPress'); ?></small></h2>
    <hr />
<ul class="inline-list">
    <?php $args = array(
    'type'            => 'alpha',
    'limit'           => '',
    'format'          => 'html', 
    'before'          => '',
    'after'           => '',
    'show_post_count' => false,
    'echo'            => 1,
    'order'           => 'DESC'
);
wp_get_archives( $args ); ?>
</ul>
<hr />
<?php $args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'publish',
    'numberposts' => 74,
    'orderby' => 'rand',
        'tax_query' => array(
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

<div id="msnry-gallery-bottom">
<?php 
if ($attachments) {
    foreach ($attachments as $attachment) {

    $img = wp_get_attachment_thumb_url($attachment->ID);
    $title = get_the_title($attachment->post_parent);
    $attimg_micro = wp_get_attachment_image_src($attachment->ID,'microthumb');
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
    $parent_logo = get_the_post_thumbnail($parent_id, 'microthumb');
    $parent_permalink = get_permalink( $parent_id );
    $itemlink = $parent_permalink.'#'.$attslug.'-item-detail-'.$attachment->ID;
    ?>

    <?php
        echo '<a data-dropdown="img-'.$attachment->ID.'-infos" aria-controls="img-'.$attachment->ID.'-infos" aria-expanded="false" data-options="align:top" class="item small-3 medium-2 large-1">
        <img id="item-'.$attachment->ID.'"
          src="'.$attimg_micro[0].'"
           alt="'.$parent_title.'" class="full" /></a>';
        ?>
        <ul id="<?php echo 'img-'.$attachment->ID.'-infos';?>" class="f-dropdown text-left" data-dropdown-content aria-hidden="true" tabindex="-1">
        <li><a href="<?php echo $parent_permalink; ?>"><?php echo $parent_logo ?>&nbsp;<?php echo $parent_title; ?></a></li>
        <li><a href="<?php echo $itemlink; ?>"><?php echo $atttitle; ?></a></li>    
        </ul>
    <?php } ?>  
   
<?php } ?>
</div>
</div>
  


</div>
<div class="medium-6 large-6 columns">


</div>

</div>

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
    'post_status' => 'publish',
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
             wp_reset_postdata();
        }

    ?>
<div class="wrapper brand CoverImage bg-fixed FlexEmbed FlexEmbed--5by1 alphalayer" style="background-image:url(<?php echo $bg_d_full[0]; ?>);">

</div>


<?php get_footer(); ?>
