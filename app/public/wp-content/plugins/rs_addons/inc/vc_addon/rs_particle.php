<?php
/*
Element Description: Rs Custom particle*/

    // Element Mapping
    function vc_particle_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs particle', 'appone'),
                'base' => 'vc_particle',
                'description' => __('Rs particle', 'appone'), 
                'category' => __('by RS Theme', 'appone'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(   
                         
			array(
				'type' => 'textfield',
				'holder' => 'h3',
				'class' => 'title-class',
				'heading' => __( 'Title', 'appone' ),
				'param_name' => 'title',
				'value' => __( '', 'appone' ),
				'description' => __( 'particle title area', 'appone' ),
				'admin_label' => false,
				'weight' => 0,
			   
			),  
			 
			array(
				'type' => 'textfield',
				'holder' => 'h4',
				'class' => 'text-class',
				'heading' => __( 'Subtitle', 'appone' ),
				'param_name' => 'text',
				'value' => __( '', 'appone' ),
				'description' => __( 'Sub title text here', 'appone' ),
				'admin_label' => false,
				'weight' => 0,                        
			),	

			array(
				'type' => 'textarea_html',
				'holder' => 'h4',
				'class' => 'text-class',
				'heading' => __( 'Text', 'appone' ),
				'param_name' => 'description',
				'value' => __( '', 'appone' ),
				'description' => __( 'Description text here', 'appone' ),
				'admin_label' => false,
				'weight' => 0,                        
			),	

			array(
                'type' => 'textfield',
                'holder' => 'h4',
                'class' => 'prt-btn',
                'heading' => __( 'Button Text', 'appone' ),
                'param_name' => 'prt_btn',
                'value' => __( '', 'appone' ),
                'description' => __( 'Tag line button text here', 'appone' ),
                'admin_label' => false,
                'weight' => 0,                        
            ),	

            array(
				'type' => 'vc_link',
				'heading' => __( 'URL (Link)', 'appone' ),
				'param_name' => 'prt_link',
				'description' => __( 'Add link to button.', 'appone' ),
				// compatible with btn2 and converted from href{btn1}
			),

            array(
                'type' => 'textfield',
                'holder' => 'h4',
                'class' => 'prt-btn',
                'heading' => __( 'Button Text', 'appone' ),
                'param_name' => 'prt_btn2',
                'value' => __( '', 'appone' ),
                'description' => __( 'Tag line button text here', 'appone' ),
                'admin_label' => false,
                'weight' => 0,                        
            ),	
			
			array(
				'type' => 'vc_link2',
				'heading' => __( 'URL (Link)', 'appone' ),
				'param_name' => 'prt_link2',
				'description' => __( 'Add link to button.', 'appone' ),
				// compatible with btn2 and converted from href{btn1}
			),
			
			 array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'appone' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'appone' ),
			),		
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __( "Title color", "appone" ),
				"param_name" => "titlecolor",
				"value" => '#333333', //Default Red color
				"description" => __( "Choose title color", "appone" ),
				'admin_label' => false,
				'weight' => 0,
				'group' => 'Style',
			 ),
			 
			 array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __( "Subtitle color", "appone" ),
				"param_name" => "subcolor",
				"value" => '#212121', //Default Red color
				"description" => __( "Choose subtitle color", "appone" ),
				'admin_label' => false,
				'weight' => 0,
				'group' => 'Style',
			 ),                     
						
			array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'appone' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'appone' ),
			),                  
                        
         ),
      )
   );                                
        
}
  
add_action( 'vc_before_init', 'vc_particle_mapping' );
  
 // Element HTML
 function vc_particle_html( $atts,$content ) {
 	 	$attributes = array();

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
					'titlecolor' => '',
					'subcolor' => '',
					'prt_btn' => '',
					'prt_link' => '',
					'prt_btn2' =>'',
                    'text' => '',                    
                    'description' => '',                    
					'font_heading_container' => '',
					'el_class' =>'',
					'css' => ''
                ), 
                $atts, 'vc_particle'
            )
        );
		
		//for css edit box value extract
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );


		//extract content

		if(!empty($content)) {
			$atts['content'] = $content;
		} else {
			$atts['content'] = ''; 
		}
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		//parse link for vc link		
		$prt_link = ( '||' === $prt_link ) ? '' : $prt_link;
		$prt_link = vc_build_link( $prt_link );
		$use_link = false;
		if ( strlen( $prt_link['url'] ) > 0 ) {
			$use_link = true;
			$a_href = $prt_link['url'];
			$a_title = $prt_link['title'];
			$a_target = $prt_link['target'];
		}
		
		if ( $use_link ) {
			$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
			$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
			if ( ! empty( $a_target ) ) {
				$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
			}
		}
		$attributes = implode( ' ', $attributes );
		
         //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
  
         
        // Fill $html var with data
        $html = '

        <div id="particles-js" class="particles-section'.$css_class.' '.$css_class_custom.'">
        <div class="inner">        
            <h4 style="color:'.$titlecolor.'">'.esc_attr($title).'</h4>             
            <h3 style="color:'.$subcolor.'">'.esc_attr($text).'</h3> 
         	<p>'.esc_attr($description).'</p>
         	<ul class="particle-btn">
         		<li><a ' . $attributes . ' class="slider-bg-btn">'.$prt_btn.'</a></li>
         		<li><a ' . $attributes . ' class="border-btn">'.$prt_btn2.'</a></li>
         	</ul>      
        </div>
        </div>';  	
         
        return $html;
         
    }
add_shortcode( 'vc_particle', 'vc_particle_html' );