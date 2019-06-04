<?php

// =============================================================================
// STYLES
// =============================================================================
function load_styles() {
	wp_enqueue_style( "bootstrap-css", get_template_directory_uri()."/css/libs/bootstrap/bootstrap.min.css", array() );
	wp_enqueue_style( "font-awesome-css", "https://use.fontawesome.com/releases/v5.6.3/css/all.css", array() );
}
add_action ("wp_enqueue_scripts", "load_styles");

// =============================================================================
// SCRIPTS
// =============================================================================
function load_scripts() {
	wp_enqueue_script( "jquery-3", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", true );
	wp_enqueue_script( "smooth-scroll", get_template_directory_uri()."/js/src/smooth-scroll.js", true );
}
add_action ("wp_enqueue_scripts", "load_scripts");

// =============================================================================
// FRAMEWORK
// =============================================================================
require get_template_directory() . '/inc/rb-wordpress-framework/rb-wordpress-framework.php';

// =============================================================================
// CUSTOMIZER
// =============================================================================
define('RB_CUSTOMIZER_FRONT_EDITION_ACTIVE',  true );
RB_Wordpress_Framework::load_module('customizer');

if(rb_customizer_front_edition_is_active()){
	require get_template_directory() . '/customizer.php';
}
function rb_customizer( $wp_customize ) {
	require get_template_directory() . '/customizer.php';
}
add_action( 'customize_register', 'rb_customizer', 1000000 );

