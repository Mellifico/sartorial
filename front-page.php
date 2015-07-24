<?php get_header(); ?>
<?php do_action('foundationPress_before_content'); ?>
<div class="wrapper brand">
<div class="row">
<div class="large-12 columns">
<h1><small><a class="outline" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?> <?php bloginfo('description'); ?></a></small></h1>
</div>

</div>
</div>
<div class="wrapper">
	
<div class="row">
<div role="main">

	<?php if ( have_posts() ) : ?>
 
		<?php do_action('foundationPress_before_content'); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

		<?php do_action('foundationPress_before_pagination'); ?>

	<?php endif;?>



	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>

</div>
</div>
</div>

<div class="wrapper">
	<?php $args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'numberposts' => 96,
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
?>

<div id="msnry-gallery">
<?php 
if ($attachments) {
    foreach ($attachments as $attachment) {
	$img = wp_get_attachment_thumb_url($attachment->ID);
	$title = get_the_title($attachment->post_parent);
	$attimg_th   = wp_get_attachment_image_src($attachment->ID,'thumbnail');
	$attimg_medium   = wp_get_attachment_image_src($attachment->ID,'medium');
       $attimg_large   = wp_get_attachment_image_src($attachment->ID,'large');
       $attimg_full   = wp_get_attachment_image_src($attachment->ID,'full');
	$atturl   = wp_get_attachment_url($attachment->ID);
	$attlink  = get_attachment_link($attachment->ID);

	$atttitle = apply_filters('the_title',$attachment->post_title);

        echo '<figure class="item galerie small-6 medium-2 large-1">';
        echo '<a title="'.$atttitle.'" href="'.$attimg_full[0].'"><img src="'.$attimg_medium[0].'" alt="'.$atttitle.'"/></a>';
        echo '</figure>';
    }   
} ?>
</div>

</div>
<?php do_action('foundationPress_after_content'); ?>
</div>
</div>

<?php get_footer(); ?>
