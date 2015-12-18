</section>
<hr />
<div class="wrapper row vert-padded main-footer">
<footer>
<div class="medium-3 large-3 columns">
<ul class="small-typo circle">
<?php wp_list_pages('title_li='); ?>
</ul>
<ul class="small-typo circle">
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
    <span class="label"><i class="fi-calendar"></i>&nbsp;<?php echo $item->get_date('d/m/Y'); ?></span>
<h4 class="small-lh"><small><a  href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo esc_html( $item->get_title() ); ?>'><i class="fi-link"></i>&nbsp;<?php echo esc_html( $item->get_title() ); ?></a></small></h4>
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
