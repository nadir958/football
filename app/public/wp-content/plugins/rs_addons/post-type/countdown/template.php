<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


 /*=====================================================================
	// RS Team ShortCode
  =======================================================================*/

	function rs_coutdown_shortcode( $atts ) {	


 /*=====================================================================
	//take shorcode ID
  =======================================================================*/
	
	$atts = shortcode_atts(
		array(
			'id' => "", 
		), $atts);
		global $post;
		$post_id = $atts['id'];	
		$post_id;	
		if($post_id!='xx'){			

	

		$dir 		   = plugin_dir_path( __FILE__ );	
	
		$args = array(
				'post_type' => 'cl_countdown',	
				'p' => $post_id				
				);

			
		$que = new WP_Query( $args );

		if ( $que->have_posts() ) {
			while ( $que->have_posts() ) : $que->the_post();

				$select_date = get_post_meta(get_the_ID(),'match_start_date' ,true);
				$item_img = get_the_post_thumbnail_url($post_id,'full');
				$item_bg = '';
				if(!empty($item_img)){
					$item_bg =  'style="background-image: url('.$item_img.'")';
				}

				$timeformat = date('Y-m-d H:i:s', $select_date );

				$html = '
					<div class="countdown-item" '.$item_bg.'>
						<div  class="CountDownTimer" data-date="'.$timeformat.'"></div>
					</div>
				';
			endwhile;
			wp_reset_query();
			return $html;
		}
	
	}
}

add_shortcode( 'rscountdown', 'rs_coutdown_shortcode' );
