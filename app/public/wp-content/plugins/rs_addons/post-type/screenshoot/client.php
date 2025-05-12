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
// Register Gallery Post Type
function grassy_client_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Gallery', 'appone' ),
		'singular_name'      => esc_html__( 'Gallery', 'appone' ),
		'add_new'            => esc_html_x( 'Add New Gallery', 'appone', 'appone' ),
		'add_new_item'       => esc_html__( 'Add New Gallery', 'appone' ),
		'edit_item'          => esc_html__( 'Edit Gallery', 'appone' ),
		'new_item'           => esc_html__( 'New Gallery', 'appone' ),
		'all_items'          => esc_html__( 'All Gallery', 'appone' ),
		'view_item'          => esc_html__( 'View Gallery', 'appone' ),
		'search_items'       => esc_html__( 'Search Gallery', 'appone' ),
		'not_found'          => esc_html__( 'No Gallery found', 'appone' ),
		'not_found_in_trash' => esc_html__( 'No Gallery found in Trash', 'appone' ),
		'parent_item_colon'  => esc_html__( 'Parent Gallery:', 'appone' ),
		'menu_name'          => esc_html__( 'Gallery', 'appone' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail' ),		
	);
	register_post_type( 'gallery', $args );
}
add_action( 'init', 'grassy_client_register_post_type' );

function tr_create_gallery() {
	register_taxonomy(
		'gallery-category',
		'gallery',
		array(
			'label' => __( 'Categories','rsconstruction' ),
			'rewrite' => array( 'slug' => 'gallery-category' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'tr_create_gallery' );