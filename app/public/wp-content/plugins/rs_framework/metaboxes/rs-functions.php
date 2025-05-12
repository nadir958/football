<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rs_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ){
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
}elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ){
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function rs_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function rs_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rs_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function rs_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'rs_register_project_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_project_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-project',
		'title'         => esc_html__( 'Poject Images', 'rs-framework' ),
		'object_types'  => array( 'portfolios' ), // Post type		
	) );

	$cmb_project->add_field( array(
	'name' => 'Upload Project Images',
	'desc' => '',
	'id'   => 'Screenshot',
	'type' => 'file_list',
	'text' => array(
		'add_upload_files_text' => 'Upload Files', // default: "Add or Upload Files"
		'remove_image_text' => 'Replacement', // default: "Remove Image"
		'file_text' => 'Replacement', // default: "File:"
		'file_download_text' => 'Replacement', // default: "Download"
		'remove_text' => 'Replacement', // default: "Remove"
	),
) );

	$cmb_project->add_field( array(
		'name'             => esc_html__( 'Project Image Style', 'rs-framework' ),
		'desc'             => esc_html__( 'chosse your  style', 'rs-framework' ),
		'id'               => 'image_select',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'slider' => esc_html__( 'Slider', 'rs-framework' ),
			'gallery' => esc_html__( 'Gallery', 'rs-framework' ),
			
		),
	) );
}



