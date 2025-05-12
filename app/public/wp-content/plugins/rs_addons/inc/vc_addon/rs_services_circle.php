<?php
/*
Element Description: Rs Addon 
*/
 if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
}
    // Element Mapping
     function vc_RsServices_circle_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs Service Cricle Box', 'rubrash'),
                'base' => 'vc_RsServices_Circle',
                'description' => __('Rs Service Box Information', 'rubrash'), 
                'category' => __('by RS Theme', 'rubrash'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(
		    
		    array(
		      'type' => 'param_group',
		      'param_name' => 'values',
		      'params' => array(
		      	array(
					'type' => 'iconpicker',
					'heading' => __( 'Service Icon', 'rubrash' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-users', // default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),					
					'description' => __( 'Select icon from library.', 'rubrash' ),
					"dependency" => Array('element' => 'service_style', 'value' => array('Style 1')),
				),

			
					
		        array(
		          'type' => 'textfield',
		          'name' => 'label',
		          'heading' => __('Heading', 'rubrash'),
		          'param_name' => 'label',
		        ),
		        array(
		          'type' => 'textarea',
		          'name' => 'Content',
		          'heading' => __('Content', 'rubrash'),
		          'param_name' => 'excerpt',
		        )
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
     
  add_action( 'vc_before_init', 'vc_RsServices_circle_mapping' );
     
    // Element HTML
    function vc_RsServices_circle_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(					
					'values'           => '',
					'css' =>'',
					
                ), 
                $atts,'vc_RsServices_Circle'
            )
        );     

        //for css edit box value extract
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
        $list ='';      
		$values = vc_param_group_parse_atts($atts['values']);
		$new_accordion_value = array();
		foreach($values as $data){
		$new_line = $data;
		$new_line['icon'] = isset($new_line['icon_fontawesome']) ? esc_attr($new_line['icon_fontawesome']) : 'fa fa-users';
		$new_line['label'] = isset($new_line['label']) ? $new_line['label'] : '';
		$new_line['excerpt'] = isset($new_line['excerpt']) ? $new_line['excerpt'] : '';		
		$new_accordion_value[] = $new_line;}
		

  		$idd = 1;

  		$list .='<div class="rs-services '.$css_class.'">
  					<div class="services-details fix">
  						<ul>';
					  		foreach($new_accordion_value as $accordion):
					  			if( $idd == 1 ):
									$active_li = 'active';
								else:
									$active_li = '';
								endif;

								if( $idd == 1){

									$br = 'br-10';
								}
								elseif($idd == 3){
									$br = 'br-10 bt-10';
								}
								elseif($idd == 4){
									$br = 'bt-10';
								}
								else{
									$br ='';
								}
								$list .='<li class="single-services text-center  '.$br.' '.$active_li .'" data-toggle="pill">
								<a data-toggle="pill" href="#text'.$idd.'">
									<div class="display-table">
										<div class="display-table-cell">
											<i class="'.$accordion['icon'].'
" aria-hidden="true"></i>
											<h4>'.$accordion['label'].'
</h4>
										</div>
									</div>
								</a>
							</li>';
							$idd++;
							endforeach;
						$list .='</ul>

						<div class="middle-content tab-content text-center">';
						$x=1;
						foreach($new_accordion_value as $accordion2):
							if( $x == 1 ):
								$active = 'active in';
							else:
								$active = '';
							endif;
						$list .='<div id="text'.$x.'" class="tab-pane fade single-conent '. $active .'">
								<div class="display-table">
									<div class="display-table-cell">
										 '.$accordion2['excerpt'].'
										 <i class="'.$accordion2['icon'].'
 watermark-circle" aria-hidden="true"></i>
									</div>
								</div>
							</div>';
							$x++;
							endforeach;
						$list .='</div>
					</div>
				</div>';		
		
		return $list;
		wp_reset_query();						
	}
add_shortcode( 'vc_RsServices_Circle', 'vc_RsServices_circle_html' );
 