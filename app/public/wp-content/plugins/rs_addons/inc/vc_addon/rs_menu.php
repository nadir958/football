<?php
/*
Element Description: Rs Services Box
*/
    // Element Mapping
     function vc_RsMenu_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs Menu', 'hepta'),
                'base' => 'vc_RsMenu',
                'description' => __('Menu Information', 'hepta'), 
                'category' => __('by RS Theme', 'hepta'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(   
                         
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Rs Menu ', 'hepta' ),
                        'param_name' => 'title',
                        'value' => __( '', 'hepta' ),
                        'description' => __( 'Rs menu title here', 'hepta' ),
                        'admin_label' => false,
                        'weight' => 0,
                       
                    ),                   
             				
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Menu Description Here", "hepta" ),
						"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a 	"param_name"
						"value" =>'',
						"description" => __( "Duis in mi erat. Phasellus vitae in to lorem vehicula, viverra libero quis, sodalesnulla. Donec at the turpis quis tellus laoreet.", "hepta" )
					 ),
					 
							 
					
					 array(
							"type"        => "attach_image",
							"heading"     => __( "Menu Image", "hepta" ),
							"description" => __( "Add menu image", "hepta" ),
							"param_name"  => "screenshots",
							"value"       => "",							
						),	

					 array(
	                    'type' => 'textfield',
	                    'holder' => 'h3',
	                    'class' => 'title-class',
	                    'heading' => __( 'Price', 'hepta' ),
	                    'param_name' => 'menu_price',
	                    'value' => __( '', 'hepta' ),	                   
	                    'admin_label' => false,
	                    'weight' => 0, 
	                    'value'  => '$5'                  
                	),   

					array(
	                    'type' => 'textfield',
	                    'holder' => 'h3',
	                    'class' => 'title-class',
	                    'heading' => __( 'Button Text', 'hepta' ),
	                    'param_name' => 'btn_title',
	                    'value' => __( '', 'hepta' ),	                   
	                    'admin_label' => false,
	                    'weight' => 0,                   
                	),                
             							
					
									
					
					array(
						'type' => 'vc_link',
						'heading' => __( 'URL (Link)', 'hepta' ),
						'param_name' => 'button_link',
						'description' => __( 'Add link to Serices Pages.', 'hepta' ),						
					),
												
					 
					
					array(
							'type' => 'textfield',
							'heading' => __( 'Extra class name', 'hepta' ),
							'param_name' => 'el_class',
							'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hepta' ),
						),	
					
					array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'hepta' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'hepta' ),
				),            
                        
                ),
				
					
            )
        );                                
        
    }
     
  add_action( 'vc_before_init', 'vc_RsMenu_mapping' );
     
    
    // Element HTML
    function vc_RsMenu_html( $atts,$content ) {

  

         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'            => '',					
					'icon'             => 'Image',					
					'el_class'         =>'',	
					'menu_price'	   =>'$5',	
					'btn_title'		   => '',			
					'button_link'      => '',
					'css'              => ''
                ), 
                $atts,'vc_RsMenu'
            )
        );

	
        $a = shortcode_atts(array(
          'screenshots' => 'screenshots',
        ), $atts);
           
		
		
		//parse link for vc linke		
		$button_link = ( '||' === $button_link ) ? '' : $button_link;
		$button_link = vc_build_link( $button_link );
		$use_link = false;
		if ( strlen( $button_link['url'] ) > 0 ) {
			$use_link = true;
			$a_href = $button_link['url'];
			$a_title = $button_link['title'];
			$a_target = $button_link['target'];
		}
		
		if ( $use_link ) {
			$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
			$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
			if ( ! empty( $a_target ) ) {
				$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
			}
		}
		$attributes = implode( ' ', $attributes );
		
	

		
        $img = wp_get_attachment_image_src($a["screenshots"], "large");

		$imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}

        if(!empty($content)) {
			$main_content = $content;
		} else {
			$main_content = ''; 
		}




        if ($imgSrc) {
			$imageClass='<img src="'.$imgSrc.'" alt="hepta-image" />';
        }else{
        	$imageClass= "";
        }
				
		//extract content


		

		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
		 //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
        $btn_title = $btn_title ? '<span class="order"><a '. $attributes.'>'.$btn_title.'</a></span>' : '';
		
        //checking services style
                
        // Fill $html var with data
		
		$html = '<div class="rs-menu '.$css_class.' '.$css_class_custom.'">

		<div class="item-wrap">
          <div class="col-md-9 col-sm-9 col-xs-9">
              <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 menu-img">
                      <div class="inner-img">
                          '.$imageClass.'
                      </div>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-9 menu-desc">
                      <div class="inner-content">
                          <h3>'.$title.'</h3>
                          '.$main_content.' 
                      </div>
                  </div>
              </div>    
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 menu-price">                                   
              <div class="inner">
                  <span class="price">'.$menu_price.'</span>
                  '.$btn_title.'
              </div>
          </div>
        </div></div>';
  	
  		return $html;

 }
add_shortcode( 'vc_RsMenu', 'vc_RsMenu_html' );
 