<?php
/*
Element Description: Rs Addon 
*/
 if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
}
    // Element Mapping
     function rs_staff_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('RS Staff Management', 'rsaddon'),
                'base' => 'rs_staff',
                'description' => __('RS Staff Management', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(
		    
		    array(
		      'type' => 'param_group',
		      'param_name' => 'values',
		      'params' => array(
		      	array(
					"type"        => "attach_image",
					"heading"     => __( "Staff Image", "rsaddon" ),
					"description" => __( "Add Staff image", "rsaddon" ),
					"param_name"  => "screenshots",
					"value"       => "",					
				),
			
					
		        array(
		          'type' => 'textfield',
		          'name' => 'label',
		          'heading' => __('Heading', 'rsaddon'),
		          'param_name' => 'label',
		        ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('Sub Heading', 'rsaddon'),
                  'param_name' => 'label2',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('Position:', 'rsaddon'),
                  'param_name' => 'label3',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('', 'rsaddon'),
                  'param_name' => 'label33',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('Born:', 'rsaddon'),
                  'param_name' => 'label4',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('', 'rsaddon'),
                  'param_name' => 'label44',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('Joined Club:', 'rsaddon'),
                  'param_name' => 'label5',
                ),

                array(
                  'type' => 'textfield',
                  'name' => 'label',
                  'heading' => __('', 'rsaddon'),
                  'param_name' => 'label55',
                ),

		        array(
		          'type' => 'textarea',
		          'name' => 'Content',
		          'heading' => __('Content', 'rsaddon'),
		          'param_name' => 'excerpt',
		        ),
		      )
		    ),

	    	array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'appone' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'appone' ),
			),  
	
		),

		));                     
        
    }
     
  add_action( 'vc_before_init', 'rs_staff_mapping' );
     
    // Element HTML
    function rs_staff_html( $atts, $content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(					
					'values'       => '',
					'col_lg'       => '3',
					'col_md'       => '3',
					'col_sm'       => '3',
					'col_mobile'   => '1',          
					'slider_dots'  => 'false',				
					'slider_arrow' => 'false',				
					'css'          =>'',
					
                ), 
                $atts,'rs_staff'
            )
        );     

        //for css edit box value extract
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
        $list ='';      
		$values = vc_param_group_parse_atts($atts['values']);
		$new_accordion_value = array();
		$menu_item_data = array(
	            'col_lg'     => $col_lg,
	            'col_md'     => $col_md,
	            'col_sm'     => $col_sm,
	            'col_mobile' => $col_mobile,
	            'slider_dots'=> $slider_dots,
	            'slider_arrow'=> $slider_arrow,
	        );  


	    wp_localize_script( 'advokat-main', 'menu_slider_data', $menu_item_data );

		foreach($values as $data){
			$new_line = $data;
      if(isset($new_line["screenshots"]) && !empty($new_line["screenshots"])) {
          
        
        $img = wp_get_attachment_image_src($new_line["screenshots"], "large");
        $imgSrc = '';
        if(isset($img[0])) {
          $imgSrc = $img[0];
        }
			
		   	$new_line['screenshots']     = isset($imgSrc)? $imgSrc : '';
      }
		   	
		   
			$new_line['label']       = isset($new_line['label']) ? $new_line['label'] : '';
      $new_line['label2']       = isset($new_line['label2']) ? $new_line['label2'] : '';
      $new_line['label3']       = isset($new_line['label3']) ? $new_line['label3'] : '';
      $new_line['label4']       = isset($new_line['label4']) ? $new_line['label4'] : '';
      $new_line['label5']       = isset($new_line['label5']) ? $new_line['label5'] : '';
      $new_line['label33']       = isset($new_line['label33']) ? $new_line['label33'] : '';
      $new_line['label44']       = isset($new_line['label44']) ? $new_line['label44'] : '';
      $new_line['label55']       = isset($new_line['label55']) ? $new_line['label55'] : '';
			$new_line['more_text']   = isset($new_line['more_text']) ? $new_line['more_text'] : 'Read More';
			$new_line['excerpt']     = isset($new_line['excerpt']) ? $new_line['excerpt'] : '';	
			$new_line['button_link'] = isset($new_line['button_link']) ? $new_line['button_link'] : '';	
			$new_accordion_value[]   = $new_line;
	   }  		

  		$list .='<div class="rs-staff '.$css_class.'">
					<ul class="staff-section">';
					foreach($new_accordion_value as $accordion):
						$readon = '';
            $acc_screenshot = '';
            if(isset($accordion['screenshots']) && !empty($accordion['screenshots']) ) {
                $acc_screenshot = $accordion['screenshots'];
            }
						if(!empty($attributes)){
							$readon = '<a class="service-readon" '.$accordion['button_link'].' data-onhovercolor="#222" ><span>'.$accordion['more_text'].'</span></a>';
						}
					$list .='<li class="rs-staff-area">
						<div class="staff-item">	
    						<div class="service-img">
    							<img src="'.$acc_screenshot.'" alt="">
    						</div>
    						<div class="staff-desc">
                                <div class="inner-desc">
                                    <h3 class="staff-title">'.$accordion['label'].'</h3>
                                    <h4 class="staff-sub">'.$accordion['label2'].'</h4>
                                    <span class="sub1"><i>'.$accordion['label3'].'</i>'.$accordion['label33'].'</span>							
                                    <span class="sub2"><i>'.$accordion['label4'].'</i>'.$accordion['label44'].'</span>                         
                                    <span class="sub3"><i>'.$accordion['label5'].'</i>'.$accordion['label55'].'</span>                         
        							<p>'.$accordion['excerpt'].'</p>
    						    </div>
                            </div>
			            </div>
				    </li>';
				endforeach;
			$list .='</ul>
		</div>';		
		
		return $list;
		wp_reset_query();						
	}
add_shortcode( 'rs_staff', 'rs_staff_html' );
 