add_action( 'cmb2_admin_init', 'rs_register_header_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_header_metabox() {
	$prefix = 'rs_'; 

  /**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Header Settings', 'rs-framework' ),
		'object_types'  => array( 'mp-event','page','post','trainers','portfolios','services','product','archive','club', 'players' ), // Post type
		
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Select Banner Image', 'rs-framework' ),
		'desc' => esc_html__( 'Upload an image or enter a URL for page banner.', 'rs-framework' ),
		'id'   => 'banner_image',
		'type' => 'file',
	) );

	
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Header Style', 'rs-framework' ),
		'desc'             => esc_html__( 'chosse your individual header style', 'rs-framework' ),
		'id'               => 'header_select',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'header1' => esc_html__( 'Header Style 1', 'rs-framework' ),
			'header2' => esc_html__( 'Header Style 2(Transparent)', 'rs-framework' ),
			'header3' => esc_html__( 'Header Style 3', 'rs-framework' ),				
			'header4' => esc_html__( 'Header Style 4', 'rs-framework' ),
			'header5' => esc_html__( 'Header Style 5', 'rs-framework' ),				
		),
	) );


	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Header Width', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose your individual header width', 'rs-framework' ),
		'id'               => 'header_width_custom',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'container' => esc_html__( 'Container', 'rs-framework' ),
			'full' => esc_html__( 'Container Fluid', 'rs-framework' ),
				
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Header Custom Left Right Padding', 'rs-framework' ),
		'desc'             => esc_html__( 'It will be work only container fluid header (ex: 25px)', 'rs-framework' ),
		'id'               => 'header_custom_padding',
		'type'             => 'text_medium',		
	) );	

   
	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Logo Type', 'rs-framework' ),
		'desc'             => esc_html__( 'You can select logo type', 'rs-framework' ),
		'id'               => 'select-logo',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'light' => esc_html__( 'Light', 'rs-framework' ),
			'dark' => esc_html__( 'Dark', 'rs-framework' ),			
		),
	) );



	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Page Title', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide page title', 'rs-framework' ),
		'id'               => 'select-title',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Breadcurmbs', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide  breadcurmbs here', 'rs-framework' ),
		'id'               => 'select-bread',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	)
	);

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Top Bar', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide topbar', 'rs-framework' ),
		'id'               => 'select-top',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Header Search', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide search', 'rs-framework' ),
		'id'               => 'select-search',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );


		$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Menu Area Background', 'rs-framework' ),
		'desc'    => esc_html__( 'chosse your background', 'rs-framework' ),
		'id'      => 'menu-type-bg',		
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Menu Type', 'rs-framework' ),
		'desc'             => esc_html__( 'You can select menu type', 'rs-framework' ),
		'id'               => 'menu-type',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'light' => esc_html__( 'Light', 'rs-framework' ),
			'dark' => esc_html__( 'Dark', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Menu Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(10px)', 'rs-framework' ),		
		'id'      => 'menu_top',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Menu Bottom Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(10px)', 'rs-framework' ),		
		'id'      => 'menu_bottom',
		'type'    => 'text_medium',
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Cart Icon Show At Menu Area', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide cart icon', 'rs-framework' ),
		'id'               => 'show-cart-icon',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show off Canvas', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide off canvas', 'rs-framework' ),
		'id'               => 'show-off-canvas',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Header Social Icon', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide header social icon', 'rs-framework' ),
		'id'               => 'show-head-icons',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Show Quote Button', 'rs-framework' ),
		'desc'             => esc_html__( 'You can show/hide quote button', 'rs-framework' ),
		'id'               => 'show-quote',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'show' => esc_html__( 'Show', 'rs-framework' ),
			'hide' => esc_html__( 'Hide', 'rs-framework' ),			
		),
	) );


}

//page section metabox

add_action( 'cmb2_admin_init', 'rs_register_page_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rs_register_page_metabox() {
	$prefix = 'rs_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'            => $prefix . 'page',
		'title'         => esc_html__( 'Page Settings', 'rs-framework' ),
		'object_types'  => array( 'page'), // Post type		
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Content Top Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(100px)', 'rs-framework' ),
		'default' => esc_attr__( '100px', 'rs-framework' ),
		'id'      => 'content_top',
		'type'    => 'text_medium',
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Content Bottom Padding', 'rs-framework' ),
		'desc'    => esc_html__( 'example(100px)', 'rs-framework' ),
		'default' => esc_attr__( '100px', 'rs-framework' ),
		'id'      => 'content_bottom',
		'type'    => 'text_medium',
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Subscribe Background Image', 'cmb2' ),		
		'id'      => 'subscribe_bg_img',
		'type'    => 'file',		
	) );


}

add_action( 'cmb2_admin_init', 'rsfootertop_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rsfootertop_register_metabox() {
	$prefix = 'rsfootertop_'; 
  	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Footer Newsletter Settings', 'rs-framework' ),
		'object_types'  => array( 'page' ), // Post type	
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Newsletter Background Image', 'cmb2' ),
		'desc'    => esc_html__( 'Select newsletter background image', 'cmb2' ),
		'id'      => 'newsletter_bg_img',
		'type'    => 'file',		
	) );
	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Newsletter Background', 'cmb2' ),
		'desc'    => esc_html__( 'Select newsletter background', 'cmb2' ),
		'id'      => 'newsletter_bg',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	
}

add_action( 'cmb2_admin_init', 'rs_register_footer_metabox' );

function rs_register_footer_metabox() {
	$prefix = 'rs_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */


	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'footer',
		'title'         => esc_html__( 'Footer Settings', 'rs-function' ),
		'object_types'  => array( 'page' ), // Post type		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Footer Width', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose your individual header width', 'rs-framework' ),
		'id'               => 'header_width_custom2',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'container' => esc_html__( 'Container', 'rs-framework' ),
			'full' => esc_html__( 'Container Fluid', 'rs-framework' ),
				
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Background Image', 'cmb2' ),
		'desc'    => esc_html__( 'select footer background image', 'cmb2' ),
		'id'      => 'footer_bg_img',
		'type'    => 'file',		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Background Position', 'rs-function' ),
		'desc'             => esc_html__( 'choose background position', 'rs-function' ),
		'id'               => 'footer_bg_position',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'center center' => esc_html__( 'Center Center', 'rs-function' ),
			'center top'    =>  esc_html__( 'Center Top', 'rs-function' ),			
			'center bottom' =>  esc_html__( 'Center Bottom', 'rs-function' ),			
			'left top'      =>  esc_html__( 'Left Top', 'rs-function' ),			
			'left bottom'   =>  esc_html__( 'Left Bottom', 'rs-function' ),			
			'right top'     =>  esc_html__( 'Right Top', 'rs-function' ),			
			'right bottom'  =>  esc_html__( 'Right Bottom', 'rs-function' ),			
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Footer Background', 'cmb2' ),
		'desc'    => esc_html__( 'select footer background', 'cmb2' ),
		'id'      => 'footer_bg',
		'type'    => 'colorpicker',
		'default' => '',		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Copyright Background Transparent', 'rs-framework' ),
		'desc'             => esc_html__( 'Choose copyright background Transparent', 'rs-framework' ),
		'id'               => 'copyright_trans',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'no' => esc_html__( 'No', 'rs-framework' ),
			'yes' => esc_html__( 'Yes', 'rs-framework' ),
				
		),
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Copyright Background', 'cmb2' ),
		'desc'    => esc_html__( 'select copyright background', 'cmb2' ),
		'id'      => 'copyright_bg',
		'type'    => 'colorpicker',
		'default' => '',
		'options' => array(
	        'alpha' => true, // Make this a rgba color picker.
	    ),		
	) );

	$cmb_demo->add_field( array(
		'name'    => esc_html__( 'Copyright Padding', 'cmb2' ),
		'desc'    => esc_html__( 'example(10px 5px)', 'rs-framework' ),
		'id'      => 'copyright_padding',
		'type'    => 'text_medium',
		'default' => esc_attr__( '0px', 'rs-framework' ),		
	) );

	$cmb_demo->add_field( array(
		'name'             => esc_html__( 'Select Footer Text Style', 'rs-function' ),
		'desc'             => esc_html__( 'chosse your footer color', 'rs-function' ),
		'id'               => 'footer_select',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'footerlight' => esc_html__( 'Light', 'rs-function' ),
			'footerdark' =>  esc_html__( 'Dark', 'rs-function' ),			
		),
	) );
	
}


