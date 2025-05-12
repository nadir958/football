<?php
/*
Element Description: Grassy Portfolio Box
*/
     // Element Mapping
    function vc_service_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        
        $category_dropdown = array( __( 'All Services', 'medkom' ) => '0' );	
        $args = array(
            'taxonomy' => array('service-category'),//ur taxonomy
            'hide_empty' => false,                  
        );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_dropdown[$term->name] = $term->slug;		
		}

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Services Grid', 'medkom'),
                'base' => 'vc_service',
                'description' => __('Service Box Information', 'medkom'), 
                'category' => __('by RS Theme', 'medkom'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                    array(
                    	"type" => "dropdown",
                    	"heading" => __("Service Style", "medkom"),
                    	"param_name" => "service_style",
                    	"value" => array(		
                    		__("Style 1", "medkom") => "1",
                    		__("Style 2", "medkom") => "2",
                    		__("Style 3", "medkom") => "3",
                    		__("Style 4", "medkom") => "style4",
                    	),
                    	"description" => __("Select your Services style here", "medkom"),                    	
                    ),

                    array(
						"type" => "dropdown",
						"heading" => __("Show title", "medkom"),
						"param_name" => "title",
						"value" => array(							    						
							'Yes' => "Yes", 
							'No' => "No",
						),	
						"dependency" => Array('element' => 'service_style', 'value' => array('1','2','3')),					
					),

                    array(
						"type" => "dropdown",
						"heading" => __("Show Category", "medkom"),
						"param_name" => "category_show",
						"value" => array(							    						
							'Yes' => "Yes", 
							'No' => "No",
						),
						"dependency" => Array('element' => 'service_style', 'value' => array('1','2','3')),						
					),
                    array(
						"type" => "dropdown_multi",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Categories", 'medkom' ),
						"param_name" => "cat",
						'value' => $category_dropdown,
					),

					array(
						'type' => 'textfield',
						'holder' => 'h3',						
						'heading' => __( 'Services Per Page', 'medkom' ),
						'param_name' => 'per_page',
						'value' => __( '', 'medkom' ),
						'description' => __( 'How many project want to show per page', 'medkom' ),
						'admin_label' => false,
						'weight' => 0,
						'value' => '9'
					   
					),  
					
					array(
						"type" => "dropdown",
						"heading" => __("How many Column ", "medkom"),
						"param_name" => "column",
						"value" => array(							    						
							
							'Two' => "Two",
							'Four' => "Four", 
							'Three' => "Three",
							'Full' => "Full",
						),
						
					),

					array(
						"type"       => "dropdown",
						"heading"    => __("Show ReadMore", 'rsaddon'),
						"param_name" => "readmore",
						"value"      => array(
							'Yes' => "Yes",
							'No' => "No",
						),	
						"dependency" => Array('element' => 'service_style', 'value' => array('1','2','3')),					
					),	

					array(
						"type" => "textfield",
						"heading" => __("Read More Text", 'rsaddon'),
						"param_name" => "more_text",
						'description' => __( 'Type your read more text here', 'rsaddon' ),
						"dependency" => Array('element' => 'readmore_type', 'value' => array('rm_text', '1','2','3')),
						"dependency" => Array('element' => 'service_style', 'value' => array('1','2','3')),	
					),											 				
				  
					array(
						'type' => 'colorpicker',
						'heading' => __( 'Icon color', 'medkom' ),
						'param_name' => 'color',
						"value" => '#ffffff', //Default color
						"description" => __( "Choose color", "medkom" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					),		
							
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Title color", "medkom" ),
						"param_name" => "titlecolor",
						"value" => '#ffffff', //Default color
						"description" => __( "Choose color", "medkom" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					 ),					  
							 
				  array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'medkom' ),
					),
					
					array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'medkom' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'medkom' ),
				),            
                        
                ),
				
					
            )
        );                                
        
    }
     add_action( 'vc_before_init', 'vc_service_mapping' );
     
    // Element HTML
     function vc_service_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'            => '',	
					'category_show'    => '',	
					'service_style'  => '1',
					'titlecolor'       => '',
					'column'           =>'',
					'per_page'         => '9',
					'el_class'         => '',
					'color'            => '',
					'css'              => '',
					'cat'              => '',
					'readmore'              => 'Yes',
					'more_text'             => 'Read More',
					
                ), 
                $atts,'vc_service'
           )
        );
	
        $a = shortcode_atts(array(
            'screenshots' => 'screenshots',
        ), $atts);

        $img = wp_get_attachment_image_src($a["screenshots"], "large");        

        $imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}

        $taxonomy = '';
		
		//extract content

		if(!empty($content)) {
			$main_content = $content;
		} else {
			$main_content = ''; 
		}
		//extact icon 		
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
		 //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
  
		
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
		
        //******************//
        // query post
        //******************//


        $html ='<div class="rs-service-grid rs-service-style'.$service_style.' '.$css_class_custom.' '.$col_filter.'">
		<div class="'.$css_class.'">';
        // Get taxonomy form portfolio
		
        $html .='<div class="row">'; 
        		$cat;
                $arr_cats = array();
                $arr= explode(',', $cat);
					for ($i=0; $i < count($arr) ; $i++) { 
	               	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
	               	// if(is_object($cats)):
	               	$arr_cats[]= $arr[$i];
	               	//endif;
	            }

	      		if(empty($cat)){
		        	$best_wp = new wp_Query(array(
							'post_type' => 'services',
							'posts_per_page' =>$per_page,
							
					));	  
		        }

		        else{
	            
			    $best_wp = new wp_Query(array(
						'post_type' => 'services',
						'posts_per_page' =>$per_page,					
						'tax_query' => array(
					        array(
					            'taxonomy' => 'service-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $arr_cats//if field is ID you can reference by cat/term number
					        ),
					    )
					));
				}	
       			if( $best_wp->have_posts() ): while( $best_wp->have_posts() ) : $best_wp->the_post();
				$termsArray = get_the_terms( $best_wp->ID, "service-category" );  //Get the terms for this particular item
				$termsString = ""; //initialize the string that will contain the terms
				$cats_show = get_the_term_list( $best_wp->ID, 'service-category', ' ', ', ');
			    $post_title = get_the_title($best_wp->ID);
			  
			    if($title!='No'){
			   		 $post_title_show = get_the_title($best_wp->ID);

				}	
				else{
					$post_title_show = '';
				}

			    $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
			    $post_url=get_post_permalink($best_wp->ID); 
			    $post_content=get_the_excerpt(); 
			    $readmore_text = ($readmore == 'Yes') ? '<div class="service-button"><a href="'.$post_url.'" class="readon rs_button">'.$more_text.'</a></div>' : '';

				$paginate = paginate_links( array(
					'total' => $best_wp->max_num_pages
				));	

				if($category_show!='No'){
			   		$cats_show = get_the_term_list( $best_wp->ID, 'service-category', ' ', ', ');

				}	
				else{
					$cats_show = '';

				}
				if('style4'==$service_style){		
				$html .='
						<div class="col-lg-'.$col_group.' '.$col_full.' col-md-6 grid-item mb-30 '.$termsString.'">
	                    <a href="'.$post_url.'"><div class="service-item-four content-overlay">
	                        <div class="service-img">
	                        <img src="'.$post_img_url.'" alt="'.$post_title.'" />
		                        <div class="service-content">';
			                        $html .='<h3 class="p-title">
			                        	'.$post_title_show.'</h3>

		                        	<div class="service-excerpt">
			                        	<p class="excerpt-content">'.$post_content.'</p>
		                            </div>
		                        </div>
		                    </div>
	                    </div>
	                    </a>
	                </div>
					';
	            }

	            else{

	            	$html .='
	            	<div class="col-lg-'.$col_group.' '.$col_full.' col-md-6 grid-item mb-30 '.$termsString.'">
	                    <div class="service-item content-overlay">
	                        <div class="service-img">

	                        	<img src="'.$post_img_url.'" alt="'.$post_title.'" />';                                
	                        	$html .='<h3 class="p-title">
	                        	<span class="show_cate_ser">'.$cats_show.'</span>
	                        	<a href="'.$post_url.'">'.$post_title_show.'</a></h3>';

	                        $html .='</div>

	                        <div class="service-content">
	                        	<div class="service-excerpt">
		                        	<p class="excerpt-content">'.$post_content.'</p>
		                            '.$readmore_text.'
	                            </div>
	                        </div>
	                    </div>
	                </div>
					';
	            }
					
						endwhile; 
				wp_reset_query();
			endif;
			
		$html .= '</div>
		</div>
		</div>';		
	  return $html; 
    }

add_shortcode( 'vc_service', 'vc_service_html' );  