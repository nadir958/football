<?php

function clt_testimonial_vc_addon_cpt() {
    register_post_type('clt_testimonials', array(
        'labels' => array(
            'name' => __('CL Testimonials', 'cl-testimonial-visual-composer-addon'),
            'singular_name' => __('CL Testimonial', 'cl-testimonial-visual-composer-addon'),
            'menu_name' => __('CL Testimonials', 'cl-testimonial-visual-composer-addon'),
            'parent_item_colon' => __('Parent Testimonial:', 'cl-testimonial-visual-composer-addon'),
            'all_items' => __('All Testimonials', 'cl-testimonial-visual-composer-addon'),
            'view_item' => __('View Testimonial', 'cl-testimonial-visual-composer-addon'),
            'add_new_item' => __('Add New Testimonial', 'cl-testimonial-visual-composer-addon'),
            'add_new' => __('Add New', 'cl-testimonial-visual-composer-addon'),
            'edit_item' => __('Edit Testimonial', 'cl-testimonial-visual-composer-addon'),
            'update_item' => __('Update Testimonial', 'cl-testimonial-visual-composer-addon'),
            'search_items' => __('Search Testimonial', 'cl-testimonial-visual-composer-addon'),
            'not_found' => __('Not found', 'cl-testimonial-visual-composer-addon'),
            'not_found_in_trash' => __('Not found in Trash', 'cl-testimonial-visual-composer-addon')
		),
    		'public' => true,
    		'menu_position' => 5,
    		'publicly_queryable' => false,
    		'menu_icon'          =>  plugins_url( '/img/icon-admin.png', __FILE__ ),
    		'supports' => array('title', 'editor', 'thumbnail'),
    		'taxonomies' => array(''),
    		'register_meta_box_cb' => 'clt_testimonials_meta_box',
    		'has_archive' => true
		)
   	 );
}

add_action('init', 'clt_testimonial_vc_addon_cpt');

/*
 * * Register MetaBox For Testimonial CPT
 */
// Meta Box

/*--------------------------------------------------------------
*			Testimonial info
*-------------------------------------------------------------*/

function clt_testimonials_meta_box() {
	add_meta_box( 'testimonial_info_meta', esc_html__( 'Testimonial Info', 'rs-option' ), 'clt_testimonials_meta_callback', 'clt_testimonials', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'clt_testimonials_meta_box');


// testimonial info callback
function clt_testimonials_meta_callback( $testimonial_info ) {

	wp_nonce_field( 'testimonial_social_metabox', 'testimonial_social_metabox_nonce' ); ?>

	<div style="margin: 10px 0;"><label for="designation" style="width:150px; display:inline-block;"><?php esc_html_e( 'Designation', 'cl-testimonial' ) ?></label>
	<?php $designation = get_post_meta( $testimonial_info->ID, 'designation', true ); ?>
	<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>" style="width:300px;"/>
	</div>   
    
     <div style="margin: 10px 0;">
    <label for="ratings" style="width:150px; display:inline-block;"><?php esc_html_e( 'Select Ratings', 'cl-testimonial') ?></label>
      <?php $ratings_cl = get_post_meta( $testimonial_info->ID, 'ratings', true ); 
	  if($ratings_cl!=''){
		  $rating_style=$ratings_cl;
	  }
	  else{
		   $rating_style='Select Ratings';
	  }
	  ?>          
    <select name="ratings">
        <option selected="selected" value="<?php echo  $rating_style;?>"><?php echo  $rating_style;?></option>
        <option value="Select Ratings">Select Ratings</option>
        <option value="1">1</option>
        <option value="1.5">1.5</option>
        <option value="2">2</option>
        <option value="2.5">2.5</option>
        <option value="3">3</option>
        <option value="3.5">3.5</option>
        <option value="4">4</option>
        <option value="4.5">4.5</option>
        <option value="5">5</option>
    </select>
       
   </div>
<?php }

/*--------------------------------------------------------------
 *			Save testimonial meta
*-------------------------------------------------------------*/
function save_clt_testimonials_meta_social_meta( $post_id ) {
	if ( ! isset( $_POST['testimonial_social_metabox_nonce'] ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'clt_testimonials' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	if( isset( $_POST[ 'designation' ] ) ) {
        update_post_meta( $post_id, 'designation', $_POST[ 'designation' ] );
    }
  	if( isset( $_POST[ 'ratings' ] ) ) {
        update_post_meta( $post_id, 'ratings', $_POST[ 'ratings' ] );
    }

}

add_action( 'save_post', 'save_clt_testimonials_meta_social_meta' );