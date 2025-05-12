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

function clteam_team_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Countdown', 'clteam' ),
		'singular_name'      => esc_html__( 'Countdown', 'clteam' ),
		'add_new'            => esc_html_x( 'Add New Countdown', 'clteam', 'clteam' ),
		'add_new_item'       => esc_html__( 'Add New Countdown', 'clteam' ),
		'edit_item'          => esc_html__( 'Edit Countdown', 'clteam' ),
		'new_item'           => esc_html__( 'New Countdown', 'clteam' ),
		'all_items'          => esc_html__( 'All Countdown', 'clteam' ),
		'view_item'          => esc_html__( 'View Countdown', 'clteam' ),
		'search_items'       => esc_html__( 'Search Countdown', 'clteam' ),
		'not_found'          => esc_html__( 'No Countdown found', 'clteam' ),
		'not_found_in_trash' => esc_html__( 'No Countdown found in Trash', 'clteam' ),
		'parent_item_colon'  => esc_html__( 'Parent Countdown:', 'clteam' ),
		'menu_name'          => esc_html__( 'RS Countdown', 'clteam' ),
	);

	$args = array(

		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor' )
	);

		register_post_type( 'cl_countdown', $args );
}
add_action( 'init', 'clteam_team_register_post_type' );





/*-----------------------------------
Settings text for title and save etc
-------------------------------------*/

function clteam_settings_admin_enter_title( $input ) {
global $post_type;

if ( 'cl_countdown' == $post_type )
	return __( 'Enter Shortcode Name', 'cl_countdown' );

return $input;
}
add_filter( 'enter_title_here', 'clteam_settings_admin_enter_title' );


function clteam_settings_admin_updated_messages( $messages ) {
global $post, $post_id;
$messages['cl_countdown'] = array( 
	1 => __('Shortcode updated.', 'cl_countdown'),
	2 => $messages['post'][2],
	3 => $messages['post'][3],
	4 => __('Shortcode updated.', 'cl_countdown'),
	5 => isset($_GET['revision']) ? sprintf( __('Shortcode restored to revision from %s', 'cl_countdown'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => __('Shortcode published.', 'cl_countdown'),
	7 => __('Shortcode saved.', 'cl_countdown'),
	8 => __('Shortcode submitted.', 'cl_countdown'),
	9 => sprintf( __('Shortcode scheduled for: <strong>%1$s</strong>.', 'cl_countdown'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) )),
	10 => __('Shortcode draft updated.', 'cl_countdown'),
);
return $messages;
}
add_filter( 'post_updated_messages', 'clteam_settings_admin_updated_messages' );


/*------------------------------------------
Extra column make for shotcode custom post
-------------------------------------------*/


function clteam_settings_add_shortcode_column( $columns ) {
return array_merge( $columns,
	array( 'shortcode' => __( 'Shortcode', 'cl_team' ) ) 
	
	);
}
add_filter( 'manage_cl_countdown_posts_columns' , 'clteam_settings_add_shortcode_column' );


/*------------------------------------------
Dynamic Shortcode generator
-------------------------------------------*/

function clteam_settings_add_posts_shortcode_display( $column, $post_id ) {
if ($column == 'shortcode'){
	?>
<input style="background:#ccc; width:250px" type="text" onClick="this.select();" value="[rscountdown <?php echo 'id=&quot;'.$post_id.'&quot;';?>]" />
<br />
<textarea cols="50" rows="3" style="background:#ddd" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[rscountdown id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea>
<?php
}
}

add_action( 'manage_cl_countdown_posts_custom_column' , 'clteam_settings_add_posts_shortcode_display', 10, 2 );	
?>