function get_myposttype_options($argument) {
	$args = array('post_type' => $argument, 'posts_per_page' => -1);
	$loop = new WP_Query($args);
	if($loop->have_posts()) {  
	    while($loop->have_posts()) : $loop->the_post();
	        //
	        $varID = get_the_id();
	        $varName = get_the_title();
	        $pageArray[$varID]=$varName;
	    endwhile; 
	    return  $pageArray;  
	}
	
}


add_action( 'cmb2_admin_init', 'rs_club_news_details_metabox' );

function rs_club_news_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'club_news_details',
		'title'         => esc_html__( 'Select Club', 'rs-framework' ),
		'context'      => 'side',
		'object_types'  => array( 'club_news' ), // Post type
		
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Club Name', 'rs-framework' ),		
		'id'      => 'category_club',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),		
		'show_option_none'          => 'Select',
	) );	

}


add_action( 'cmb2_admin_init', 'rs_palyer_details_metabox' );

function rs_palyer_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'team_profile_details',
		'title'         => esc_html__( 'Player General Information', 'rs-framework' ),
		'object_types'  => array( 'players' ), // Post type
		
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Top Player', 'rs-framework' ),
		'desc'    => esc_html__( 'Select it if top player', 'rs-framework' ),
		'id'      => 'top_player',
		'type'    => 'checkbox',
	) );

		
	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Full Name', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter player full name ', 'rs-framework' ),
		'id'      => 'full_name',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'             => 'Player Postion',
		'desc'             => 'Select Player Postion',
		'id'               => 'player_position',
		'type'             => 'select',
		'show_option_none' => 'Default',
		'options'          => array(
			'Defender' => esc_html__( 'Defender', 'rs-framework' ),
			'Forward' => esc_html__( 'Forward', 'rs-framework' ),				
			'Goalkeeper' => esc_html__( 'Goalkeeper', 'rs-framework' ),				
			'Midfielder' => esc_html__( 'Midfielder', 'rs-framework' ),				
		),
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Player Custom Postion', 'rs-framework' ),
		'desc'    => esc_html__( 'Custom Postion If you need ', 'rs-framework' ),
		'id'      => 'custom_position',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Squad Number', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter player squad number ', 'rs-framework' ),
		'id'      => 'squad_number',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Country Short Name', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter Country Short Name ', 'rs-framework' ),
		'id'      => 'c_short_name',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name' => 'Country Flag',
		'desc' => 'Upload player Country Flag',
		'id'   => 'player_flag',
		'type' => 'file',
		'query_args' => array(
	        'type' => array(
	            'image/gif',
	            'image/jpeg',
	            'image/png',
	         ),
	    ),				
	) );

	$cmb_project->add_field( array(
		'name' => 'Player Sign',
		'desc' => 'Upload player sign image',
		'id'   => 'player-sign',
		'type' => 'file'
		
	) );	

	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'player_exta',
		'description' => esc_html__('Add More Player Info', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Info', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Title', 'rs-function' ),
		'id'         => 'info_title',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Value', 'rs-function' ),
		'id'         => 'info_value',
		'type'       => 'text'	
		
	) );	

}


/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */


