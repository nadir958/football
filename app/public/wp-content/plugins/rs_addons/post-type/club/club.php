<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package rs
 * @author RS Theme
 * @link http://www.rstheme.com
 */
// Register Team Post Type
function rstheme_club_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Clubs', 'rsaddon'),
		'singular_name'      => esc_html__( 'Club', 'rsaddon'),
		'add_new'            => esc_html_x( 'Add New Club', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Club', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Club', 'rsaddon'),
		'new_item'           => esc_html__( 'New Club', 'rsaddon'),
		'all_items'          => esc_html__( 'All Clubs', 'rsaddon'),
		'view_item'          => esc_html__( 'View Club', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Clubs', 'rsaddon'),
		'not_found'          => esc_html__( 'No Clubs found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Clubs found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Club:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Club', 'rsaddon'),
	);
	global $khelo_option;
	$club_slug = (!empty($khelo_option['clubslug']))? $khelo_option['club_slug'] :'club';
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,		
		'rewrite' => 		 array('slug' => $club_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'menu_position' 	 => 20,
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'club', $args );
}
add_action( 'init', 'rstheme_club_register_post_type' );


function club_main_create_category() {
	
	$args = array(
		'label' => __( 'Club Categories','rsaddon'),
		'rewrite' => array( 'slug' => 'club-category' ),
		'hierarchical' => true,
		'show_admin_column' => true,		
	);

	register_taxonomy('club-category',array( 'club' ),$args);
}
add_action( 'init', 'club_main_create_category' );


//create custom post type for shortcode
function club_news_post_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Club News', 'Post Type General Name', 'rsaddon' ),
			'singular_name'       => _x( 'Club News', 'Post Type Singular Name', 'rsaddon' ),
			'menu_name'           => __( 'Club News', 'rsaddon' ),			
			'all_items'           => __( 'Club News', 'rsaddon' ),
			'view_item'           => __( 'View Club News', 'rs-team-settingse' ),
			'add_new_item'        => __( 'Create New Club News', 'rsaddon' ),
			'add_new'             => __( 'Add New Club News', 'rsaddon' ),
			'edit_item'           => __( 'Edit Club News', 'rsaddon' ),
			'update_item'         => __( 'Update Club News', 'rsaddon' ),
			'search_items'        => __( 'Search Club News', 'rsaddon' ),
			'not_found'           => __( 'Not Found', 'rsaddon' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'rsaddon' ),
		);

	// Set other options for Custom Post Type
		$args = array(
			'label'               => __( 'Club News', 'rsaddon' ),
			'description'         => __( 'Club News', 'rsaddon' ),
			'labels'              => $labels,
			'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu' 		  => 'edit.php?post_type=club',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);

		// Registering your Custom Post Type
		register_post_type( 'club_news', $args );

	}

	add_action( 'init', 'club_news_post_type');	


	function club_create_category() {
	
	$args = array(
		'label' => __( 'Club News Categories','rsaddon'),
		'rewrite' => array( 'slug' => 'clubnews-category' ),
		'hierarchical' => true,
		'show_admin_column' => true,		
	);

	register_taxonomy('clubnews-category',array( 'club_news' ),$args);
}
add_action( 'init', 'club_create_category' );




function rs_club_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('club-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'club' ){
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
add_action( 'restrict_manage_posts', 'rs_club_add_taxonomy_filters' );

/*--------------------------------------------------------------
*			Member social links
*-------------------------------------------------------------*/
function rs_club_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Club Social Profiles', 'rsaddon'), 'rs_team_social_meta_link_callback', 'club', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_club_social_link_meta_box' );
// Social Meta Callback
function rs_club_social_meta_link_callback_new( $social_meta ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
	<!-- member social -->
	<div class="wrap-meta-group">
		<div style="margin: 10px 0;"><label for="facebook" style="width:150px; display:inline-block;"><?php esc_html_e( 'Facebook', 'rsaddon') ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="twitter" style="width:150px; display:inline-block;"><?php esc_html_e(
					'Twitter', 'rsaddon') ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="google_plus" style="width:150px; display:inline-block;"><?php esc_html_e( 'Google Plus', 'rsaddon') ?></label>
			<?php $google_plus = get_post_meta( $social_meta->ID, 'google_plus', true ); ?>
			<input type="text" name="google_plus" id="google_plus" class="google_plus" value="<?php echo esc_html($google_plus); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="instagram" style="width:150px; display:inline-block;"><?php esc_html_e( 'Instagram', 'rsaddon') ?></label>
			<?php $instagram = get_post_meta( $social_meta->ID, 'instagram', true ); ?>
			<input type="text" name="instagram" id="instagram" class="instagram" value="<?php echo esc_html($instagram); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="vimeo" style="width:150px; display:inline-block;"><?php esc_html_e( 'Vimeo', 'rsaddon') ?></label>
			<?php $vimeo = get_post_meta( $social_meta->ID, 'vimeo', true ); ?>
			<input type="text" name="vimeo" id="vimeo" class="vimeo" value="<?php echo esc_html($vimeo); ?>" style="width:300px;"/>
		</div>

		<div style="margin: 10px 0;"><label for="linkedin" style="width:150px; display:inline-block;"><?php esc_html_e( 'Linkedin', 'rsaddon') ?></label>
			<?php $linkedin= get_post_meta( $social_meta->ID, 'linkedin', true ); ?>
			<input type="text" name="linkedin" id="linkedin" class="linkedin" value="<?php echo esc_html($linkedin); ?>" style="width:300px;"/>
		</div>
	</div>
<?php }
/*--------------------------------------------------------------
 *			Save member social meta
*-------------------------------------------------------------*/
function rs_club_social_meta_link_callback( $post_id ) {
	if ( ! isset( $_POST['member_social_metabox_nonce'] ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ( 'players' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	$mymeta = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'vimeo', 'instagram' );
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
add_action( 'save_post', 'rs_club_social_meta_link_callback' );