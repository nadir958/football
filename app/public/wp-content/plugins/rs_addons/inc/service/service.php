<?php
/**
 * service custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package rs
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
// Register service Post Type
function rs_service_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Services', 'bstart'),
		'singular_name'      => esc_html__( 'Service', 'bstart'),
		'add_new'            => esc_html_x( 'Add New Service', 'rs-option', 'bstart'),
		'add_new_item'       => esc_html__( 'Add New Service', 'bstart'),
		'edit_item'          => esc_html__( 'Edit Service', 'bstart'),
		'new_item'           => esc_html__( 'New Service', 'bstart'),
		'all_items'          => esc_html__( 'All Services', 'bstart'),
		'view_item'          => esc_html__( 'View Service', 'bstart'),
		'search_items'       => esc_html__( 'Search Services', 'bstart'),
		'not_found'          => esc_html__( 'No Services found', 'bstart'),
		'not_found_in_trash' => esc_html__( 'No Services found in Trash', 'bstart'),
		'parent_item_colon'  => esc_html__( 'Parent Service:', 'bstart'),
		'menu_name'          => esc_html__( 'Service', 'bstart'),
	);
	global $kulluu_option;
	$service_slug = (!empty($kulluu_option['service_slug']))? $kulluu_option['service_slug'] :'service';
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'rewrite' => 		 array('slug' => $service_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail','editor' )
	);
	register_post_type( 'services', $args );
}
add_action( 'init', 'rs_service_register_post_type' );

function tr_create_service() {
	global $kulluu_option;
	$service_slug_cat = (!empty($kulluu_option['service_slug']))? $kulluu_option['service_slug'].'-category' :'service-category';
	register_taxonomy(
		'service-category',
		'services',
		array(
			'label' => __( 'Categories','bstart'),
			'rewrite' => array( 'slug' => $service_slug_cat ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'tr_create_service' );


function rs_portfolio_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('service-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'services' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'rs_portfolio_add_taxonomy_filters' );