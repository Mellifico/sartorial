</section>

<div class="wrapper main-footer">
<footer class="row">
<div class="large-6 columns">

	</div>
<div class="large-6 columns">
<h4><small><em>Récemment sur Parisian Gentleman&nbsp;:</small></em></h4>
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
<h5><small><a class="outline" href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo esc_html( $item->get_title() ); ?>'> <?php echo esc_html( $item->get_title() ); ?></a></small></h5>
<span><?php echo $item->get_date('Y/m/d'); ?></span><br />
	<span><?php echo shorten($item-> get_description(),'100');?></span><br />
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
