<?php get_header(); ?>


	<?php $random_item = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'publish',
    'numberposts' => 6,
    'orderby' => 'rand',
    	'tax_query'	=> array(
    	        array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'items',
            'operator'  => 'IN')
            ),
);  
$bg_item = get_posts($random_item);
?>

<div class="wrapper row">
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

<div class="top-centered bg-white">

<div class="padded text-center">
<h1 class="text-center"><i class="fi-book-bookmark"></i>&nbsp;<?php echo __('The Guide', 'FoundationPress'); ?></h1>
<h2 class="text-center small-lh"><small><span><em><?php echo $published_posts; ?></em></span> <em><?php echo __('Seals of Quality', 'FoundationPress'); ?> <br /><?php echo __('illustrated with', 'FoundationPress'); ?> <?php echo $count_items; ?> <?php echo __('pictures', 'FoundationPress'); ?></em></small></h2>
<h4 class="smallcaps text-center"><small><sub>Une sélection de</sub><br /><a href="http://parisiangentleman.fr/">parisian gentleman;</a>
<br />&copy; <?php
$fromyear = 2009;
$thisyear = (int)date('Y');
echo $fromyear . (($fromyear != $thisyear) ? '-' . $thisyear : ''); ?>
</small></h4>
</div>
  


</div>

<div class="main-slider">
<?php 
if ($bg_item) {
    foreach ($bg_item as $bg) {
    $title = get_the_title($bg->post_parent);
    $atttitle = apply_filters('the_title',$bg->post_title);
    $bg_full = wp_get_attachment_image_src($bg->ID,'full');
echo '<div class="CoverImage full-h" style="background-image:url('.$bg_full[0].');">';
echo '<div class="bg-white inline-block bottom-right padded text-center"><em>'.$atttitle.'</em><br /><strong class="uppercase">'.$title.'</strong></div>';
echo '</div>';
            }
        }

    ?>
    </div>


</div>

<hr />

<div class="wrapper row">
     <?php

    $recentPosts = new WP_Query();

    $args_sticky = array(

    'posts_per_page'      => 1,
    'post__in'            => get_option( 'sticky_posts' ),
    'ignore_sticky_posts' => 1,

    );

    $recentPosts->query($args_sticky);

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
    <div class="medium-12 large-12 columns CoverImage full-h" style="background-image:url(<?php echo $attcover_large[0]; ?>);">
    
        <div class="padded text-center centered">

   <h3 class="panel">Entrée récente&nbsp;:
   <br /><?php the_post_thumbnail('full'); ?>
   <br /><a class="button large" href="<?php the_permalink(); ?>" title="Voir <?php the_title_attribute(); ?>">Voir <?php the_title(); ?></a>
   </h3>
    
  </div>    

    </div> 
    
 


    <?php endwhile; ?>


    </div>


<div class="wrapper seals">
	
<div role="main">

<div id="seals-wall">

	<?php if ( have_posts() ) : ?>
 
		<?php do_action('foundationPress_before_content'); ?>
        <?php $args_seals = array (
            'orderby' => 'rand',
            'post__not_in' => get_option('sticky_posts')
        );?>
		<?php query_posts($args_seals); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>


	<?php endif;?>

</div>



</div>
</div>


<?php get_footer(); ?>
