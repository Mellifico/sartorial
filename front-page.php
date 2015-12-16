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
            'terms'     => 'details',
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
<div class="wrapper row pattern-pdp" data-equalizer>
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

<div class="medium-6 large-6 columns bg-white" data-equalizer-watch>

<div class="padded inline-block bg-white text-center">
<h3 class="smallcaps text-center"><small>parisian gentleman;</small></h3>
<h1 class="text-center"><?php echo __('The Guide', 'FoundationPress'); ?></h1>
    <h2 class="text-center"><small><span><?php echo $published_posts; ?></span> <?php echo __('Seals of Quality', 'FoundationPress'); ?>, <br /><?php echo __('illustrated with', 'FoundationPress'); ?> <?php echo $count_items; ?> <?php echo __('pictures', 'FoundationPress'); ?></small></h2>
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
    'numberposts' => 32,
    'orderby' => 'rand',
        'tax_query' => array(
                array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'items',
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
    $itemlink = $parent_permalink.'#'.$attslug.'-item-'.$attachment->ID;
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
<div class="medium-6 large-6 columns CoverImage" style="background-image:url(<?php echo $bg_full[0]; ?>);" data-equalizer-watch>
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



</div>
</div>
 <hr />
<div class="wrapper row">
 
 <div class="medium-6 large-6 columns">
    <?php

    $recentPosts = new WP_Query();

    $args = array(

    'posts_per_page'      => 1,
    'post__in'            => get_option( 'sticky_posts' ),
    'ignore_sticky_posts' => 1,

    );

    $recentPosts->query($args);

    while ($recentPosts->have_posts()) : $recentPosts->the_post();

    ?>
<?php
     $defaults = array(
            'post_type'      => 'attachment',
            'post_parent'    => $post->ID,
            'post_mime_type' => 'image',
            'post_status'    => null,
            'numberposts'    => 1,
            'tax_query' => array(
                array(
                    'taxonomy'  => 'classification',
                    'field'     => 'slug',
                    'terms'     => 'covers'
                    )
                    ),
        );
        $cover_info = get_posts($defaults);

        if ($cover_info) {
            foreach ($cover_info as $sealcover) {
                $attcover_large  = wp_get_attachment_image_src($sealcover->ID,'large');  
            }
        }
?>
    <div class="padded text-center CoverImage" style="background-image:url(<?php echo $attcover_large[0]; ?>);">

   <h5 class="panel">Entrée récente&nbsp;:<br /><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
  
    
  </div>
    <?php endwhile; ?>
    </div>
    <div class="medium-6 large-6 columns"></div> 
    </div>
</div>


<?php get_footer(); ?>
