<?php
/**
* Plugin Name: CL Testimonial
* Plugin URI: https://codecanyon.net/user/rs-theme
* Description: Testimonial Addon plugin For Visual Composer
* Version: 1.1.2
* Author: RS Theme
* Author URI: http://www.rstheme.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You shouldnt be here' );
}

/**
* Function when plugin is activated
*
* @param void
*
*/

function cl_testi_style_add(){ 
    //adding css to plugin
	wp_register_style( 'cl-fontawesome', 	plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css');
	wp_register_style( 'cl-owl-carousel', 	plugin_dir_url( __FILE__ ) . 'css/owl.carousel.min.css');
	wp_register_style( 'cl-style-testimonial', 		plugin_dir_url( __FILE__ ) . 'css/style.css');
	wp_enqueue_style( 'cl-fontawesome' );
	wp_enqueue_style( 'cl-owl-carousel');
	wp_enqueue_style( 'cl-style-testimonial' );
}
add_action( 'wp_enqueue_scripts', 'cl_testi_style_add' );

function cl_testi_script_add(){
	wp_register_script( 'cl-owl-carousel', 	plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array('jquery'), '2.3.4', true); 	
	wp_register_script('custom_script_cl', plugin_dir_url( __FILE__ ) . 'js/mains.js', array('jquery'), '1.1', true);
	wp_enqueue_script( 'cl-owl-carousel' );
	wp_enqueue_script('custom_script_cl');
}
add_action( 'wp_enqueue_scripts', 'cl_testi_script_add' );


$dir = plugin_dir_path( __FILE__ );

// Post types
require_once $dir .'post-type.php';

// Visual composer
add_action( 'after_setup_theme', 'cl_testimonial_vc_modules', 20 );

if ( !function_exists( 'cl_testimonial_vc_modules' ) ) {
	function cl_testimonial_vc_modules(){
				
		$modules = array( 'inc/rsabstruct','testimonial' );
		foreach ( $modules as $module ) {
			require_once 'vc-modules/' . $module. '.php';
		}
	}
}