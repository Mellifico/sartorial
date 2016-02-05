</section>
<hr />
<div class="wrapper row vert-padded main-footer bg-light-min">
<footer>
<div class="medium-3 large-3 columns">
    <hr />
<ul class="inline-list">
    <?php $args_seals = array(
    'type'            => 'alpha',
    'limit'           => '',
    'format'          => 'html', 
    'before'          => '',
    'after'           => '',
    'show_post_count' => false,
    'echo'            => 1,
    'order'           => 'DESC'
);
wp_get_archives( $args_seals ); ?>
</ul>
<hr />

<ul class="square">
<?php 
$taxonomy     = 'subject';
$orderby      = 'name'; 
$show_count   = 1;      
$pad_counts   = 0;      
$hierarchical = false;    
$title        = '';
$hide_empty = false;
$current_category = 1;

$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title,
  'hide_empty' => $hide_empty,
  'current_category' => $current_category
);
 wp_list_categories( $args ); 
?>
</ul>
<hr />
<ul class="circle">
<?php wp_list_pages('title_li='); ?>
</ul>
	</div>
<div class="medium-6 large-6 columns">

<h5>Récemment sur Parisian Gentleman</h5>
<hr />
<?php 
$rss = fetch_feed('http://parisiangentleman.fr/feed');


if (!is_wp_error( $rss ) ) : 
	
    $maxitems = $rss->get_item_quantity(3); 
    $rss_items = $rss->get_items(0, $maxitems); 
endif;
?>
	
 <?php
function shorten($string, $length)
{
    $suffix = '&hellip;';

$short_desc = trim(str_replace(array("/r", "/n", "/t"), ' ', strip_tags($string)));
    $desc = trim(substr($short_desc, 0, $length));
    $lastchar = substr($desc, -1, 1);
    	if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';
					$desc .= $suffix;
 		return $desc;
}
?>

    <?php 
    	if ($maxitems == 0) echo '<p>Nope!</p>';
    	else 
    	foreach ( $rss_items as $item ) : ?>
    
<h4 class="small-lh"><small><?php echo $item->get_date('d/m/Y'); ?>&nbsp;<a  href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo esc_html( $item->get_title() ); ?>'>&nbsp;<i class="fi-link"></i>&nbsp;<?php echo esc_html( $item->get_title() ); ?></a></small></h4>
	<span><?php echo shorten($item-> get_description(),'100');?></span><br /><hr />
    <?php endforeach; ?>
<hr />
<h4>éléments de lexique</h4>
<?php $args_lexic = array( 'post_type' => 'lexicon', 'posts_per_page' => 10 ); 
$loop = new WP_Query( $args_lexic );
while ( $loop->have_posts() ) : $loop->the_post();
  echo '<h5 class="uppercase">';
  the_title();
  echo '</h5>';
  echo '<div class="entry-content">';
  the_content();
  echo '</div>';
endwhile; ?>

<?php $args_micro = array(
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

$attachments = get_posts($args_micro);
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
        echo '<a class="item-small small-3 medium-2 large-1" data-dropdown="img-'.$attachment->ID.'-infos" aria-controls="img-'.$attachment->ID.'-infos" aria-expanded="false" data-options="align:top">
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
<div class="medium-3 large-3 columns">
<h5>Parisian Gentleman Social Network</h5>
	            <ul class="no-bullet">
              <li><a href="https://www.facebook.com/pages/Parisian-Gentleman-the-french-voice-of-sartorial-excellence/116830841661701" rel="me"><i class="fi-social-facebook"></i>&nbsp;Facebook</a></li>
              <li><a href="https://twitter.com/Parisian_Gent" rel="me"><i class="fi-social-twitter"></i>&nbsp;Twitter</a></li>
              <li><a href="https://www.youtube.com/channel/UC4JvjWZ80HF-X6rqJULo-EQ" rel="me"><i class="fi-social-youtube"></i>&nbsp;YouTube</a></li>
              <li><a href="http://parisiangentleman.tumblr.com/" rel="me"><i class="fi-social-tumblr"></i>&nbsp;Tumblr</a></li>
              <li><a href="https://instagram.com/parisian_gentleman/" rel="me"><i class="fi-social-instagram"></i>&nbsp;Instagram</a></li>
            </ul>
</div>	
</footer>

</div>
<a class="exit-off-canvas"></a>

	<?php do_action('foundationPress_layout_end'); ?>
	
</div>
</div>
<!-- </div> -->
<?php wp_footer(); ?>

<?php do_action('foundationPress_before_closing_body'); ?>
</body>
</html>
