<!doctype html>
<html class="no-js no-skrollr" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php if ( is_category() ) {
			echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(''); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title('');
		} else {
			echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
		} ?></title>
		
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ; ?>/css/foundation.css" />

		<link rel="icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-precomposed.png">
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action('foundationPress_after_body'); ?>
		<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
<!-- <div class="animsition"> -->

	
	<?php do_action('foundationPress_layout_start'); ?>


<div class="fixed">
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
    <li class="name">
      <h1><a href="<?php echo home_url(); ?>"><i class="fi-book-bookmark"></i>&nbsp;<?php echo __('The PG Guide', 'FoundationPress'); ?></a></h1>
    </li>
    <li class="divider"></li>
    </ul>
<section class="top-bar-section">
<ul class="left">

<li><?php apply_filters( 'wpml_element_link', 540 ); ?></li>
<li class="divider"></li>
</ul>
<ul class="right">
<li><select  name="seals-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
<option value=""><?php echo esc_attr( __( 'Seals' ) ); ?></option> 
  <?php wp_get_archives( 'type=alpha&format=option' ); ?>
</select></li>
<li class="divider"></li>
<li>
	<form id="subject-select" class="subject-select" action="<?php echo esc_url( home_url( '/' ) ); ?>/subject/" method="get">

		<?php
		$args = array(
			'taxonomy' => 'subject',
			'show_option_none' => __( 'Subjects', 'FoundationPress' ),
			'show_count'       => 1,
			'orderby'          => 'name',
			'echo'             => 0,
			'hide_empty' => false,
		);
		?>

		<?php $select  = wp_dropdown_categories( $args ); ?>
		<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
		<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>

		<?php echo $select; ?>

		<noscript>
			<input type="submit" value="View" />
		</noscript>

	</form>
</li>
<li><form action="<?php bloginfo('url'); ?>" method="get">
<?php $pages_args =  array(
			'show_option_none' => __( 'Pages', 'FoundationPress' ),
			'orderby'          => 'name',
		);?>
   <?php wp_dropdown_pages($pages_args); ?>
</form></li>
<li><?php languages_list(); ?></li>
</ul>
</section>
</nav>
</div>

<section class="container" role="document">
	<?php do_action('foundationPress_after_header'); ?>