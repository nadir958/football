<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package rs
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
// Register Client Post Type
function grassy_rsclient_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Client', 'bstart' ),
		'singular_name'      => esc_html__( 'Client', 'bstart' ),
		'add_new'            => esc_html_x( 'Add New Client', 'bstart', 'bstart' ),
		'add_new_item'       => esc_html__( 'Add New Client', 'bstart' ),
		'edit_item'          => esc_html__( 'Edit Client', 'bstart' ),
		'new_item'           => esc_html__( 'New Client', 'bstart' ),
		'all_items'          => esc_html__( 'All Client', 'bstart' ),
		'view_item'          => esc_html__( 'View Client', 'bstart' ),
		'search_items'       => esc_html__( 'Search Client', 'bstart' ),
		'not_found'          => esc_html__( 'No Client found', 'bstart' ),
		'not_found_in_trash' => esc_html__( 'No Client found in Trash', 'bstart' ),
		'parent_item_colon'  => esc_html__( 'Parent Client:', 'bstart' ),
		'menu_name'          => esc_html__( 'Client', 'bstart' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail' ),		
	);
	register_post_type( 'rsclient', $args );
}
add_action( 'init', 'grassy_rsclient_register_post_type' );