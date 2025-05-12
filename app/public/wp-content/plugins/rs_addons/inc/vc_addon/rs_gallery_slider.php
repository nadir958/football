<?php
/*
Element Description: Rs Gallery elements
*/
// Element Mapping

function rs_gallery_mapping() {
	 
	// Stop all if VC is not enabled
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

    $category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );	
    $args = array(
        'taxonomy' => array('gallery-category'),//ur taxonomy
        'hide_empty' => false,                  
    );

	$terms_= new WP_Term_Query( $args );
	foreach ( (array)$terms_->terms as $term ) {
		$category_dropdown[$term->name] = $term->slug;		
	}
	 
	// Map the block with vc_map()
	vc_map( 
		array(
			'name' => __('Rs Gallery Slider', 'rsaddon'),
			'base' => 'rs_gallery',
			'description' => __('Rs Gallery', 'rsaddon'), 
			'category' => __('by RS Theme', 'rsaddon'),   
			'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',    
			'params' => array(
                array(
					"type" => "dropdown_multi",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'rsaddon' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
				),

				array(
					"type" => "dropdown",
					"heading" => __("Show Filter", "rsaddon"),
					"param_name" => "show_filter",
					"value" => array(					    						
						'Yes' => "Yes", 
						'No' => "No",																
					),
				),

				array(
					"type" => "dropdown",
					"heading" => __("Filter Alignment", "rsaddon"),
					"param_name" => "filter_align",
					"value" => array(
                        'Center' => "Center",		
						'Left' 	 => "Left", 
						'Right'	 => "Right", 
																				
					),
					"dependency" => Array('element' => 'show_filter', 'value' => array('Yes')),						
				),

                array(
					"type" => "dropdown",
					"heading" => __("Gutter Gap", "rsaddon"),
					"param_name" => "gutter",
					"value" => array(							    						
						'Yes' => "", 
						'No'  => "no",
					),						
				),

				array(
					"type" => "dropdown",
					"heading" => __("Show Zoom Icon", "rsaddon"),
					"param_name" => "show_zoom",
					"value" => array(							    						
						'No'  => "",
						'Plus Icon' => "glyph-icon flaticon-add-circular-button", 
						'Arrow Icon' => "fa fa-arrows-alt", 
					),						
				),

				array(
						"type" => "dropdown",
						"heading" => __("Gallery Order", "rs-addon"),
						"param_name" => "order_type",
						"value" => array(							
							'Descending Order' => "DESC", 
							'Ascending Order' => "ASC"					
						),
						
					),

					array(
						"type" => "dropdown",
						"heading" => __("Order By", "rs-addon"),
						"param_name" => "orderby",
						"value" => array(
							'Post Date'  => "date",					
							'Post ID'    => "ID",					
							'Post Title' => "title",					
						),
						
					),


				//option for gallery slider
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'rsaddon' ),
					"param_name" => "col_lg",
					"value" => array(							
						'1' => "1", 
						'2' => "2",
						'3' => "3",	
						'4' => "4",
						'5' => "5",
						'6' => "6",																						
					),
					"std" => "3",
					"group" 	  => __( "Slider Options", 'rsaddon' ),
				
				),
				
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops < 991px )", 'rsaddon' ),
					"param_name" => "col_md",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "3",
					"group" 	  => __( "Slider Options", 'rsaddon' ),
				
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets < 767px )", 'rsaddon' ),
					"param_name" => "col_sm",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "3",
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 480px )", 'rsaddon' ),
					"param_name" => "col_xs",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "2",
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 350px )", 'rsaddon' ),
					"param_name" => "col_mobile",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "1",
					"group" 	  => __( "Slider Options", 'rsaddon' ),
					
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
					
				),

				array(
					"type" => "dropdown",
					"heading" => __("Slider Dots", "rsaddon"),
					"param_name" => "slider_dots",
					"value" => array(							    						
						__( "Enable", "rsaddon" )  => 'true',
						__( "Disable", "rsaddon" ) => 'false', 
					),
					"group" 	  => __( "Slider Options", 'rsaddon' ),						
				),

				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'rsaddon' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 2000,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'rsaddon' ),
					"group" 	  => __( "Slider Options", 'rsaddon' ),
				
				),
				//end option for gallery slider

				array(
					'type' => 'textfield',
					'holder' => 'h3',						
					'heading' => __( 'Filter Default Title', 'rsaddon' ),
					'param_name' => 'filter_title',
					'value' => __( '', 'rsaddon' ),
					'description' => __( 'You can add here filter default title (ex: All Projects)' ),
					'admin_label' => false,
					'weight' => 0,
					'value' => 'All',
					"dependency" => Array('element' => 'show_filter', 'value' => array('Yes')),
				   
				),
				array(
					'type' => 'textfield',					
					'heading' => __( 'Gallery Title', 'rsaddon' ),
					'param_name' => 'title',
					'value' => __( '', 'rsaddon' ),
					'description' => __( 'Enter title here', 'rsaddon' ),			   
				),
				array(
					'type' => 'textfield',					
					'heading' => __( 'Gallery Sub Title', 'rsaddon' ),
					'param_name' => 'sub_title',
					'value' => __( '', 'rsaddon' ),
					'description' => __( 'Enter sub title here', 'rsaddon' ),			   
				),
				array(
					'type' => 'textfield',
					'holder' => 'h3',						
					'heading' => __( 'Photo Per Page', 'rsaddon' ),
					'param_name' => 'per_page',
					'value' => __( '', 'rsaddon' ),
					'description' => __( 'How many photo want to show per page', 'rsaddon' ),
					'admin_label' => false,
					'weight' => 0,
					'value' => '8'				   
				),
				array(
					"type" => "dropdown",
					"heading" => __("How many Column ", "rsaddon"),
					"param_name" => "column",
					"value" => array(
						'Two' => "Two",
						'Three' => "Three",
						'Four' => "Four", 
					),
					'std' => "Three", 
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
		 )
		)
	);                                
	
}
     
 add_action( 'vc_before_init', 'rs_gallery_mapping' );
     
    // Element HTML
   function rs_gallery_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'per_page'              => '8',
					'column'                =>'Three',
					'cat'                   => '',
					'title'                 => '',
					'sub_title'             => '',
					'order_type'            => 'DESC',	
					'orderby'               => 'date',
					'col_lg'                => '4',
					'col_md'                => '3',
					'col_sm'                => '3',
					'col_xs'                => '2',
					'col_mobile'            => '1',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_dots'           => 'true',
					'slider_autoplay_speed' => '2000',
					'el_class'              => '',
					'cat'                   => '',
					'filter_align'          => 'center',
					'gutter'                => '',
					'show_filter'           => '',
					'show_category'         => 'yes',
					'filter_title'          =>  'All',
					'show_zoom'             =>  '',
					'css'                   => ''
                ), 
                $atts,'rs_gallery'
           )
        );
		
		$gutter_gap = '';
		$gutter_gap = ($gutter !== '') ? ' no-gutters' : '';

		$taxonomy = '';

		$col_grid='';
		$col_group='';
		$col_full='';
		$col_filter='';
		$col_grid=$column;
		
		if($col_grid =='Two'){
			$col_group = 6;
		}
		if($col_grid =='Three'){
			$col_group = 4;
		}
		
		if($col_grid == 'Four'){
			$col_group = 3;
		}
		
		if($col_grid == 'Full'){
			$col_group=3;
			$col_full='full-grid';		
			$col_filter='col-filter';		
		}
	  
	   //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
		
	
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		$all_project = $filter_title;

		$gallery_item_data = array( 
			'slidesToShow'    => $col_lg,
			'autoplay'        => ( $slider_autoplay === 'true' ) ? true : false,
			'autoplaySpeed'   => $slider_autoplay_speed,
			'pauseOnHover'    => ( $slider_stop_on_hover === 'true' ) ? true : false,
			'slider_dots'     => ( $slider_dots === 'true' ) ? true : false,
			'col_lg'          => $col_lg,
			'col_md'          => $col_md,
			'col_sm'          => $col_sm,
			'col_xs'          => $col_xs,
			'col_mobile'      => $col_mobile,	
		);
		wp_localize_script( 'khelo-main', 'gallery_item_data', $gallery_item_data );   

		$html = '<div class="rs-gallery '.$css_class.' '.$css_class_custom.'">';

				$html .= '<div class="gallery-carousel">';

			        $arr_cats=array();
			        $arr= explode(',', $cat);
						for ($i=0; $i < count($arr) ; $i++) { 
			           	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
			           	// if(is_object($cats)):
			           	$arr_cats[]= $arr[$i];
			           	//endif;
			        }
			        if(empty($cat)){
			        	$best_wp = new wp_Query(array(
								'post_type'      => 'gallery',
								'orderby'        => $orderby,
								'order'          => $order_type,
								'posts_per_page' =>$per_page,
								
						));	  
			        }else{
					   	$best_wp = new wp_Query(array(
							'post_type'      => 'gallery',
							'orderby'        => $orderby,
							'order'          => $order_type,
							'posts_per_page' =>$per_page,
							'tax_query'      => array(
						        array(
						            'taxonomy' => 'gallery-category',
						            'field' => 'slug', //can be set to ID
						            'terms' => $arr_cats//if field is ID you can reference by cat/term number
						        ),
						    )
						));
					}	

					while($best_wp->have_posts()): $best_wp->the_post();

						$termsArray = get_the_terms( $best_wp->ID, "gallery-category" );  //Get the terms for this particular item
						$termsString = ""; //initialize the string that will contain the terms
						foreach ( $termsArray as $term ) { // for each term 
							$termsString .= 'filter_'.$term->slug.' '; //create a string that has all the slugs 
						}

					   $post_title= get_the_title($best_wp->ID);					
					   $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');

					   $show_zoom = ($show_zoom) ? $show_zoom : '';
							
						$html .='
							<div class="gallery-item grid-item">';

								if ($show_zoom != '') {
									
									$html .='<a class="image-popup zoom-icon" href="'.$post_img_url.'" title="'.$post_title.'">
		            						<i class="'.$show_zoom.'"></i>
		            					</a>';
								}


								$html .='
									<img src="'.$post_img_url.'" alt="'.$post_title.'">
							</div>';
					endwhile; 
					wp_reset_query();
		$html .='</div></div>';

 return $html; 
}
add_shortcode( 'rs_gallery', 'rs_gallery_html' );