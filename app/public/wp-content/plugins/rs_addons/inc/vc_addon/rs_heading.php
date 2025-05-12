<?php
/*
Element Description: Rs Custom Heading*/

    // Element Mapping
    function vc_infobox_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
				'name'        => __('Rs Heading', 'rsaddon'),
				'base'        => 'vc_infobox',
				'description' => __('Rs heading box', 'rsaddon'), 
				'category'    => __('by RS Theme', 'rsaddon'),   
				'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
				'params'      => array(  

	                array(
	                    "type" => "dropdown",
	                    "heading" => __("Select Style", "rsaddon"),
	                    "param_name" => "style",
	                    "value" => array(
							__( 'Default', 'rsaddon')              => '',
							__( 'Border Right', 'rsaddon')         => 'style1',							
							__( 'Border Bottom', 'rsaddon')        => 'style2',							
							__( 'Border Bottom Light', 'rsaddon')  => 'style2 light',							
							__('Border Left', 'rsaddon')           => 'style3',							
							__('Border Left  Vertical', 'rsaddon') => 'style8',							
							__('Border Top Left', 'rsaddon')       => 'style6',							
							__('Border Top Center', 'rsaddon')     => 'style4',							
							__('Border Top Right', 'rsaddon')      => 'style7',	
							__('Heading With Left Icon', 'rsaddon')      => 'heading_icon',							
							__('Heading Image Style', 'rsaddon')   => 'style9',
							__('Heading Bracket Style', 'rsaddon') => 'style5',
							__('Heading Left Rotate Style', 'rsaddon')  => 'style10',
							__('Heading Right Rotate Style', 'rsaddon')  => 'style11',
	                    ),
	                ),

	                array(
	                	"type" => "dropdown",
	                	"heading" => __("Select Title Tag", "rsaddon"),
	                	"param_name" => "title_tag",
	                	"value" => array(
	                		__("H1", "rsaddon") => 'h1',                
	                		__("H2", "rsaddon") => 'h2',                
	                		__("H3", "rsaddon") => 'h3',                
	                		__("H4", "rsaddon") => 'h4',                
	                		__("H5", "rsaddon") => 'h5',                
	                		__("H6", "rsaddon") => 'h6',                
	                	),
	                	'std' => 'h2',						
	                	'description' => __( 'Set your main title tag here', 'mifo' ),
	                ), 
                         
					array(
						'type'        => 'textfield',
						'holder'      => 'h3',
						'class'       => 'title-class',
						'heading'     => __( 'Title', 'rsaddon'),
						'param_name'  => 'title',
						'value'       => __( '', 'rsaddon'),
						'description' => __( 'Heading title area', 'rsaddon'),
						'admin_label' => false,
						'weight'      => 0,					   
					),  
					 
					array(
						'type'        => 'textfield',
						'holder'      => 'h4',
						'class'       => 'text-class',
						'heading'     => __( 'Subtitle', 'rsaddon'),
						'param_name'  => 'sub_text',
						'value'       => __( '', 'rsaddon'),
						'description' => __( 'Sub title text here', 'rsaddon'),
						'admin_label' => false,
						'weight'      => 0,                        
					),

					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __( "Title Uppercase", "rsaddon" ),
						"param_name" => "title_case",
						"value" => '',
						"description" => __( "If checked title will be show in uppercase.", "rsaddon" ),
					),

					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __( "Sub Title Uppercase", "rsaddon" ),
						"param_name" => "subtitle_case",
						"value" => '',
						"description" => __( "If checked sub title will be show in uppercase.", "rsaddon" ),
					),

					array(
						'type'        => 'textfield',
						'heading'     => __( 'Watermark Text', 'rsaddon'),
						'param_name'  => 'watermark',
						'value'       => __( '', 'rsaddon'),
						'description' => __( 'Watermark text here', 'rsaddon'),                   
					),	

					array(
						'type'        => 'textarea_html',
						'heading'     => __( 'Text', 'rsaddon'),
						'param_name'  => 'content',
						'value'       => __( '', 'rsaddon'),
						'description' => __( 'Description text here', 'rsaddon'),                    
					),

					array(
					    "type" => "dropdown",
					    "heading" => __("Select Align", "rsaddon"),
					    "param_name" => "align",
					    "value" => array(
					        __( 'Left', 'rsaddon')   => '',
					        __( 'Center', 'rsaddon') => 'text-center',
					        __( 'Right', 'rsaddon')  => 'text-right',
					    ),
					),


					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Title color", "rsaddon" ),
						"param_name" => "title_color",
						"value" => '',
						"description" => __( "Choose title color", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Sub Text Color", "rsaddon" ),
						"param_name" => "sub_text_color",
						"value" => '',
						"description" => __( "Choose sub text color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Text Color", "rsaddon" ),
						"param_name" => "text_color",
						"value" => '',
						"description" => __( "Choose sub text color here", "rsaddon" ),
		                'group' => 'Styles',
					),


					array(
						"type"        => "attach_image",
						"heading"     => __( "Heading Image", "rsaddon" ),
						"description" => __( "Add Heading image", "rsaddon" ),
						"param_name"  => "headingbg",
						"value"       => "",
						'group' => 'Styles',
						"dependency" => Array('element' => 'style', 'value' => array('style9')),
					),

					array(
					    "type" => "dropdown",
					    "heading" => __("Heading Image Position", "rsaddon"),
					    "param_name" => "image_pos",
					    "value" => array(
					        __( 'Bottom', 'rsaddon') => 'bottom',
					        __( 'Top', 'rsaddon')  => 'top',
					    ),
					    'group' => 'Styles',
						"dependency" => Array('element' => 'style', 'value' => array('style9')),
					),

					array(
						'type'        => 'textfield',
						'heading'     => __( 'Extra class name', 'rsaddon'),
						'param_name'  => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon'),
					),		                     
								
					array(
						'type' => 'css_editor',
						'heading' => __( 'CSS box', 'rsaddon'),
						'param_name' => 'css',
						'group' => __( 'Design Options', 'rsaddon'),
					),                  
                        
         ),
      )
   );                                
        
}
  
