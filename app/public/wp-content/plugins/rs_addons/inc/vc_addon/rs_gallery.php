<?php
/*
Element Description: Rs Gallery elements
*/
// Element Mapping

function vc_rsgallery_mapping() {
	 
	// Stop all if VC is not enabled
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	$category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );	
    $args = array(
        'taxonomy' => array('gallery-category'),//ur taxonomy
        'hide_empty' => true,                  
    );

	$terms_= new WP_Term_Query( $args );
	foreach ( (array)$terms_->terms as $term ) {
		$category_dropdown[$term->name] = $term->slug;		
	}
	 
	// Map the block with vc_map()
	vc_map( 
		array(
			'name' => __('Rs Gallery Module', 'rsaddon'),
			'base' => 'vc_rsgallery',
			'description' => __('Rs Gallery Module', 'rsaddon'), 
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
					'type' => 'textfield',					
					'heading' => __( 'Gallery Title', 'rsaddon' ),
					'param_name' => 'title',
					'value' => __( '', 'rsaddon' ),
					'description' => __( 'Enter title here', 'rsaddon' ),
					"dependency" => Array('element' => 'gallery_style', 'value' => array('style2')),				   
				),
			array(
				'type' => 'textfield',					
				'heading' => __( 'Gallery Sub Title', 'rsaddon' ),
				'param_name' => 'sub_title',
				'value' => __( '', 'rsaddon' ),
				'description' => __( 'Enter sub title here', 'rsaddon' ),
				"dependency" => Array('element' => 'gallery_style', 'value' => array('style2')),			   
			),
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
				"type" => "dropdown",
				"heading" => __("Gallery Style", "rsaddon"),
				"param_name" => "gallery_style",
				"value" => array(
                    'Style 1' => "style1",		
					'Style 2' 	 => "style2", 																			
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
				"type" => "dropdown",
				"heading" => __("Show Zoom Icon", "rsaddon"),
				"param_name" => "show_zoom",
				"value" => array(							    						
					'No'  => "",
					'Yes' => "yes", 
				),						
			), 

			array(
				"type" => "dropdown",
				"heading" => __("Images Space", "rsaddon"),
				"param_name" => "images_space",
				"value" => array(							    						
					'No'  => "",
					'Yes' => "spaceing", 
				),						
			), 

			array(
						'type' => 'textfield',
						'holder' => 'h3',						
						'heading' => __( 'Gallery Image Per Page', 'rsaddon' ),
						'param_name' => 'per_page',
						'value' => __( '', 'rsaddon' ),
						'description' => __( 'How many Gallery Image want to show per page', 'rsaddon' ),
						'admin_label' => false,
						'weight' => 0,
						'value' => '6'
					   
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
     
 add_action( 'vc_before_init', 'vc_rsgallery_mapping' );
     
    // Element HTML
   function vc_rsgallery_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'column'        =>'Three',
					'cat'           => '',
					'show_filter'   => '',
					'filter_align'  => 'center',
					'order_type'    => 'DESC',	
					'orderby'       => 'date',
					'filter_title'  => 'All',
					'per_page'      =>'6',
					'gallery_style' =>'style1',
					'title'         => '',
					'sub_title'     => '',
					'show_zoom'     =>  '',
					'images_space'  =>  'space-none',
					'el_class'      => '',					
					'css'           => ''            
                ), 
                $atts,'vc_rsgallery'
           )
        );
	
   
	  
	   //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
		
	
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
        //******************//
        // query post
        //******************//

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
		}

		//custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
		
	
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		$all_project = $filter_title;
		
		$html='<div class="rs-galleys '.$css_class.' '.$gallery_style.' '.$images_space.' '.$css_class_custom.'">';

				if($show_filter !='No'):
				    $html .= '<div class="portfolio-filter  filter-'.strtolower($filter_align).'">
				                <button class="active" data-filter="*">'.$all_project.'</button>'; 
				                $taxonomy = "gallery-category";
				                $arr= explode(',', $cat);

								for ($i=0; $i < count($arr) ; $i++) { 
				               	 $cats = get_term_by('slug', $arr[$i], $taxonomy);

				               	 if(is_object($cats)):
				               	 	$slug= '.filter_'.$cats->slug;

				               	 	$html .= '<button data-filter="'.$slug.'">'.$cats->name.'</button>';	
				               	 endif;
				               }			

				            
				    $html .=' </div>'; 
				endif;    

				if ($title !== '' || $sub_title !== '') {
					$html .= '<div class="gallery-desc">';
						if ($title) {
		                	$html .= '<h2 class="title">'.$title.'</h2>';
						}
						if ($sub_title) {
			                $html .= '<h3 class="sub-title">'.$sub_title.'</h3>';
			            }
		            $html .= '</div>';
				}

				$arr_cats=array();
		        $arr= explode(',', $cat);
					for ($i=0; $i < count($arr) ; $i++) { 
		           	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
		           	// if(is_object($cats)):
		           	$arr_cats[]= $arr[$i];
		           	//endif;
		        } 
			   	$best_wp = new wp_Query(array(
					'post_type' => 'gallery',
					'orderby'        => $orderby,
					'order'          => $order_type,
					'posts_per_page' =>$per_page,
					'tax_query' => array(
				        array(
				            'taxonomy' => 'gallery-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    )
				));

				if(empty($cat)){
		        	$best_wp = new wp_Query(array(
						'post_type' => 'gallery',
						'orderby'        => $orderby,
						'order'          => $order_type,
						'posts_per_page' =>$per_page,						
					));	  
		        } 


				$html .= '<div id="rs-galleys" class="row grid gallery-grid">';				
				
				$show_zoom_yes = ($show_zoom != '') ? ' show-zoom-yes' : '';  

				while($best_wp->have_posts()): $best_wp->the_post();
					$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
					$post_title= get_the_title($best_wp->ID);


					$termsArray = get_the_terms( $best_wp->ID, "gallery-category" );  //Get the terms for this particular item
					$termsString = ""; //initialize the string that will contain the terms
					foreach ( $termsArray as $term ) { // for each term 
						$termsString .= 'filter_'.$term->slug.' '; //create a string that has all the slugs 
					}

				   $post_title= get_the_title($best_wp->ID);					
				   $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');

				if($gallery_style=='style2'){
					$html .='<div class="col-md-'.$col_group.' col-sm-6 '.$termsString.' grid-item gallery-space"> <div class="galley-img">';

						if ($show_zoom != '') {
											
							$html .='<a class="image-popup zoom-icon" href="'.$post_img_url.'" title="'.$post_title.'">
		    						<i class="glyph-icon flaticon-add-circular-button" aria-hidden="true"></i>
		    					</a>';
						}

						$html .='					
							<a class="img-wrap" href="'.$post_img_url.'">
								<img src="'.$post_img_url.'" alt="'.$post_title.'">
							</a>
					</div>';
				} else {

					$html .='<div class="col-lg-'.$col_group.' '.$termsString.' col-md-6 col-sm-6 grid-item gallery-space"> <div class="galley-img">';

						if ($show_zoom != '') {
											
							$html .='<a class="image-popup zoom-icon" href="'.$post_img_url.'" title="'.$post_title.'">
		    						<i class="glyph-icon flaticon-add-circular-button" aria-hidden="true"></i>
		    					</a>';
						}

						$html .='
							<img src="'.$post_img_url.'" alt="'.$post_title.'">
								<h5 class="p-title">'.$post_title.'</h5>
					</div>';
				}
				$html .='</div>';
				endwhile; 
				wp_reset_query();
			$html .='</div>';

	$html .='</div>';
 return $html; 
}
add_shortcode( 'vc_rsgallery', 'vc_rsgallery_html' );