add_action( 'cmb2_admin_init', 'player_statistics_register_repeatable_group_field_metabox' );
function player_statistics_register_repeatable_group_field_metabox() {
	$prefix = 'yourprefix_group_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_statistics = new_cmb2_box( array(
		'id'           => $prefix . 'statistics',
		'title'        => esc_html__( 'Player Career Information', 'rs-function' ),
		'object_types' => array( 'players' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb_statistics->add_field( array(
		'name'    => esc_html__( 'Present Club', 'rs-framework' ),		
		'id'      => 'present_club',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),		
		'show_option_none'          => 'Select',
	) );

	$cmb_statistics->add_field( array(
		'name'    => esc_html__( 'Previous Club', 'rs-framework' ),		
		'id'      => 'previous_club',
		'type'    => 'multicheck',

		'options' => get_myposttype_options('club')
	) );

	$cmb_statistics->add_field( array(
		'name'    => esc_html__( 'Debut Club', 'rs-framework' ),		
		'id'      => 'debut_club',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),		
		'show_option_none'          => 'Select',
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_statistics->add_field( array(
		'id'          => 'player_career',
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_statistics->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Title', 'rs-function' ),
		'id'         => 'info_title',
		'type'       => 'text'		
	) );

	$cmb_statistics->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Value', 'rs-function' ),
		'id'         => 'info_value',
		'type'       => 'text'	
		
	) );		

}




//club information settings

add_action( 'cmb2_admin_init', 'rstheme_club_details_metabox' );

function rstheme_club_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'club_details',
		'title'         => esc_html__( 'Club Information', 'rs-framework' ),
		'object_types'  => array( 'club'), // Post type
		
	) );

	
	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Club Type', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter club name ', 'rs-framework' ),
		'id'      => 'club_type_name',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Home Stadium For This Club', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter stadium name ', 'rs-framework' ),
		'id'      => 'club_stadium',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Club Country', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter country name ', 'rs-framework' ),
		'id'      => 'club_country',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
		'name'    => esc_html__( 'Club Points', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter Club Points ', 'rs-framework' ),
		'id'      => 'club_points',
		'type'    => 'text_medium',
	) );

	$cmb_project->add_field( array(
	'name' => 'Gallery Images',
	'desc' => '',
	'id'   => 'gallery_club_images',
	'type' => 'file_list',	
	'text' => array(
		'add_upload_files_text' => 'Upload Images', // default: "Add or Upload Files"
		'remove_image_text' => 'Remove Image', // default: "Remove Image"
		'file_text' => 'File', // default: "File:"
		'file_download_text' => 'Download', // default: "Download"
		'remove_text' => 'Remove', // default: "Remove"
	),
) );		

	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'club_exta',
		'description' => esc_html__('Add More Club Information', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Info', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Title', 'rs-function' ),
		'id'         => 'info_title',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Value', 'rs-function' ),
		'id'         => 'info_value',
		'type'       => 'text'	
		
	) );

	

	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'club_exta_statistic',
		'description' => esc_html__('Add More Club Statistics Info', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Info', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Title', 'rs-function' ),
		'id'         => 'info_title',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Value', 'rs-function' ),
		'id'         => 'info_value',
		'type'       => 'text'	
		
	) );






	$champion_field_id = $cmb_project->add_field( array(
		'id'          => 'club_champion',
		'description' => esc_html__('Club Honours Information', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $champion_field_id, array(
		'name'       => esc_html__( 'No of Champion', 'rs-function' ),
		'id'         => 'champion_number',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $champion_field_id, array(
		'name'       => esc_html__( 'League Title', 'rs-function' ),
		'id'         => 'league_title',
		'type'       => 'text'
		
	) );

	$cmb_project->add_group_field( $champion_field_id, array(
		'name' => 'Champion Trophy Image',
		'desc' => 'Upload club banner image',
		'id'   => 'houner_image',
		'type' => 'file'		
	) );	

	$cmb_project->add_group_field( $champion_field_id, array(
		'name'       => esc_html__( 'Year List', 'rs-function' ),
		'id'         => 'year_list',
		'type'       => 'textarea'
		
	) );


	$jersy_field_id = $cmb_project->add_field( array(
		'id'          => 'club_jersy',
		'description' => esc_html__('Club Jersy Kit', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $jersy_field_id, array(
		'name'       => esc_html__( 'Jersy Type', 'rs-function' ),
		'id'         => 'jersy_type',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $jersy_field_id, array(
		'name' => 'Jersy Image',
		'desc' => 'Upload Jersy image',
		'id'   => 'jersy_image',
		'type' => 'file'		
	) );

	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'club_videos',
		'description' => esc_html__('Add Club Viedos', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Video', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Video Link', 'rs-function' ),
		'id'         => 'video_link',
		'type'       => 'text'		
	) );






}
//custom tab for club


//Player information settings

add_action( 'cmb2_admin_init', 'rstheme_club_custom_details_metabox' );

function rstheme_club_custom_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'club_tab',
		'title'         => esc_html__( 'Custom Tab Information', 'rs-framework' ),
		'object_types'  => array( 'club' ), // Post type
		
	) );



	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'club_extatab',
		'description' => esc_html__('Add Extra Tab', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More tab', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Tab Title', 'rs-function' ),
		'id'         => 'tab_tile',
		'type'       => 'text'		
	) );

	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Tab Title', 'rs-function' ),
		'id'         => 'tab_content',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
		),		
	) );	


}


