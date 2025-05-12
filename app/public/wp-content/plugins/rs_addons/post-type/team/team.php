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
function rs_team_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Players', 'rsaddon'),
		'singular_name'      => esc_html__( 'Player', 'rsaddon'),
		'add_new'            => esc_html__( 'Add New Player', 'rsaddon'),
		'add_new_item'       => esc_html__( 'Add New Player', 'rsaddon'),
		'edit_item'          => esc_html__( 'Edit Player', 'rsaddon'),
		'new_item'           => esc_html__( 'New Player', 'rsaddon'),
		'all_items'          => esc_html__( 'All Players', 'rsaddon'),
		'view_item'          => esc_html__( 'View Player', 'rsaddon'),
		'search_items'       => esc_html__( 'Search Players', 'rsaddon'),
		'not_found'          => esc_html__( 'No Players found', 'rsaddon'),
		'not_found_in_trash' => esc_html__( 'No Players found in Trash', 'rsaddon'),
		'parent_item_colon'  => esc_html__( 'Parent Player:', 'rsaddon'),
		'menu_name'          => esc_html__( 'Players', 'rsaddon'),
	);

	global $khelo_option;
	$team_slug = (!empty($khelo_option['team_slug']))? $khelo_option['team_slug'] :'players';
	
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
		'rewrite' => 		 array('slug' => $team_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'players', $args );
}
add_action( 'init', 'rs_team_register_post_type' );


function player_create_category() {	
	$args = array(
		'label' => __( 'Players Categories','rsaddon'),
		'rewrite' => array( 'slug' => 'player-category' ),
		'hierarchical' => true,
		'show_admin_column' => true,		
	);

	register_taxonomy('player-category',array( 'players' ),$args);
}
add_action( 'init', 'player_create_category' );


/*--------------------------------------------------------------
*			Member social links
*-------------------------------------------------------------*/
function rs_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Social Profiles', 'rsaddon'), 'rs_team_social_meta_link_callback', 'players', 'advanced', 'high', 2 );
}

add_action( 'add_meta_boxes', 'rs_team_member_social_link_meta_box' );
// Social Meta Callback
function rs_team_social_meta_link_callback( $social_meta ) {
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
function save_rs_team_member_social_meta( $post_id ) {
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
add_action( 'save_post', 'save_rs_team_member_social_meta' );