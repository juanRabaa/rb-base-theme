<?php
// =============================================================================
// SUPPORTS
// =============================================================================
add_theme_support( 'post-thumbnails' );

//svg support
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// =============================================================================
// STYLES
// =============================================================================
function load_styles() {
	wp_enqueue_style( "bootstrap-css", get_template_directory_uri()."/css/libs/bootstrap/bootstrap.min.css", array() );
	wp_enqueue_style( "font-awesome-css", "https://use.fontawesome.com/releases/v5.6.3/css/all.css", array() );
	wp_enqueue_style( "animate", get_template_directory_uri()."/css/libs/animate.css", array() );
	wp_enqueue_style( "gen-google-fonts", "https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap", array() );
	wp_enqueue_style( "rb-slider-css", get_template_directory_uri()."/css/libs/rb-slider.css", array() );
}
add_action ("wp_enqueue_scripts", "load_styles");

// =============================================================================
// SCRIPTS
// =============================================================================
function load_scripts() {
	wp_enqueue_script( "jquery-3", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", true );
	wp_enqueue_script( "smooth-scroll", get_template_directory_uri()."/js/src/smooth-scroll.js", true );
	wp_enqueue_script( "wow-js", get_template_directory_uri()."/js/libs/wow.min.js", true );
	wp_enqueue_script( "bodymovin", get_template_directory_uri()."/js/libs/bodymovin/build/player/lottie_svg.min.js", true );
	wp_enqueue_script( "gen-menu", get_template_directory_uri()."/js/src/gen-menu.js", true );
	wp_localize_script( "gen-menu", "wp_data", array(
		'theme_uri'	=> get_template_directory_uri(),
	));
	wp_enqueue_script( "rb-slider-js", get_template_directory_uri()."/js/src/rb-slider.js", true );
}
add_action ("wp_enqueue_scripts", "load_scripts");

// =============================================================================
// INC
// =============================================================================
require_once get_template_directory() . '/inc/gen-functions.php';

// =============================================================================
// CUSTOMIZER
// =============================================================================
if(!defined('RB_CUSTOMIZER_FRONT_EDITION_ACTIVE'))
    define('RB_CUSTOMIZER_FRONT_EDITION_ACTIVE',  true );
RB_Wordpress_Framework::load_module('customizer');

if(rb_customizer_front_edition_is_active()){
	require get_template_directory() . '/customizer.php';
}
function gen_customizer_register( $wp_customize ) {
	require get_template_directory() . '/customizer.php';
}
add_action( 'customize_register', 'gen_customizer_register', 1000000 );
