</section>
<hr />
<div class="wrapper row vert-padded main-footer">
<footer>
<div class="large-6 columns">
<ul>
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
<div class="large-6 columns">
<h3><small><em>Récemment sur Parisian Gentleman&nbsp;:</small></em></h3>
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
    <span><?php echo $item->get_date('d/m/Y'); ?></span>
<h4><small><a  href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo esc_html( $item->get_title() ); ?>'> <?php echo esc_html( $item->get_title() ); ?></a></small></h4>
	<span><?php echo shorten($item-> get_description(),'100');?></span><br /><hr />
    <?php endforeach; ?>

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
