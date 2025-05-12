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
function khelo_rsclient_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Sponsors', 'bstart' ),
		'singular_name'      => esc_html__( 'Sponsor', 'bstart' ),
		'add_new'            => esc_html_x( 'Add New Sponsor', 'bstart', 'bstart' ),
		'add_new_item'       => esc_html__( 'Add New Sponsor', 'bstart' ),
		'edit_item'          => esc_html__( 'Edit Sponsor', 'bstart' ),
		'new_item'           => esc_html__( 'New Sponsor', 'bstart' ),
		'all_items'          => esc_html__( 'All Sponsors', 'bstart' ),
		'view_item'          => esc_html__( 'View Sponsors', 'bstart' ),
		'search_items'       => esc_html__( 'Search Sponsors', 'bstart' ),
		'not_found'          => esc_html__( 'No Sponsors found', 'bstart' ),
		'not_found_in_trash' => esc_html__( 'No Sponsors found in Trash', 'bstart' ),
		'parent_item_colon'  => esc_html__( 'Parent Sponsor:', 'bstart' ),
		'menu_name'          => esc_html__( 'Sponsors', 'bstart' ),
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
	register_post_type( 'rsclient', $args );
}
add_action( 'init', 'khelo_rsclient_register_post_type' );

function tr_create_rsclient() {
	register_taxonomy(
		'rsclient-category',
		'rsclient',
		array(
			'label' => __( 'Sponsor Categories','rsaddon' ),
			'rewrite' => array( 'slug' => 'rsclient-category' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'tr_create_rsclient' );