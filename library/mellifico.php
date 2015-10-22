<?php

// get the slug of post title
if(!function_exists('the_slug')) :
function the_slug() {
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug;
}
endif;

?>