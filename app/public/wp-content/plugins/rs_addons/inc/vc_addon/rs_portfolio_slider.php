<?php
/*
Element Description: Rs Team Box
*/
     
    // Element Mapping
     function vc_portfolio_slider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        $category_dropdown = array( __( 'All Categories', 'bstart' ) => '0' );	
        $args = array(
                    'taxonomy' => array('portfolio-category'),//ur taxonomy
                    'hide_empty' => false,                  
            );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_dropdown[$term->name] = $term->slug;		
		}

         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs Portfolio Slider', 'bstart'),
                'base' => 'vc_rsPortfolioslider',
                'description' => __('Rs Portfolio Information', 'bstart'), 
                'category' => __('by RS Theme', 'bstart'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                	array(
                		"type" => "dropdown",
                		"heading" => __("Style", 'bstart'),
                		"param_name" => "slider_style",
                		"value" => array(	
                			__('Style 1', 'bstart') => "style1", 
                			__('Style 2', 'bstart') => "style2",
                			__('Style 3', 'bstart') => "style3",

                		),
                		'description' => __( 'Select your portfolio slider style here.', 'bstart' ),                		
                	),	   
                         
                    array(
						"type" => "dropdown",
						"heading" => __("Show title", "bstart"),
						"param_name" => "title",
						"value" => array(							    						
							'Yes' => "Yes", 
							'No' => "No",																																										
						),
						
					),                     
             	
					
					array(
						"type" => "dropdown",
						"heading" => __("Show Short Description", 'bstart'),
						"param_name" => "description",
						"value" => array(	
						    						
							'Yes' => "Yes", 
							'No' => "No", 																																															
						),
						
					),	
					
					array(
						"type" => "textfield",
						"heading" => __("Portfolio Per Pgae", "bstart"),
						"param_name" => "team_per",
						'value' =>"6",
						'description' => __( 'You can write how many team member show. ex(2)', 'bstart' ),					
					),	


					array(
					"type" => "dropdown_multi",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'bstart' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
					),


				
					array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'bstart' ),
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
					"group" 	  => __( "Slider Options", 'bstart' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'bstart' ),
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
					"group" 	  => __( "Slider Options", 'bstart' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'bstart' ),
					"param_name" => "col_sm",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "2",
					"group" 	  => __( "Slider Options", 'bstart' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'bstart' ),
					"param_name" => "col_xs",
					"value" => array(							
								'1' => "1", 
								'2' => "2",
								'3' => "3",	
								'4' => "4",
								'5' => "5",
								'6' => "6",																						
							),
					"std" => "1",
					"group" 	  => __( "Slider Options", 'bstart' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'bstart' ),
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
					"group" 	  => __( "Slider Options", 'bstart' ),
					
					),

					array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'bstart' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'bstart' ) => 'false',
						__( 'Enabled', 'bstart' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'bstart' ),
					"group" => __( "Slider Options", 'bstart' ),
					
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'bstart' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "bstart" )  => 'true',
						__( "Disable", "bstart" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'bstart' ),
					"group" => __( "Slider Options", 'bstart' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'bstart' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "bstart" )  => 'true',
						__( "Disable", "bstart" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'bstart' ),
					"group" => __( "Slider Options", 'bstart' ),
					
					),

				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'bstart' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "bstart" )  => '5000',
						__( "4 Seconds", "bstart" )  => '4000',
						__( "3 Seconds", "bstart" )  => '3000',
						__( "2 Seconds", "bstart" )  => '4000',
						__( "1 Seconds", "bstart" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'bstart' ),
					"group" 	  => __( "Slider Options", 'bstart' ),
					
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'bstart' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'bstart' ),
					"group" 	  => __( "Slider Options", 'bstart' ),
					
				),	
				array(
					"type" => "textfield",
					"heading" => __("Read More Text", 'sikkha'),
					"param_name" => "more_text",
					'description' => __( 'Type your read more text here', 'sikkha' ),
					"dependency" => Array('element' => 'readmore_type', 'value' => array('rm_text')),
				),  
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'bstart' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "bstart" )  => 'true',
						__( "Disable", "bstart" ) => 'false',
						),
					"description"=> __( "Loop to first item. Default: Enable", 'bstart' ),
					"group" 	 => __( "Slider Options", 'bstart' ),
					
				),

					array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'bstart' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'bstart' ),
				),            
                        
                ),
				
					
            )
        );                                   
    }
     
   add_action( 'vc_before_init', 'vc_portfolio_slider_mapping' );
     
    // Element HTML
     function vc_portfolioslider_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'                 => '',
					'slider_style'          => '',
					'cat'                   => '',	
					'description'           => '',	
					'more_text'           => '',	
					'team_per'              => '6',				
					'icon_fontawesome'      => 'fa fa-users',					
					'col_lg'                => '3',
					'col_md'                => '3',
					'col_sm'                => '2',
					'col_xs'                => '1',
					'col_mobile'            => '1',
					'slider_nav'            => 'true',
					'slider_dots'           => 'false',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_autoplay_speed' => '200',
					'slider_loop'           => 'true',				
					'css'                   => ''            
                ), 
                $atts,'vc_rsPortfolioslider'
           )
        );
	
        $a = shortcode_atts(array(
            'screenshots' => 'screenshots',
        ), $atts);

        $img = wp_get_attachment_image_src($a["screenshots"], "large");
        
		
		//extract content
		//$atts['content'] = $content;

		$imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}

        if(!empty($content)) {
			$main_content = $content;
		} else {
			$main_content = ''; 
		}



		//extact icon 
		$iconClass = isset( ${'icon_fontawesome'} ) ? esc_attr( ${'icon_fontawesome'} ) : 'fa fa-users';
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 

		$owl_data = array( 
			'nav'                => ( $slider_nav === 'true' ) ? true : false,
			'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
			'dots'               => ( $slider_dots === 'false' ) ? false : true,
			'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
			'autoplayTimeout'    => $slider_interval,
			'autoplaySpeed'      => $slider_autoplay_speed,
			'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
			'loop'               => ( $slider_loop === 'true' ) ? true : false,
			'margin'             => 20,
			'responsive'         => array(
				'0'    => array( 'items' => $col_mobile ),
				'480'  => array( 'items' => $col_xs ),
				'768'  => array( 'items' => $col_sm ),
				'992'  => array( 'items' => $col_md ),
				'1200' => array( 'items' => $col_lg ),
				)				
			);
		$owl_data = json_encode( $owl_data );	           

		 $taxonomy = "portfolio-category";

		if( $slider_style == 'style3'){

			//featured area

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
							'post_type' => 'portfolios',
							'posts_per_page' => 1,
							
					));	  
		        }
		        else{          
			   $best_wp = new wp_Query(array(
					'post_type' => 'portfolios',
					'posts_per_page' => 1,
					'tax_query' => array(
				        array(
				            'taxonomy' => 'portfolio-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    )
				));	
			}

			//without featured area
			 if(empty($cat)){
		        	$best_list_wp = new wp_Query(array(
						'post_type' => 'portfolios',
						'posts_per_page' => 2,
						'offset'		 => 1
					));	  
		        }
		        else{          
			   $best_list_wp = new wp_Query(array(
					'post_type' => 'portfolios',
					'posts_per_page' => 2,
					'offset'		 => 1,					
					'tax_query' => array(
				        array(
				            'taxonomy' => 'portfolio-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    )
				));	
			}



		$html ='
		<div class="rs-latest-news">
			<div class="row">
		        <div class="col-md-6">';
		        	while($best_wp->have_posts()): $best_wp->the_post();		        	   
		        	   	$post_title_show = get_the_title($best_wp->ID);	
		        	    $post_img = get_the_post_thumbnail($best_wp->ID);        	    
		        	    $post_url_img = get_the_post_thumbnail_url($best_wp->ID);        	    
		        	    $post_url = get_post_permalink($best_wp->ID);
		        		$post_date = get_the_date();				
		        		$post_admin = get_the_author();
		        		$post_author_image = get_avatar(( $best_wp->ID ) , 70 ); 	
		        		$post_content = get_the_excerpt(); 
		        		$user_id='';
		        		$read_more_btn = '';
		        		$author_desigination=get_the_author_meta( 'position', $user_id );
		        		$comments_count=get_comments_number( '0', '1', '%' );	
		        		$categories = get_the_category();

		        		$cats_show = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');

		        		if ( ! empty( $categories ) ) {		        						
		        		    $cat_name = esc_html( $categories[0]->name );
		        		    $link= esc_url( get_category_link( $categories[0]->term_id ) ) ;
		        		}

		        		if( ! empty($more_text) ){
		        			$read_more_btn = '<div class="new-btn">
		                		<a class="readon rs_button" href="'.$post_url.'">'.$more_text.'</a>
		                	</div>';
		        		}

		        		if( ! empty($post_url_img) ){
		        			$post_url_img = 'style="background:url('.$post_url_img.')"';
		        		}	

						$html .='<div class="news-normal-block" '.$post_url_img.'>';

		                	$html .='<div class="news-info">

		                	<div class="categories">
		                	  '.$cats_show.'
		                	</div>
		                	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>

		                	<div class="news-desc">
		                		<p>
		                			'.$post_content.'
		                		</p>
		                	</div>

		                	'.$read_more_btn.'

	                	</div></div>';

	                endwhile; 
	                wp_reset_query();	

		        $html .='</div>
		        <div class="col-md-6">
		        	<div class="news-list-block">
		        		<div class="row">';

		        		while($best_list_wp->have_posts()): $best_list_wp->the_post();
		        		   $post_title= get_the_title($best_list_wp->ID);
		        		   
		        		   	$post_title_show= get_the_title($best_list_wp->ID);

		        		    $post_img = get_the_post_thumbnail($best_list_wp->ID, 'medkeit_latest_blog_small');

		        		    $post_url = get_post_permalink($best_list_wp->ID); 
		        			
		        			if($degination!='No'){
		        		    $designation = get_post_meta( get_the_ID(), 'designation', true );
		        			}
		        		    
		        			$post_date = get_the_date();				
		        			//$post_comment=get_wp_count_comments($best_list_wp->ID);
		        			$post_admin = get_the_author();
		        			$post_author_image=get_avatar(( $best_list_wp->ID ) , 70 ); 	
		        			$post_content = get_the_excerpt();
		        			$user_id='';
		        			$author_desigination = get_the_author_meta( 'position', $user_id );
		        			$comments_count = get_comments_number( '0', '1', '%' );	
		        			$categories = get_the_category();
		        			$cats_show = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
		        			if ( ! empty( $categories ) ) {
		        							
		        			    $cat_name = esc_html( $categories[0]->name );
		        			    $link= esc_url( get_category_link( $categories[0]->term_id ) ) ;
		        			}			

			        		$html .= '<div class="col-md-6">
			        			<div class="news-list-item">';

			        			if ($post_img) {
				                    $html .= '<div class="news-img">
				                    	<a href="'.$post_url.'">
				                        	'.$post_img.'
				                    	</a>
				                    </div>';
				                }

								$html .='<div class="news-content">
									<div class="categories">
				                		'.$cats_show.'
				                	</div>
			                    	<h5 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h5>
			                    	<div class="news-desc">
			                    		<p>
			                    			'.$post_content.'
			                    		</p>
			                    	</div>
				                </div>			        			
			                </div>			        			
		        		</div>';

		        		endwhile; 
		        		wp_reset_query();


		        	$html .='</div>
		        </div>
		    </div>
	    </div>
	    </div>
	';	
}


		//slider settings for 1 and 2


		else{

        
		$html='<div class="rs-portfolio '.$slider_style.'">
		<div class="team-carousel owl-carousel owl-navigation-yes" data-carousel-options="'.esc_attr( $owl_data ).'">';		
		$post_title_show='';
		$degination='';
		$description_team='';
        //******************//
        // query post
        //******************//

        	 	$arr_cats=array();
                $arr= explode(',', $cat);
					for ($i=0; $i < count($arr) ; $i++) { 
	               	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
	               	// if(is_object($cats)):
	               	$arr_cats[]= $arr[$i];
	               	//endif;
	            }	            
			   $best_wp = new wp_Query(array(
					'post_type' => 'portfolios',
					'posts_per_page' =>$team_per,
					'tax_query' => array(
				        array(
				            'taxonomy' => 'portfolio-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    )
				));				     
		
			while($best_wp->have_posts()): $best_wp->the_post();
			   $post_title= get_the_title($best_wp->ID);
			   
			    if($title!='No'){
			   		 $post_title_show= get_the_title($best_wp->ID);
				}		
						
			    $post_img_url = get_the_post_thumbnail($best_wp->ID,'medkeit_portfolio-slider');
			    $post_url=get_post_permalink($best_wp->ID); 
				
				$cats_show = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');		    
				if($description!='No'){
			    $description_team = get_post_meta( get_the_ID(), 'description', true );
				}
			   				
				//retrive social icon values
				
				$html .='<div class="portfolio-slider">
				    <div class="portfolio-item content-overlay">
                        <div class="portfolio-img">
                           '.$post_img_url.'
	                        <div class="portfolio-content"> 
	                        	<div class="categories">
			                	  '.$cats_show.'
			                	</div> 

	                            <h3 class="p-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
	                        </div>
                        </div>
                    </div>
				</div>';
			
		endwhile; 
       	wp_reset_query();
		$html .='</div>
	   <div>
	 </div>
	</div>'
	;
}	
    return $html; 
 
}

add_shortcode( 'vc_rsPortfolioslider', 'vc_portfolioslider_html' );