add_action( 'vc_before_init', 'vc_infobox_mapping' );
  
// Element HTML
function vc_infobox_html($atts, $content) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'style'          => '',
					'title'          => '',
					'title_tag'      => 'h2',
					'title_case'     => '',
					'subtitle_case'  => '',
					'title_color'    => '',
					'sub_text'       => '',
					'sub_text_color' => '',
					'text_color'     => '',
					'watermark'      => '',
					'description'    => '',
					'align'          => '',
					'headingbg'      => '',
					'image_pos'      => '',
					'el_class'       =>'',
					'css'            => ''
                ), 
                $atts, 'vc_infobox'
            )
        );


        $a = shortcode_atts(array(
          'headingbg' => 'headingbg',
        ), $atts);
        $img = wp_get_attachment_image_src($a["headingbg"], "large");
        $imgSrc = !empty($img) ? $img[0] : '';


		//for css edit box value extract
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
        //custom class added
		$wrapper_classes  = array($el_class) ;			
		$class_to_filter  = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

		$title_color    = ($title_color) ? ' style="color: '.$title_color.'"' : '';
		$sub_text_color = ($sub_text_color) ? ' style="color: '.$sub_text_color.'"' : '';
		$text_color     = ($text_color) ? ' style="color: '.$text_color.'"' : '';
		$title_case = ($title_case=="true") ? 'title-upper' : '';
		$subtitle_case = ($subtitle_case=="true") ? 'title-upper' : '';

		$watermark_text = ($watermark) ? '<span class="watermark">'.wp_kses_post($watermark).'</span>' : '';

		$main_title     = ($title) ? '<'.$title_tag.' class="title '.$title_case.'"'.$title_color.'>'.$watermark_text.''.wp_kses_post($title).'</'.$title_tag.'> <span class="lines-bg"></span>' : '';

		
		if( "style4"==$style || "style4 light"==$style || "style6"==$style || "style6 light"==$style || "style7"==$style || "style7 light"==$style ){
			$sub_text = ($sub_text) ? '<span'.$sub_text_color.' class="sub-text '.$subtitle_case.'">'.wp_kses_post($sub_text).'</span>' : '';
		}

		else{
			$sub_text       = ($sub_text) ? '<span'.$sub_text_color.' class="sub-text '.$subtitle_case.'">'.wp_kses_post($sub_text).'</span>' : '';
		}

		$titleimg  = $imgSrc ? '<img src="'.$imgSrc.'" alt=""/>' : '';
		$topimage = ($image_pos=="top") ? '<div class="title-img top"> '.$titleimg.'</div>' : "";
		$bottomimage = ($image_pos!="top") ? '<div class="title-img bottom-img">'.$titleimg.'</div>' : "";
		$bottom_line = ($topimage) ? 'bottom-line' : "";

		if("style9"==$style){
			$main_title     = ($title) ? '<'.$title_tag.' class="title '.$title_case.'"'.$title_color.'>'.$watermark_text.' '.wp_kses_post($title).'</'.$title_tag.'>' : '';
		}

		$heading_desc = balanceTags($content, true);

		if("style5"==$style){		
			$main_title     = ($title) ? '<'.$title_tag.' class="title '.$title_case.'"'.$title_color.'>'.$watermark_text.'<span class="left">[</span>'.wp_kses_post($title).'<span class="right">]</span></'.$title_tag.'> <span class="lines-bg"></span>' : '';
		}      
        // Fill $html var with data
        $html = '
        <div class="rs-heading '.$style.' '.$css_class.' '.$css_class_custom.' '.$align.'">
        	<div class="title-inner '.$bottom_line.'">
        		'.$topimage.'       		
	            '.$sub_text.'
	            '.$main_title.'
	            '.$bottomimage.'
	        </div>';
	        if ($content) {
            	$html .= '<div class="description" '.$text_color.'>'.$heading_desc.'</div>';
        	}
        $html .= '</div>';  	
         
        return $html;         
    }
add_shortcode( 'vc_infobox', 'vc_infobox_html' );