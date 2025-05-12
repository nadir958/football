<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package Sports
 * @author RS Theme
 * @link http://www.rstheme.com
 */
// Register Team Post Type
function rs_fixture_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'All Fixture & Results', 'rsaddon'),
		'singular_name'      => esc_html__( 'Fixture & Results', 'rsaddon'),
		'add_new'            => esc_html_x( 'Add Fixture & Results', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Fixture & Results', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Fixture & Results', 'rsaddon'),
		'new_item'           => esc_html__( 'New Fixture & Results', 'rsaddon'),
		'all_items'          => esc_html__( 'All Fixture & Results', 'rsaddon'),
		'view_item'          => esc_html__( 'View Fixture & Results', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Fixture & Results', 'rsaddon'),
		'not_found'          => esc_html__( 'No Fixture & Results found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Fixture & Results found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Fixture & Results:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Fixture & Results', 'rsaddon'),
	);
	global $khelo_option;
	$fixture_slug = (!empty($khelo_option['fixture_slug']))? $khelo_option['fixture_slug'] :'fixture-results';
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'rewrite' => 		 array('slug' => $fixture_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'fixture-results', $args );
}
add_action( 'init', 'rs_fixture_register_post_type' );

function tr_create_fixture() {
	
	$args = array(
		'label' => __( 'League Categories','rsaddon'),
		'rewrite' => array( 'slug' => 'league-category' ),
		'hierarchical' => true,
		'show_admin_column' => true,		
	);

	register_taxonomy('league-category',array( 'fixture-results','point-table' ),$args);
}
add_action( 'init', 'tr_create_fixture' );



function rs_fixture_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('league-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'fixture-results' ){
 			foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);

			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);		
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug.'>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'rs_fixture_add_taxonomy_filters' );