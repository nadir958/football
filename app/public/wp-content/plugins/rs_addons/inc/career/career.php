<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package grassywp
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
// Register Career Post Type
function rs_career_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Career', 'brickx'),
		'singular_name'      => esc_html__( 'Career', 'brickx'),
		'add_new'            => esc_html_x( 'Add New Career', 'rsconstruction', 'brickx'),
		'add_new_item'       => esc_html__( 'Add New Career', 'brickx'),
		'edit_item'          => esc_html__( 'Edit Career', 'brickx'),
		'new_item'           => esc_html__( 'New Career', 'brickx'),
		'all_items'          => esc_html__( 'All Career', 'brickx'),
		'view_item'          => esc_html__( 'View Career', 'brickx'),
		'search_items'       => esc_html__( 'Search Career', 'brickx'),
		'not_found'          => esc_html__( 'No Career found', 'brickx'),
		'not_found_in_trash' => esc_html__( 'No Career found in Trash', 'brickx'),
		'parent_item_colon'  => esc_html__( 'Parent Career:', 'brickx'),
		'menu_name'          => esc_html__( 'Career', 'brickx'),
	);
	global $rs_option;
	$career_slug = (!empty($rs_option['career_slug']))? $rs_option['career_slug'] :'career';
	$args = array(
		'labels'             => $labels,
		'public'             => true,	
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'rewrite' => 		 array('slug' => $career_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail','editor','post-formats' ),		
	);
	register_post_type( 'careers', $args );
}
add_action( 'init', 'rs_career_register_post_type' );
function tr_create_career() {
	global $rs_option;
	$career_slug_cat = (!empty($rs_option['career_slug']))? $rs_option['career_slug'].'-category' :'career-category';
	register_taxonomy(
		'career-category',
		'careers',
		array(
			'label' => __( 'Categories','brickx'),
			'rewrite' => array( 'slug' => $career_slug_cat ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'tr_create_career' );

// Meta Box