//Player information settings

add_action( 'cmb2_admin_init', 'rstheme_player_details_metabox' );

function rstheme_player_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'player_details',
		'title'         => esc_html__( 'Player Other Information', 'rs-framework' ),
		'object_types'  => array( 'players' ), // Post type
		
	) );


	$cmb_project->add_field( array(
		'name' => 'Gallery Images',
		'desc' => '',
		'id'   => 'gallery_player_images',
		'type' => 'file_list',	
		'text' => array(
			'add_upload_files_text' => 'Upload Images', // default: "Add or Upload Files"
			'remove_image_text' => 'Remove Image', // default: "Remove Image"
			'file_text' => 'File', // default: "File:"
			'file_download_text' => 'Download', // default: "Download"
			'remove_text' => 'Remove', // default: "Remove"
		),
	) );		





	$group_field_id = $cmb_project->add_field( array(
		'id'          => 'club_videos',
		'description' => esc_html__('Add Player Viedos', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Video', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_project->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Video Link', 'rs-function' ),
		'id'         => 'video_link',
		'type'       => 'text'		
	) );	


}




// Match Fixture and Resutl Settings

add_action( 'cmb2_admin_init', 'rs_fixture_details_metabox' );
function rs_fixture_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_match = new_cmb2_box( array(
		'id'            => $prefix . 'fixture_details',
		'title'         => esc_html__( 'Match Fixture & Result Settings', 'rs-framework' ),
		'object_types'  => array( 'fixture-results' ), // Post type
		
	) );
		
	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Team 1', 'rs-framework' ),
		'desc'    => esc_html__( 'Select Club name ', 'rs-framework' ),
		'id'      => 'team1',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),
		'show_option_none' => 'Select Club'
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Team 1 Club Formation', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter club formation ', 'rs-framework' ),
		'id'      => 'team1_formation',
		'type'    => 'text_medium'
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Team 2', 'rs-framework' ),
		'desc'    => esc_html__( 'Select Club name ', 'rs-framework' ),
		'id'      => 'team2',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),
		'show_option_none' => 'Select Club'
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Team 2 Club Formation', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter club formation ', 'rs-framework' ),
		'id'      => 'team2_formation',
		'type'    => 'text_medium'
	) );	

	
	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Match Datetime', 'rs-framework' ),
		'desc'    => esc_html__( 'Select date time ', 'rs-framework' ),
		'id'      => 'match_date',
		'type'    => 'text_datetime_timestamp'
	) );

	$cmb_match->add_field( array(
		'name' => esc_html__( 'Match Time zone', 'cmb2' ),
		'desc' => esc_html__( 'Enter time zone Ex(GMT 6+)', 'cmb2' ),
		'id'   => 'timezone',
		'type' => 'text_medium',
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Upcoming Match', 'rs-framework' ),
		'desc'    => esc_html__( 'Select it if match is upcoming', 'rs-framework' ),
		'id'      => 'upcoming_match',
		'type'    => 'checkbox',
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Home Ground Club', 'rs-framework' ),
		'desc'    => esc_html__( 'Select Club name', 'rs-framework' ),
		'id'      => 'team_home',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),
		'show_option_none' => 'Select Club'
	) );

	$cmb_match->add_field( array(
		'name' => esc_html__( 'Match Final Goal', 'cmb2' ),
		'desc' => esc_html__( 'Enter time goal amount(3:2)', 'cmb2' ),
		'id'   => 'total_goal',
		'type' => 'text_medium',
	) );	

	$group_field_id = $cmb_match->add_field( array(
		'id'          => 'result_stat',
		'description' => esc_html__('Match Statistics', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Info', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_match->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Information Type', 'rs-function' ),
		'id'         => 'team_info_value',
		'type'       => 'text',
			
	) );


	$cmb_match->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Team 1 Data', 'rs-function' ),
		'id'         => 'team1_data',
		'type'       => 'text'		
	) );

	

	$cmb_match->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Team 2 Data', 'rs-function' ),
		'id'         => 'team2_data',
		'type'       => 'text'		
	) );	

}

