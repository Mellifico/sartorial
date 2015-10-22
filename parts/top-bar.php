<div class="top-bar-container contain-to-grid sticky show-for-medium-up">
    <nav class="top-bar" data-topbar role="navigation">

        <section class="top-bar-section">

            <ul class="left">

            <li><a href="<?php echo home_url(); ?>"><i class="fi-home"></i>&nbsp;Accueil</a></li>
                <li class="has-dropdown">
                <a href="#"><i class="fi-book-bookmark"></i>&nbsp;Maisons</a>
                 <ul class="dropdown">
  <?php wp_get_archives( 'type=alpha&format=html' ); ?>
</ul>
</li>
            <?php if (is_single()) { ?>
                <li><a href="#"><i class="fi-bookmark"></i>&nbsp;<?php the_title(); ?></a></li>
            <?php } ?>
                </ul>
            
            <?php foundationPress_top_bar_l(); ?>
            <?php foundationPress_top_bar_r(); ?>
        </section>
    </nav>
</div>
