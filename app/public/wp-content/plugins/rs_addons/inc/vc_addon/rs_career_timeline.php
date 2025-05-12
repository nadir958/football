<?php
/*
Element Description: RS Client elements
*/
// Element Mapping

function vc_CareerTimeline_mapping() {
	 
	// Stop all if VC is not enabled
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}
	 
	// Map the block with vc_map()
	vc_map( 
		array(
			'name' => __('RS Career Timeline', 'rsconstruction'),
			'base' => 'vc_careertimeline',
			'description' => __('RS Career Timeline', 'rsconstruction'), 
			'category' => __('by RS Theme', 'rsconstruction'),   
			'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',    
			'params' => array(
				array(
	                "type" => "dropdown",
	                "heading" => __("Timeline Style", "rs-addons"),
	                "param_name" => "style",
	                "value" => array(
						__( 'Style 1', 'rs-addons') => 'Style 1',
						__( 'Style 2', 'rs-addons') => 'Style 2',
	                ),
	            ),
				array(
					'type' => 'textfield',
					'holder' => 'h3',
					'class' => 'title-class',
					'heading' => __( 'Post Per Page', 'rs-addons'),
					'param_name' => 'item_per_page',
					'value' => __( '3', 'rs-addons'),				
					'admin_label' => false,
					'weight' => 0,
					'description' => __( 'Write -1 to show all', 'rs-addons'),	
				   
				),	

				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'rs-addons'),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rs-addons'),
				),	
				
				array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'rs-addons'),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'rs-addons'),
				),           
		 	),
		)
	);                                
	
}
     
 add_action( 'vc_before_init', 'vc_CareerTimeline_mapping' );
     
    // Element HTML
   function vc_careertimeline_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'item_per_page' => '3',
					'style'         => 'Style 1',
					'el_class'      => '',					
					'css'           => ''            
                ), 
                $atts,'vc_careertimeline'
           )
        );
	
       //post per page
	   $per_page=$item_per_page;

	   $start = __('My Career', 'rs-addons');
	   $done = __('Done', 'rs-addons');
	  
	   //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
		
	
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		
        //******************//
        // query post
        //******************//
		if( "Style 1" == $style ){
			$i="";
			$html='<section class="cd-timeline js-cd-timeline '.$css_class.' '.$css_class_custom.'">
	        			<div class="cd-timeline__container">
		        			<div class="cd-timeline__block js-cd-block cd-block-start">
								<div class="cd-timeline__img cd-timeline__img--picture js-cd-img etimeimg'.$i.'">
		                     	<span class="timeline-year">'.$start.'</span>
		                     </div>
							 </div>';
							$best_wp = new wp_Query(array(
										'posts_per_page' =>$per_page,
										'post_type'=>'careers',
										'order' => 'ASC',
									));			   
								$i = 1;
								while($best_wp->have_posts()): $best_wp->the_post();
									$post_title     = get_the_title($best_wp->ID);				
									$post_link      = get_the_permalink($best_wp->ID);				
									$post_content   = get_the_content($best_wp->ID);				
									$post_img_url   = get_the_post_thumbnail_url($best_wp->ID,'full');	
									$join_year      = get_post_meta( get_the_ID(), 'join_year', true );
									$job_start_date = get_post_meta( get_the_ID(), 'job_start_date', true );	    		
								    $job_end_date   = get_post_meta( get_the_ID(), 'job_end_date', true );    		
									$career_summery = get_post_meta( get_the_ID(), 'career_summery', true );
									$career_id      = get_post_meta( get_the_ID(), 'career_video', true );
									$featured_img   = get_the_post_thumbnail($best_wp->ID);
									$career_video   ="";
									$end_date       = 'Current';
									$protocol = $_SERVER['REQUEST_SCHEME'];

									if(!empty($career_id)){
										$career_video = '<div class="rs-video-2"><a class="popup-videos" href="'.$protocol.'://www.youtube.com/watch?v='.$career_id.'" title=""> <i class="fa fa-play"></i> </a></div>';
									}
									if(!empty($career_video)){
										$featured_img = $career_video;
									}

									if(!empty($job_end_date)){
	                					$end_date = date("d F Y",strtotime($job_end_date));
	                				}

	                				$c_name = !empty($career_summery) ? '<div class="designation"><i class="fa fa-suitcase"></i>'.$career_summery.'</div>' : '';
									$duration = !empty($job_start_date) ? ' <span class="date"> '.date("d F Y",strtotime($job_start_date)).' - '.$end_date.'</span>' : '';
							
			$html .='<div class="cd-timeline__block js-cd-block">
	                     <div class="cd-timeline__img cd-timeline__img--picture js-cd-img etimeimg'.$i.'">
	                     	<span class="timeline-year">'.$featured_img.'</span>
	                     </div>
	                     <div class="cd-timeline__content js-cd-content etimeline'.$i.'" >
	                     	<div class="short-info">
		                     	<h3><a href="'.$post_link.'">'.$post_title.'</a></h3>
		                     	'.$c_name.'
				                '.$duration.'
				                <div class="clear-both"></div>
		                     	'.wp_kses_post($post_content).'
	                     	</div>
	                     	<div class="cd_timeline_desc cd-timeline__date js-cd-content etimeline'.$i.'" >
	                     		'.$join_year.'
		                    </div>
	                    </div>
	                </div>
	                ';
				endwhile;
				$html .='<div class="cd-timeline__block js-cd-block cd-block-done">
							<div class="cd-timeline__img cd-timeline__img--picture js-cd-img etimeimg'.$i.'">
	                     	<span class="timeline-year">'.$done.'</span>
	                     </div>
						 </div>';
				$i++;
				wp_reset_query();
			$html .='</div>
				</section>';
		}

		if( "Style 2" == $style ){

			$best_wp = new wp_Query(array(
				'posts_per_page' =>$per_page,
				'post_type'=>'careers',
				'order' => 'ASC',
			));

			$html = '
			<div class="container">
	            <div class="over-wrap-index">
	                <div id="wrap-index" class="wrap-index">
	                    <ul id="index" class="index">';
	                    while($best_wp->have_posts()): $best_wp->the_post();
	                    	$join_year      = get_post_meta( get_the_ID(), 'join_year', true );

	                        $html .= '<li><a href="#">'.$join_year.'</a></li>';

	                    endwhile;
	        $html .= '</ul>
	                </div>
	                <a class="prev" href="#" data-toggle="prev"><i class="fa fa-angle-left"></i></a>
        			<a class="next" href="#" data-toggle="next"><i class="fa fa-angle-right"></i></a>
	            </div>

	            <div class="over-wrap-list">
	                <div id="wrap-list" class="wrap-list">
	                    <ul id="list" class="list">';
	                        while($best_wp->have_posts()): $best_wp->the_post();
								$post_title     = get_the_title($best_wp->ID);				
								$post_link      = get_the_permalink($best_wp->ID);				
								$post_content   = get_the_content($best_wp->ID);				
								$post_img_url   = get_the_post_thumbnail_url($best_wp->ID,'full');	
								$join_year      = get_post_meta( get_the_ID(), 'join_year', true );	    		
								$job_start_date = get_post_meta( get_the_ID(), 'job_start_date', true );	    		
								$job_end_date   = get_post_meta( get_the_ID(), 'job_end_date', true );	    		
								$company_name   = get_post_meta( get_the_ID(), 'career_summery', true );
								$career_id      = get_post_meta( get_the_ID(), 'career_video', true );
								$featured_img   = get_the_post_thumbnail($best_wp->ID, 'finoptis_timeline');
								$career_video   = "";
								$main_img       = "";
								$two_col        = 'col-full';
								$col_right      = '';
								$career_video   = '';
								$end_date       = 'Current';
								$protocol = $_SERVER['REQUEST_SCHEME'];

								//$day = date("d",strtotime($job_start_date));
                				//echo $end_day = date("d F Y",strtotime($job_start_date));

                				if(!empty($job_end_date)){
                					$end_date = date("d F Y",strtotime($job_end_date));
                				}

								$c_name = !empty($company_name) ? '<div class="designation"><i class="fa fa-suitcase"></i>'.$company_name.'</div>' : '';
								$duration = !empty($job_start_date) ? ' <span class="date"> '.date("d F Y",strtotime($job_start_date)).' - '.$end_date.'</span>' : '';

								if(!empty($career_id)){
										$main_img = '<div class="post_image col-left"><iframe src="'.$protocol.'://www.youtube.com/embed/'.$career_id.'" width="100%" height="300" frameborder="0" allowfullscreen></iframe></div>';
										$two_col = 'two-col';
										$col_right = 'col-right';
									}elseif(!empty($featured_img)){
										$main_img = '<div class="post_image col-left">'.$featured_img.'</div>';
										$two_col = 'two-col';
										$col_right = 'col-right';
									}

		                        $html .= '<li>
		                        			<div class="content-wrap '.$two_col.'">
			                        			'.$main_img.'
				                                <div class="content '.$col_right.'">
				                                    <div class="title"><h3 class="career-title">'.$post_title.'</h3></div>
				                                    '.$c_name.'
				                                    '.$duration.'
				                                    <div class="clear-both"></div>
				                                    '.$post_content.'
				                               </div>
			                               </div>
			                               '.$career_video.'
			                             </li>';
		                    endwhile;
	                $html .= '</ul>
	                </div>
	            </div>
	        </div>'; 
		}
 return $html; 
}
add_shortcode( 'vc_careertimeline', 'vc_careertimeline_html' );