//countdown settings

add_action( 'cmb2_admin_init', 'rs_countdown_details_metabox' );
function rs_countdown_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_match = new_cmb2_box( array(
		'id'            => $prefix . 'countdown_details',
		'title'         => esc_html__( 'Countdown Settings', 'rs-framework' ),
		'object_types'  => array( 'cl_countdown' ), // Post type
		
	) );
	
	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Match Start Date', 'rs-framework' ),
		'desc'    => esc_html__( 'Select date ', 'rs-framework' ),
		'id'      => 'match_start_date',
		'type'    => 'text_datetime_timestamp'
	) );


	$cmb_button = $cmb_match->add_field( array(
		'id'          => 'slider_btn',
		'description' => esc_html__('Add Slider Button', 'rs-function'),
		'type'        => 'group',	
		'options'     => array(
			//'group_title'   => esc_html__( 'General Info {#}', 'rs-function' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add More Button', 'rs-function' ),
			'remove_button' => esc_html__( 'Remove', 'rs-function' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_match->add_group_field( $cmb_button, array(
		'name'       => esc_html__( 'Button Title', 'rs-function' ),
		'id'         => 'btn_title',
		'type'       => 'text'		
	) );

	$cmb_match->add_group_field( $cmb_button, array(
		'name'       => esc_html__( 'Button URL', 'rs-function' ),
		'id'         => 'btn_url',
		'type'       => 'text'	
		
	) );

}



//point table settings meta box

add_action( 'cmb2_admin_init', 'rs_pointable_details_metabox' );

function rs_pointable_details_metabox() {
	$prefix = 'rs_'; 
	$cmb_match = new_cmb2_box( array(
		'id'            => $prefix . 'point_details',
		'title'         => esc_html__( 'Point Table Settings', 'rs-framework' ),
		'object_types'  => array( 'point-table' ), // Post type
		
	) );
		
	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Team', 'rs-framework' ),
		'desc'    => esc_html__( 'Select Team Name ', 'rs-framework' ),
		'id'      => 'team_point',
		'type'    => 'select',
		'options' => get_myposttype_options('club'),
		'show_option_none' => 'Select Team'
	) );

	
	
	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Games Played(P)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Games Played ', 'rs-framework' ),
		'id'      => 'game_player',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Games Won(W)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Games Won ', 'rs-framework' ),
		'id'      => 'game_won',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );	

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Games Drown(D)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Games Drown ', 'rs-framework' ),
		'id'      => 'game_drown',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Games Lost(L)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Games Drown ', 'rs-framework' ),
		'id'      => 'game_lost',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Goals Scored(GD)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Goals Scored ', 'rs-framework' ),
		'id'      => 'goal_scored',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Goals Against(GA)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Goals Against ', 'rs-framework' ),
		'id'      => 'goal_against',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Goals Difference(GD)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Goals Difference  ', 'rs-framework' ),
		'id'      => 'goal_difference',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Total Points(PTS)', 'rs-framework' ),
		'desc'    => esc_html__( 'Total Number of Points', 'rs-framework' ),
		'id'      => 'total_points',
		'type'    => 'text_medium',
		'attributes' => array(
	        'type' => 'number',
	    ),
	) );
}


//point table settings meta box

add_action( 'cmb2_admin_init', 'rs_sponsor_metabox' );

function rs_sponsor_metabox() {
	$prefix = 'rs_'; 
	$cmb_match = new_cmb2_box( array(
		'id'            => $prefix . 'sponsors',
		'title'         => esc_html__( 'Sponsor Link', 'rs-framework' ),
		'object_types'  => array( 'rsclient' ), // Post type
		
	) );

	$cmb_match->add_field( array(
		'name'    => esc_html__( 'Enter Link', 'rs-framework' ),
		'desc'    => esc_html__( 'Link for sponsors', 'rs-framework' ),
		'id'      => 'url_sponsor',
		'type'    => 'text_url'
	) );
}

/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function rs_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'rs-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function rs_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}