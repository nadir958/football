<?php
/*
Element Description: Header Title*/

    // Element Mapping
    function rs_header_title_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        vc_map( 
            array(
                'name' => __('RS Header Title', 'mifo'),
                'base' => 'rs_header_title',
                'description' => __('RS header title box', 'mifo'), 
                'category' => __('by RS Theme', 'mifo'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(   
	                array(
	                	"type" => "dropdown",
	                	"heading" => __("Select Title Tag", "exposter"),
	                	"param_name" => "title_tag",
	                	"value" => array(
	                		__("H1", "exposter") => 'h1',                
	                		__("H2", "exposter") => 'h2',                
	                		__("H3", "exposter") => 'h3',                
	                		__("H4", "exposter") => 'h4',                
	                		__("H5", "exposter") => 'h5',                
	                		__("H6", "exposter") => 'h6',                
	                	),
	                	'std' => 'h2',						
	                	'description' => __( 'Set your main title tag here', 'mifo' ),
	                ),
					array(
						'type' => 'textfield',
						'heading' => __( 'Title', 'mifo' ),
						'param_name' => 'title',
						'value' => __( '', 'mifo' ),
						'description' => __( 'Heading title area', 'mifo' ),
						'admin_label' => false,
						'weight' => 0,
					   
					),
					array(
						'type'        => 'textarea',
						'heading'     => __( 'Content Text', 'mifo' ),
						'param_name'  => 'introtext',
						'value'       => __( '', 'mifo' ),
						'description' => __( 'Type your content here', 'mifo' ),                   
					),
					 array(
	                	"type" => "dropdown",
	                	"heading" => __("Select Content Tag", "exposter"),
	                	"param_name" => "content_tag",
	                	"value" => array(
	                		__("H1", "exposter") => 'h1',                
	                		__("H2", "exposter") => 'h2',                
	                		__("H3", "exposter") => 'h3',                
	                		__("H4", "exposter") => 'h4',                
	                		__("H5", "exposter") => 'h5',                
	                		__("H6", "exposter") => 'h6',
	                		__("P", "exposter") => 'p',                  
	                	),
	                	'std' => 'h4',						
	                	'description' => __( 'Set your main title tag here', 'mifo' ),
	                ),
					array(
						"type" => "dropdown",
						"heading" => __("Alignment", "exposter"),
						"param_name" => "align",
						"value" => array(
							__("Left", "exposter")   => 'left',
							__("Center", "exposter") => 'center',
							__("Right", "exposter")  => 'right',
						),						
						'description' => __( 'Select content alignment here', 'mifo' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Button Text', 'mifo' ),
						'param_name'  => 'read_more',
						'description' => __( 'Set your button text here. Leave empty if you no need', 'mifo' ),
						'group'       => 'Button',
					),
					array(
						'type' => 'vc_link',
						'heading' => __( 'URL (Link)', 'mifo' ),
						'param_name' => 'read_more_link',
						'description' => __( 'Add link to button.', 'mifo' ),
						'group'       => 'Button',
					),
					array(
						"type" => "dropdown",
						"heading" => __("Button Style", "exposter"),
						"param_name" => "button_style",
						"value" => array(
							'Default' => '',
							'Light' => 'light',
						),						
						'description' => __( 'Select banner button style here', 'mifo' ),
						'group'       => 'Button',
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Title Color", "exposter" ),
						"param_name" => "titlecolor",
						"value" => '',
						"description" => __( "Choose title color", "exposter" ),
	                    'group' => 'Styles',
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Content Color", "exposter" ),
						"param_name" => "content_color",
						"value" => '',
						"description" => __( "Choose content color", "exposter" ),
	                    'group' => 'Styles',
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'mifo' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'CSS box', 'mifo' ),
						'param_name' => 'css',
						'group' => __( 'Design Options', 'mifo' ),
					),                  
                        
         ),
      )
   );                                
        
}
  
add_action( 'vc_before_init', 'rs_header_title_mapping' );
  
 // Element HTML
function rs_header_title_html( $atts, $content ) {
         
    // Params extraction
    extract(
        shortcode_atts(
            array(
				'title'          => '',
				'title_tag'      => 'h2',					
				'align'          => 'left',					
				'titlecolor'     => '',
				'content_color'  => '',
				'button_style'  => '',
				'el_class'       =>'',
				'css'            => '',
				'introtext'      => '',
				'read_more'      => '',
				'read_more_link' => '',
				'content_tag'    => 'h4'
            ), 
            $atts, 'rs_header_title'
        )
    );


    $read_more_link = ( '||' === $read_more_link ) ? '' : $read_more_link;
    $read_more_link = vc_build_link( $read_more_link );

    $read_use_link = false;
    if ( strlen( $read_more_link['url'] ) > 0 ) {
    	$read_use_link = true;
    	$a_href = $read_more_link['url'];
    	$a_title = $read_more_link['title'];
    	$a_target = $read_more_link['target'];
    }
    
    if ( $read_use_link ) {
    	$read_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
    	$read_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
    	if ( ! empty( $a_target ) ) {
    		$read_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
    	}
    }
    $read_attributes[] = "";

    $read_attributes = ($read_attributes) ? implode( ' ', $read_attributes ) : '';

	
	//for css edit box value extract
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
	
    //custom class added
	$wrapper_classes = array($el_class) ;			
	$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
	$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
	
	$titlecolor = ($titlecolor) ? ' style="color: '.$titlecolor.'"' : '';
	$content_color = ($content_color) ? ' style="color: '.$content_color.'"' : '';
	$read_more = ($read_more) ? '<a '.$read_attributes.' class="readon border smoothPortfolio">'.$read_more.'</a>' : '';
	$button_style = ($button_style) ? ' btn-light' : '';

    // Fill $html var with data
    $html = '<div class="rs-header-title header-'.$align.' '.$css_class.' '.$css_class_custom.'">         
        		<'.$title_tag.' class="title"'.$titlecolor.'>'.$title.'</'.$title_tag.'>';
            	if ($introtext) {
            		$html .= '<'.$content_tag.' class="introtext" '.$content_color.'>'.wp_kses_post( $introtext).'</'.$content_tag.'>';
            	}
                if ($read_more !== '') {
	                $html .= '<div class="header-button'.$button_style.'">
	                    '.$read_more.'
	                </div>';
	            }
    $html .= '</div>';
    return $html;
}
add_shortcode( 'rs_header_title', 'rs_header_title_html' );