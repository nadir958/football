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
		'name'               => esc_html__( 'Members', 'bstart'),
		'singular_name'      => esc_html__( 'Member', 'bstart'),
		'add_new'            => esc_html_x( 'Add New Member', 'rs-option', 'bstart'),
		'add_new_item'       => esc_html__( 'Add New Member', 'bstart'),
		'edit_item'          => esc_html__( 'Edit Member', 'bstart'),
		'new_item'           => esc_html__( 'New Member', 'bstart'),
		'all_items'          => esc_html__( 'All Members', 'bstart'),
		'view_item'          => esc_html__( 'View Member', 'bstart'),
		'search_items'       => esc_html__( 'Search Members', 'bstart'),
		'not_found'          => esc_html__( 'No Members found', 'bstart'),
		'not_found_in_trash' => esc_html__( 'No Members found in Trash', 'bstart'),
		'parent_item_colon'  => esc_html__( 'Parent Member:', 'bstart'),
		'menu_name'          => esc_html__( 'Team', 'bstart'),
	);
	global $kulluu_option;
	$team_slug = (!empty($kulluu_option['team_slug']))? $kulluu_option['team_slug'] :'teams';
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
		'rewrite' => 		 array('slug' => $team_slug,'with_front' => false),
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'teams', $args );
}
add_action( 'init', 'rs_team_register_post_type' );

function tr_create_team() {
	global $kulluu_option;
	$team_slug_cat = (!empty($kulluu_option['team_slug']))? $kulluu_option['team_slug'].'-category' :'team-category';
	register_taxonomy(
		'team-category',
		'teams',
		array(
			'label' => __( 'Categories','bstart'),
			'rewrite' => array( 'slug' => $team_slug_cat ),
			'hierarchical' => true,
			'show_admin_column' => true,		
		)
	);
}
add_action( 'init', 'tr_create_team' );

function rs_team_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('team-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'teams' ){
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
add_action( 'restrict_manage_posts', 'rs_team_add_taxonomy_filters' );



// Meta Box
/*--------------------------------------------------------------
*			Member info
*-------------------------------------------------------------*/
function rs_team_member_info_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Member Info', 'bstart'), 'rs_team_member_info_meta_callback', 'teams', 'advanced', 'high', 1 );
}
add_action( 'add_meta_boxes', 'rs_team_member_info_meta_box');
// member info callback
function rs_team_member_info_meta_callback( $member_info ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
	<div style="margin: 10px 0;"><label for="designation" style="width:150px; display:inline-block;"><?php esc_html_e( 'Designation', 'bstart') ?></label>
	<?php $designation = get_post_meta( $member_info->ID, 'designation', true ); ?>
	<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="company" style="width:150px; display:inline-block;"><?php esc_html_e( 'Company', 'bstart') ?></label>
	<?php $company = get_post_meta( $member_info->ID, 'company', true ); ?>
	<input type="text" name="company" id="company" class="company" value="<?php echo esc_html($company); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="speciality" style="width:150px; display:inline-block;"><?php esc_html_e( 'Speciality', 'bstart') ?></label>
	<?php $speciality = get_post_meta( $member_info->ID, 'speciality', true ); ?>
	<input type="text" name="speciality" id="speciality" class="speciality" value="<?php echo esc_html($speciality); ?>" style="width:300px;"/>
	</div> 

    <div style="margin: 10px 0;"><label for="Description" style="width:150px; display:inline-block;"><?php esc_html_e( 'Short Description', 'bstart') ?></label>
	<?php $description = get_post_meta( $member_info->ID, 'description', true ); ?>
	<textarea name="description" id="description" class="description" style="width:300px; height:120px"/><?php echo esc_html($description); ?></textarea>
	</div>

	<div style="margin: 10px 0;"><label for="address" style="width:150px; display:inline-block;"><?php esc_html_e( 'Address', 'bstart') ?></label>
	<?php $address = get_post_meta( $member_info->ID, 'address', true ); ?>
	<input type="text" name="address" id="address" class="address" value="<?php echo esc_html($address); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="city" style="width:150px; display:inline-block;"><?php esc_html_e( 'City', 'bstart') ?></label>
	<?php $city = get_post_meta( $member_info->ID, 'city', true ); ?>
	<input type="text" name="city" id="city" class="city" value="<?php echo esc_html($city); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="state" style="width:150px; display:inline-block;"><?php esc_html_e( 'State', 'bstart') ?></label>
	<?php $state = get_post_meta( $member_info->ID, 'state', true ); ?>
	<input type="text" name="state" id="state" class="state" value="<?php echo esc_html($state); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="country" style="width:150px; display:inline-block;"><?php esc_html_e( 'Country', 'bstart') ?></label>
	<?php $country = get_post_meta( $member_info->ID, 'country', true ); ?>
	<input type="text" name="country" id="country" class="country" value="<?php echo esc_html($country); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="phone" style="width:150px; display:inline-block;"><?php esc_html_e( 'Phone', 'bstart') ?></label>
	<?php $phone = get_post_meta( $member_info->ID, 'phone', true ); ?>
	<input type="text" name="phone" id="phone" class="phone" value="<?php echo esc_html($phone); ?>" style="width:300px;"/>
	</div>

	<div style="margin: 10px 0;"><label for="email" style="width:150px; display:inline-block;"><?php esc_html_e( 'Email', 'bstart') ?></label>
	<?php $email = get_post_meta( $member_info->ID, 'email', true ); ?>
	<input type="text" name="email" id="email" class="email" value="<?php echo esc_html($email); ?>" style="width:300px;"/>
	</div> 

	<div style="margin: 10px 0;"><label for="website" style="width:150px; display:inline-block;"><?php esc_html_e( 'Website', 'bstart') ?></label>
	<?php $website = get_post_meta( $member_info->ID, 'website', true ); ?>
	<input type="text" name="website" id="website" class="website" value="<?php echo esc_html($website); ?>" style="width:300px;"/>
	</div> 

<?php }
/*--------------------------------------------------------------
*			Member social links
*-------------------------------------------------------------*/
function rs_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Member Social Links', 'bstart'), 'rs_team_social_meta_link_callback', 'teams', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rs_team_member_social_link_meta_box' );
// Social Meta Callback
function rs_team_social_meta_link_callback( $social_meta ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
	<!-- member social -->
	<div class="wrap-meta-group">
		<div style="margin: 10px 0;"><label for="facebook" style="width:150px; display:inline-block;"><?php esc_html_e( 'Facebook', 'bstart') ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="twitter" style="width:150px; display:inline-block;"><?php esc_html_e(
					'Twitter', 'bstart') ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="google_plus" style="width:150px; display:inline-block;"><?php esc_html_e( 'Google Plus', 'bstart') ?></label>
			<?php $google_plus = get_post_meta( $social_meta->ID, 'google_plus', true ); ?>
			<input type="text" name="google_plus" id="google_plus" class="google_plus" value="<?php echo esc_html($google_plus); ?>" style="width:300px;"/>
		</div>
		<div style="margin: 10px 0;"><label for="linkedin" style="width:150px; display:inline-block;"><?php esc_html_e( 'Linkedin', 'bstart') ?></label>
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
	if ( 'teams' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	$mymeta = array( 'facebook', 'twitter', 'google_plus', 'linkedin', 'designation', 'description','website','phone','address','city','state','country','phone','email','company', 'speciality' );
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