<?php
/*
Element Description: Rs Popular Post*/
    
    // Element Mapping
     function rs_breaking_news() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }  

        $categories = get_categories();
		$category_dropdown = array( 'All Categories' => '0' );

		foreach ( $categories as $category ) {
			$category_dropdown[$category->name] = $category->slug;
		} 

          
        // Map the block with vc_map()
        vc_map( 
            array(
				'name'        => __('RS Breaking News', 'rsaddon'),
				'base'        => 'rs_breaking_news',
				'description' => __('Blog Module', 'rsaddon'), 
				'category'    => __('by RS Theme', 'rsaddon'),   
				'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
				'params'      => array(	

					array(
						"type"       => "textfield",
						"heading"    => __("Breaking News Title", 'rsaddon'),
						"param_name" => "breaking_title",
						'description' => __( 'Type Breaking News Title', 'rsaddon' ),	
					),

		            array(
						"type"       => "dropdown",
						"heading"    => __("Show title", 'rsaddon'),
						"param_name" => "title",
						"value"      => array(				    						
							'Yes' => "Yes", 
							'No'  => "No",											
						),						
					),
					
					array(
						"type" => "textfield",
						"heading" => __("Post Per page", 'rsaddon'),
						"param_name" => "post_per",
						'description' => __( 'Write -1 to show all', 'rsaddon' ),	
						'default'    => 5,									
					),

					array(
						"type"       => "dropdown_multi",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Categories", 'rsaddon' ),
						"param_name" => "cat",
						'value'      => $category_dropdown,
					),
					array(
						"type"       => "dropdown",
						"heading"    => __("Show  Category", 'rsaddon'),
						"param_name" => "blog_cat",
						"value" 	 => array(
							'No'  => "",											
							'Yes' => "yes", 
						),
						"dependency" => Array('element' => 'blog_meta', 'value' => array('yes')),
					),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'rsaddon' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'rsaddon' ) => 'false',
						__( 'Enabled', 'rsaddon' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),					
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Arrow", 'rsaddon' ),
					"param_name" => "slider_nav",
					"value" => array(
						__( 'Disabled', 'rsaddon' ) => 'false',
						__( 'Enabled', 'rsaddon' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),					
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'rsaddon' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "rsaddon" )  => 'true',
						__( "Disable", "rsaddon" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'rsaddon' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "rsaddon" )  => 'true',
						__( "Disable", "rsaddon" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),

				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'rsaddon' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "rsaddon" )  => '5000',
						__( "4 Seconds", "rsaddon" )  => '4000',
						__( "3 Seconds", "rsaddon" )  => '3000',
						__( "2 Seconds", "rsaddon" )  => '4000',
						__( "1 Seconds", "rsaddon" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'rsaddon' ),
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'rsaddon' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'rsaddon' ),
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'rsaddon' ),
					"param_name" => "slider_loop",
					"value" 	 => array(
						__( "Enable", "rsaddon" )  => 'true',
						__( "Disable", "rsaddon" ) => 'false',
					),
					"description"=> __( "Loop to first item. Default: Enable", 'rsaddon' ),
					"group" 	 => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
					),

					array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Each Slider Seprator Gap", 'rsaddon' ),
					"param_name"  => "slider_gap",
					"value" 	  => 20,					
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),


				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Breaking News Title Color", "rsaddon" ),
					"param_name" => "breaking_color",
					"value" => '',
                    'group' => 'Styles',
				), 

				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Breaking Title Padding", "rsaddon" ),
					"param_name" => "breaking_padding",
					"value" => '',
                    'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Breaking News background Color", "rsaddon" ),
					"param_name" => "breaking_bg",
					"value" => '',
                    'group' => 'Styles',
				), 	

				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'rsaddon' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
				),		 
			
				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'rsaddon' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'rsaddon' ),
				),  

                        
                ),			
					
            )
        );                                   
    }
     
  add_action( 'vc_before_init', 'rs_breaking_news' );    
 
     
   function rs_breaking_news_html( $atts, $content ='' ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					
					'title'                 => 'yes',					
					'post_per'              =>  5,	
					'cat'					=> '',									
					'blog_cat'				=> '',									
					'breaking_title'		=> 'Breaking News',									
					'breaking_color'		=> '#ffffff',									
					'breaking_bg'		    => '',									
					'breaking_padding'	    => '9px 0',									
					'css'                   => '',
					'el_class'				=> '',
					'slider_nav'            => 'false',
					'slider_dots'           => 'true',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_autoplay_speed' => '200',
					'slider_loop'           => 'true',				
					
                ), 
                $atts,'rs_breaking_news'
           )
        );

      
	
	
     
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
		//custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

		$owl_data = array( 
			'nav'                => ( $slider_nav === 'true' ) ? true : false,
			'navText'            => array( "<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>" ),
			'dots'               => ( $slider_dots == 'false' ) ? true : false,
			'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
			'autoplayTimeout'    => $slider_interval,
			'stagePadding'       => 12,
			'autoplaySpeed'      => $slider_autoplay_speed,
			'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
			'loop'               => ( $slider_loop === 'true' ) ? true : false,
			'margin'             => 0,
			'stagePadding'       => 0,
			'items'              => 1,		
		);

		$owl_data = json_encode( $owl_data );	
	
		$breaking_style = ($breaking_bg) ? ' style="background: '.$breaking_bg.'"' : '';
		$title_color    = !empty($breaking_color) ? $breaking_color : "";
		$title_padding  = !empty($breaking_padding) ? $breaking_padding : "0px";

		if(!empty($title_color)){
			$breaking_style    = ($breaking_bg) ? ' style="background: '.$breaking_bg.'; padding: '.$title_padding.';  color: '.$title_color.'"' : ' style="color: '.$title_color.';padding: '.$title_padding.';"';
		}


		$html='<div id="breaking-news" class="breaking-news '.$css_class_custom.'">
			<span class="breaking-title" '.$breaking_style.'>'.$breaking_title.'</span>
		<div class="blog-carousel blog-slider owl-carousel owl-navigation-yes" data-carousel-options="'.esc_attr( $owl_data ).'">'
		;                     
		   
	        
		 if( empty($cat) ){
		        	$best_wp = new wp_Query(array(
						'posts_per_page' =>$post_per,
						'order' => 'DESC',
					));	
		        }
		        else{
					$best_wp = new wp_Query(array(
							'posts_per_page' =>$post_per,
							'order' 		 => 'DESC',
							'category_name'  => $cat,			
					));	
		        }   
			
			while($best_wp->have_posts()): $best_wp->the_post();			 
			$post_title_length = get_the_title($best_wp->ID);
			$title_length = strlen($post_title_length);
			if($title_length > 50){
				$post_title = substr($post_title_length, 0, 26).'...';
			}
			else{
				$post_title = get_the_title($best_wp->ID);
			}
		    $post_img_url = '';
			$post_url = get_the_permalink( $best_wp->ID );
			$categories          = get_the_category();

			$blog_cats           = '';
			if ( ! empty( $categories ) ) {
			    $cat_name = esc_html( $categories[0]->name );
			}




			$cate_style = '';
				
			$cate_colors    = get_post_meta(get_the_ID(), 'cate_color', true);
			if(!empty($cate_colors)){
				$cate_style .= "color: {$cate_colors};";
			}
			$cate_colors_bg = get_post_meta(get_the_ID(), 'cate_bg_color', true);
			if(!empty($cate_colors_bg)){
				$cate_style .= "background: {$cate_colors_bg};";
			}

			if('yes'== $blog_cat){
				$blog_cats = '<div class="cate-home " Style="'.$cate_style.'"><span class="category">'.$cat_name.'</span> </div>';
			}

			if( $title){
				$title_show = '<div class="blog-title"><a href="'.$post_url.'"> '.$post_title.' </a></div>' ;
			}
			else{
				$title_show = '';
			}

			$cate_style = '';
					

			$html .='
			<div class="blog-item">
				'.$blog_cats.'
				'.$title_show.'							
		  	</div>';

			endwhile; 
			wp_reset_query();			
		$html .='</div></div>';		  
	return $html; 
}
add_shortcode( 'rs_breaking_news', 'rs_breaking_news_html' );