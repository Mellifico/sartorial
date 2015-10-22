</section>

<div class="wrapper bg-light">
<footer class="row">
<div class="large-12">
	<?php do_action('foundationPress_before_footer'); ?>
	<?php dynamic_sidebar("footer-widgets"); ?>
	<?php do_action('foundationPress_after_footer'); ?>
	</div>
</footer>
</div>


	<?php do_action('foundationPress_layout_end'); ?>
	

<!-- </div> -->
<?php wp_footer(); ?>
<?php do_action('foundationPress_before_closing_body'); ?>
</body>
</html>
