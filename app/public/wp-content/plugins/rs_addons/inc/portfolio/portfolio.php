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
// Register Portfolio Post Type
function rs_portfolio_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Portfolios', 'brickx'),
		'singular_name'      => esc_html__( 'Portfolio', 'brickx'),
		'add_new'            => esc_html_x( 'Add New Portfolio', 'rsconstruction', 'brickx'),
		'add_new_item'       => esc_html__( 'Add New Portfolio', 'brickx'),
		'edit_item'          => esc_html__( 'Edit Portfolio', 'brickx'),
		'new_item'           => esc_html__( 'New Portfolio', 'brickx'),
		'all_items'          => esc_html__( 'All Portfolios', 'brickx'),
		'view_item'          => esc_html__( 'View Portfolio', 'brickx'),
		'search_items'       => esc_html__( 'Search Portfolios', 'brickx'),
		'not_found'          => esc_html__( 'No Portfolios found', 'brickx'),
		'not_found_in_trash' => esc_html__( 'No Portfolios found in Trash', 'brickx'),
		'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'brickx'),
		'menu_name'          => esc_html__( 'Portfolio', 'brickx'),
	);
	global $kulluu_option;
	$portfolio_slug = (!empty($kulluu_option['portfolio_slug']))? $kulluu_option['portfolio_slug'] :'portfolio';
	$args = array(
		'labels'             => $labels,
		'public'             => true,	
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'rewrite' => 		 array('slug' => $portfolio_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail','editor', 'excerpt' ),		
	);
	register_post_type( 'portfolios', $args );
}
add_action( 'init', 'rs_portfolio_register_post_type' );
function tr_create_portfolio() {
	global $kulluu_option;
	$portfolio_slug_cat = (!empty($kulluu_option['portfolio_slug']))? $kulluu_option['portfolio_slug'].'-category' :'portfolio-category';
	register_taxonomy(
		'portfolio-category',
		'portfolios',
		array(
			'label' => __( 'Categories','brickx'),
			'rewrite' => array( 'slug' => $portfolio_slug_cat ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
}
add_action( 'init', 'tr_create_portfolio' );

// Meta Box

/*--------------------------------------------------------------
*			Portfolio info
*-------------------------------------------------------------*/
function rs_portfolio_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Portfolio Info', 'brickx'), 'rs_portfolio_member_info_meta_callback', 'portfolios', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_portfolio_meta_box');

// member info callback
function rs_portfolio_member_info_meta_callback( $portfolio_info ) {
	wp_nonce_field( 'portfolio_metabox', 'portfolio_metabox' ); ?>
	<div style="margin: 10px 0;">
		<label for="client" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Client: ', 'brickx') ?>
		</label>
		<?php $client = get_post_meta( $portfolio_info->ID, 'client', true ); ?>
		<input type="text" name="client" id="client" class="client" value="<?php echo esc_html($client); ?>" style="width:300px; "/>
	</div>

	<div style="margin: 10px 0;">
		<label for="location" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Location: ', 'brickx') ?>
		</label>
		<?php $location = get_post_meta( $portfolio_info->ID, 'location', true ); ?>
		<input type="text" name="location" id="location" class="location" value="<?php echo esc_html($location); ?>" style="width:300px; "/>
	</div>

	<div style="margin: 10px 0;">
		<label for="surface_area" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Surface Area: ', 'brickx') ?>
		</label>
		<?php $surface_area = get_post_meta( $portfolio_info->ID, 'surface_area', true ); ?>
		<input type="text" name="surface_area" id="surface_area" class="surface_area" value="<?php echo esc_html($surface_area); ?>" style="width:300px; "/>
	</div>

	<div style="margin: 10px 0;">
		<label for="tagline" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Read More Text', 'brickx') ?>
		</label>
		<?php $tagline = get_post_meta( $portfolio_info->ID, 'tagline', true ); ?>
		<input type="text" name="tagline" id="tagline" class="tagline" value="<?php echo esc_html($tagline); ?>" style="width:300px;"/>
	</div>

	<div style="margin: 10px 0;">
		<label for="created" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Architect: ', 'brickx') ?>
		</label>
		<?php $created = get_post_meta( $portfolio_info->ID, 'created', true ); ?>
		<input type="text" name="created" id="created" class="created" value="<?php echo esc_html($created); ?>" style="width:300px;" />
	</div>

	<div style="margin: 10px 0;">
		<label for="date" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Year Completed: ', 'brickx') ?>
		</label>
		<?php $date = get_post_meta( $portfolio_info->ID, 'date', true ); ?>
		<input type="text" name="date" id="date" class="date" value="<?php echo esc_html($date); ?>" style="width:300px;" />
	</div>

	<div style="margin: 10px 0;">
		<label for="project_value" style="width:150px; display:inline-block;">
			<?php esc_html_e( 'Project Value: ', 'brickx') ?>
		</label>
		<?php $project_value = get_post_meta( $portfolio_info->ID, 'project_value', true ); ?>
		<input type="text" name="project_value" id="project_value" class="project_value" value="<?php echo esc_html($project_value); ?>" style="width:300px;" />
	</div>
<?php }
/*--------------------------------------------------------------
 *			Save meta
*-------------------------------------------------------------*/
function save_rs_portfolio_social_meta( $post_id ) {
	if ( ! isset( $_POST['portfolio_metabox'] ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ( 'portfolios' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	$mymeta = array( 'tagline','created','date','location','client','surface_area','project_value' );
	foreach ( $mymeta as $keys ) {

		if ( is_array( $_POST[ $keys ] ) ) {
			$data = array();

			foreach ( $_POST[ $keys ] as $key => $value ) {
				$data[] = $value;
			}
		} else {
			$data = sanitize_text_field( $_POST[ $keys ] );
		}		
		update_post_meta( $post_id, $keys, $data );
	}
}
add_action( 'save_post', 'save_rs_portfolio_social_meta' );

function rs_service_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('portfolio-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'portfolios' ){
 
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
add_action( 'restrict_manage_posts', 'rs_service_add_taxonomy_filters' );