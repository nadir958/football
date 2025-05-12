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
function rs_point_table_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'All Point Table', 'rsaddon'),
		'singular_name'      => esc_html__( 'Point Table', 'rsaddon'),
		'add_new'            => esc_html_x( 'Add Point Table', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Point Table', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Point Table', 'rsaddon'),
		'new_item'           => esc_html__( 'New Point Table', 'rsaddon'),
		'all_items'          => esc_html__( 'All Point Table', 'rsaddon'),
		'view_item'          => esc_html__( 'View Point Table', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Point Table', 'rsaddon'),
		'not_found'          => esc_html__( 'No Point Tables found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Point Tables found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Point Table:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Point Table', 'rsaddon'),
	);
	global $khelo_option;
	$point_slug = (!empty($khelo_option['point_slug']))? $khelo_option['point_slug'] :'point-table';
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
		'rewrite' => 		 array('slug' => $point_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'point-table', $args );
}
add_action( 'init', 'rs_point_table_register_post_type' );


function rs_point_table_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('league-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'point-table' ){
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
add_action( 'restrict_manage_posts', 'rs_point_table_add_taxonomy_filters' );