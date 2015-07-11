<?php get_header(); ?>

<div class="row">
	<div class="small-12 large-12 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>

	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<header class="row">

			<div class="medium-4 large-4 columns">
				<?php the_post_thumbnail('medium'); ?>
				<p><?php the_tags(); ?></p>
			</div>
			<div class="medium-8 large-8 columns">
			<?php the_content(); ?>
			</div>
			</header>
			<?php do_action('foundationPress_post_before_entry_content'); ?>
			<div class="entry-content">
<div id="msnry-gallery">
			<?php 
$args = array(
	'orderby'          => 'rand',
	'post_type'      => 'attachment',
	'post_parent'    => $post->ID,
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => -1,
	'tax_query'	=> array(
        array(
            'taxonomy'  => 'classification',
            'field'     => 'slug',
            'terms'     => array('logotypes', 'covers'), // exclude media posts in the news-cat custom taxonomy
            'operator'  => 'NOT IN')
            ),
);
$attachments = get_posts($args);
if ($attachments) {
	foreach ($attachments as $attachment) {
		$img_src = wp_get_attachment_image_src($attachment->ID,'medium');
		$attimg_full   = wp_get_attachment_image_src($attachment->ID,'full');
		echo '<figure class="item galerie small-6 medium-4 large-3">';
		echo '<a href="'.$attimg_full[0].'">';
		echo '<img src="';
		echo $img_src[0];
		echo '" alt=""/></a>';
		echo '<figcaption class="text-center">';
		echo apply_filters('the_title', $attachment->post_title);
		echo '</figcaption>';
		echo '</figure>';
	}
}
?>
</div>


			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				
			</footer>

		</article>
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>

	</div>
	
</div>
<?php get_footer(); ?>
