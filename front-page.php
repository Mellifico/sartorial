<?php get_header(); ?>
<?php do_action('foundationPress_before_content'); ?>
<div class="wrapper brand text-center">
<h1><?php bloginfo( 'name' ); ?><br /><?php bloginfo( 'description' ); ?></h1>
</div>
<div class="contain-to-grid sticky">
<?php get_template_part('parts/top-bar'); ?>
</div>

<?php do_action('foundationPress_after_content'); ?>
</div>
</div>

<?php get_footer(); ?>
