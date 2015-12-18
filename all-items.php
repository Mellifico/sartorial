<?php
/**
 * Template name: All Items
 */
?>

<?php get_header(); ?>

<?php  global $wp_rewrite;
             $current = $wp_query->query_vars['paged'] > 1 ?
             $wp_query->query_vars['paged'] : 1; ?>

<?php $args = array(
  //'lang' => ICL_LANGUAGE_CODE,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'publish',
    'numberposts' => 20,
    'offset' => 20 * ($current - 1),
    'suppress_filters' => false,
    'orderby' => 'rand',
    'tax_query' => array(
              array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => 'items',
            'operator'  => 'IN')
            ),

);  
$pagination = array(
  'base' => @add_query_arg( 'page', '%#%' ),
  'format' => '',
  'total' => wp_count_posts('attachment')->inherit / 20,
  'current' => $current,
  'show_all' => false,
  'end_size' => 0,
  'mid_size' => 0,
  'type' => 'list',
  'before_page_number' => '&#123;',
  'after_page_number' => '&#125;',
  'prev_text'    => '« Précédentes',
  'next_text'    => 'Suivantes »'
  );
if( $wp_rewrite->using_permalinks() )
  $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

if( !empty($wp_query->query_vars['s']) )
  $pagination['add_args'] = array('s'=>get_query_var('s'));

$attachments = get_posts($args);
$post_count = count ($attachments);
?>
<div class="wrapper">
<h1 id="big" class="text-center"><i class="fi-eye"></i>&nbsp;<?php apply_filters( 'wpml_element_link', 540 ); ?></h1>
<div class="text-center"><?php the_content(); ?></div>
<div class="text-center"><?php echo paginate_links($pagination); ?></div>
<div id="msnry-gallery" class="bg-light-min">
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
        echo '<div class="item mosaique small-12 medium-4 large-3">';
        echo '<figure id="item-'.$attachment->ID.'" class="ligatures galerie">';
        echo '<figcaption>';
        echo '<a class="uppercase except block text-center" href="'.$parent_permalink.'"><i class="fi-home"></i>&nbsp;&nbsp;'.$parent_title.'</a>';
        echo '<h3 class="text-center"><a class="except block text-center" href="'.$parent_permalink.'#'.$attslug.'-item-'.$attachment->ID.'">'.$atttitle.'</a></h3>';
        echo '<hr />';
        echo apply_filters('the_title', $attachment->post_content);
        echo '<hr /><span class="label">';
        echo  the_terms($attachment->ID, 'subject');
        echo '</span></figcaption>';
        echo '<a class="pop" title="'.$atttitle.'" href="'.$attimg_full[0].'"><img src="'.$attimg_medium[0].'" alt="'.$atttitle.'"/></a>';
        echo '<ul class="details small-block-grid-3 medium-block-grid-3 large-block-grid-3">';
  if ($detail1_th) {echo '<li><a class="pop th" href="'.$detail1_full[0].'"><img src="'.$detail1_th[0].'" alt="'.$img_title.'" /></a></li>'; }
  if ($detail2_th) {echo '<li><a class="pop th" href="'.$detail2_full[0].'"><img src="'.$detail2_th[0].'" alt="'.$img_title.'" /></a></li>'; }
  if ($detail3_th) {echo '<li><a class="pop th" href="'.$detail3_full[0].'"><img src="'.$detail3_th[0].'" alt="'.$img_title.'" /></a></li>'; }
        echo '</ul>';
        echo '</figure></div>';
        ?>
    <?php } ?>  
<?php } ?>
</div>
<div class="text-center"><?php echo paginate_links($pagination); ?></div>

</div>

<?php get_footer(); ?>