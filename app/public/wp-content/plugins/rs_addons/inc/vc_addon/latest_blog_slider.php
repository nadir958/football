<?php
/*
	Element Description: Rs Blog Slider Box*/
    
    // Element Mapping
    function rs_blog_slider_mapping() {
         
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
				'name'        => __('Rs Latest Blog Slider', 'khelo'),
				'base'        => 'rs_blog_slider',
				'description' => __('Latest latest blog slider', 'khelo'), 
				'category'    => __('by RS Theme', 'khelo'),   
				'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
				'params'      => array(			
					array(
						"type"       => "dropdown_multi",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Categories", 'khelo' ),
						"param_name" => "cat",
						'value'      => $category_dropdown,
					),
					array(
						"type" => "dropdown",
						"heading" => __("Select Slider Style", "khelo"),
						"param_name" => "slider_style",
						"value" => array(					
							'Style 1' => "Style 1", 
							'Style 2' => "Style 2",																								
							'Style 3' => "Style 3",																								
						),						
					),      
					array(
						"type" => "textfield",
						"heading" => __("Read More Text", 'khelo'),
						"param_name" => "more_text",
						'description' => __( 'Type your read more text here', 'khelo' ),
						"dependency" => Array('element' => 'slider_style', 'value' => array('Style 2', 'Style 1')),
					), 

					array(
						"type"       => "dropdown",
						"heading"    => __("Show  arrow", 'rsaddon'),
						"param_name" => "shows_arrow",
						"value" 	 => array(			    						
							'No'  => "",											
							'Yes' => "shows_arrows", 
						),
						"dependency" => Array('element' => 'slider_style', 'value' => array('Style 2', 'Style 3')),
					),                         
                ),			
					
            )
        );                                   
    }
     
add_action( 'vc_before_init', 'rs_blog_slider_mapping' );    
 
     
function rs_blog_slider_html( $atts, $content ='' ) {
    $attributes = array();
    // Params extraction
    extract(
        shortcode_atts(
            array(
				'cat'              			=> '',
				'shows_arrow'              	=> '',
				'slider_style'     			=> 'Style 1',
				'more_text'        			=> 'Read More',
            ), 
            $atts,'rs_blog_slider'
       )
    );
	
	$a      = shortcode_atts(array( 'screenshots' => 'screenshots',), $atts);
	$cat    = empty( $cat ) ? '' : $cat;
	$img    = wp_get_attachment_image_src($a["screenshots"], "large");

	$imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}

        if(!empty($content)) {
            $atts['content'] = $content;
		} else {
			$atts['content'] = ''; 
		}
 

	$post_title_show='';
	$degination='';
	$taxonomy='category';
    if( empty($cat) ){
    	$best_wp = new wp_Query(array(
					'posts_per_page' => 3,
					'order' => 'DESC',								
					'tax_query' => array(
					array(                
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 
					'post-format-aside',
					'post-format-audio',
					'post-format-chat',
					'post-format-gallery',
					'post-format-image',
					'post-format-link',
					'post-format-quote',
					'post-format-status',
					'post-format-video'
					),
					'operator' => 'NOT IN'
					)
				)
			));	
    }
    else{
		$best_wp = new wp_Query(array(
			'posts_per_page' => 3,
			'order' => 'DESC',
			'category_name'       => $cat,
			'tax_query' => array(
				array(                
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 
						'post-format-aside',
						'post-format-audio',
						'post-format-chat',
						'post-format-gallery',
						'post-format-image',
						'post-format-link',
						'post-format-quote',
						'post-format-status',
						'post-format-video'
					),
					'operator' => 'NOT IN'
				)
			)
		));	
    }

    if( empty($cat) ){
    	$best_list_wp = new wp_Query(array(
				'posts_per_page' => 3,
				'order' => 'DESC',								
				'tax_query' => array(
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image',
							'post-format-link',
							'post-format-quote',
							'post-format-status',
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				)
		));	
    }
    else{
		$best_list_wp = new wp_Query(array(
			'posts_per_page' => 3,
			'order'          => 'DESC',
			'category_name'  => $cat,
			'tax_query' => array(
				array(                
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 
						'post-format-aside',
						'post-format-audio',
						'post-format-chat',
						'post-format-gallery',
						'post-format-image',
						'post-format-link',
						'post-format-quote',
						'post-format-status',
						'post-format-video'
					),
					'operator' => 'NOT IN'
				)
			)
		));	
    }
    if($slider_style=="Style 1"){
		$html = '
			<div class="rs-latest-news '.$shows_arrow.'">
				<div class="row">

					<div class="col-md-9">
				    	<div class="latest-news-slider">
				    		';

				    			while($best_wp->have_posts()): $best_wp->the_post();
				    			   	$post_title_show = get_the_title($best_wp->ID);
				    						
				    			    $post_img = get_the_post_thumbnail($best_wp->ID, 'khelo_latest_blog_big');
				    			    
				    			    $post_url = get_post_permalink($best_wp->ID); 
				    				
				    				if($degination!='No'){
				    			    $designation = get_post_meta( get_the_ID(), 'designation', true );
				    				}
				    			    
				    				$post_date = get_the_date();				
				    				$post_admin = get_the_author();
				    				$post_author_image = get_avatar(( $best_wp->ID ) , 70 ); 	
				    				$post_content = khelo_custom_excerpt( '18' ); 	

		    		    			// Start Item
		    		                $html .= '<div><div class="news-normal-block">
		    		                    <div class="news-img">
		    		                    	<a href="'.$post_url.'">
		    		                        	'.$post_img.'
		    		                    	</a>
		    		                    </div>
		    		                    <div class="news-info">
			    		                	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
			    		                	<div class="news-btn">
			    		                		<a href="'.$post_url.'">'.$more_text.'</a>
			    		                	</div>
		    		                	</div>
		    		                </div></div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>


					<div class="col-md-3">			        			
				    	<div class="latest-news-nav">';
				    		while($best_list_wp->have_posts()): $best_list_wp->the_post();
				    		    $post_img = get_the_post_thumbnail($best_list_wp->ID, 'khelo_blog_slider');
		    					$html .= '<div>'.$post_img.'</div>';
		    				endwhile;
		    				wp_reset_query();

						$html .= '</div>
					</div>


				</div>
			</div>
		';
	}elseif($slider_style=="Style 3"){
		$html = '
			<div class="rs-latest-news style3 '.$shows_arrow.'">
				<div class="row">

					<div class="col-md-12">
				    	<div class="latest-news-slider">
				    		';

				    			while($best_wp->have_posts()): $best_wp->the_post();
				    			   	$post_title_show = get_the_title($best_wp->ID);
				    						
				    			    $post_img = get_the_post_thumbnail($best_wp->ID, 'khelo_latest_xl_blog');
				    			    
				    			    $post_url = get_post_permalink($best_wp->ID); 
				    				
				    				if($degination!='No'){
				    			    $designation = get_post_meta( get_the_ID(), 'designation', true );
				    				}
				    			    
				    				$post_date = get_the_date();				
				    				$post_admin = get_the_author();
				    				$post_author_image = get_avatar(( $best_wp->ID ) , 70 ); 	
				    				$post_content = khelo_custom_excerpt( '18' ); 	

		    		    			// Start Item
		    		                $html .= '<div><div class="news-normal-block">
		    		                    <div class="news-img">
		    		                    	<a href="'.$post_url.'">
		    		                        	'.$post_img.'
		    		                    	</a>
		    		                    </div>
		    		                    <div class="news-info">
			    		                	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
		    		                	</div>
		    		                </div></div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>		        			
			    	<div class="latest-news-nav">';

					$html .= '</div>


				</div>
			</div>
		';
	}else{

		$html = '
			<div class="rs-latest-news style2 '.$shows_arrow.'">
				<div class="row">
					<div class="col-md-6">
				    	<div class="latest-news-slider">
				    		';

				    			while($best_wp->have_posts()): $best_wp->the_post();
				    			   	$post_title_show = get_the_title($best_wp->ID);
				    						
				    			    $post_img = get_the_post_thumbnail($best_wp->ID, 'khelo_latest_blog_big');
				    			    
				    			    $post_url = get_post_permalink($best_wp->ID); 
				    				
				    				if($degination!='No'){
				    			    $designation = get_post_meta( get_the_ID(), 'designation', true );
				    				}
				    			    
				    				$post_date = get_the_date();				
				    				$post_admin = get_the_author();
				    				$post_author_image = get_avatar(( $best_wp->ID ) , 70 ); 	
				    				$post_content = khelo_custom_excerpt( '15' ); 	

		    		    			// Start Item
		    		                $html .= '<div><div class="news-normal-block">
		    		                    <div class="news-img">
		    		                    	<a href="'.$post_url.'">
		    		                        	'.$post_img.'
		    		                    	</a>
		    		                    </div>
		    		                    <div class="news-info">
			    		                	<div class="news-date">
			    		                		<i class="fa fa-calendar-check-o"></i>
			    		                		<span>'.$post_date.'</span>
			    		                	</div>
			    		                	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
			    		                	<div class="news-btn">
			    		                		<a href="'.$post_url.'">'.$more_text.'</a>
			    		                	</div>
			    		                </div>
		    		                </div></div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>


					<div class="col-md-6">			        			
				    	<div class="latest-news-nav news-list-block">';

				    		while($best_list_wp->have_posts()): $best_list_wp->the_post();
		        		   $post_title= get_the_title($best_list_wp->ID);
		        		   
		        		   	$post_title_show= get_the_title($best_list_wp->ID);

		        		    $post_img = get_the_post_thumbnail($best_list_wp->ID, 'khelo_blog_grid_small_right');

		        		    $post_url = get_post_permalink($best_list_wp->ID); 
		        			
		        			if($degination!='No'){
		        		    $designation = get_post_meta( get_the_ID(), 'designation', true );
		        			}
		        		    
		        			$post_date = get_the_date();				
		        			//$post_comment=get_wp_count_comments($best_list_wp->ID);
		        			$post_admin = get_the_author();
		        			$post_author_image=get_avatar(( $best_list_wp->ID ) , 70 ); 	
		        			$post_content = khelo_custom_excerpt('15');
		        			$user_id='';
		        			$author_desigination = get_the_author_meta( 'position', $user_id );
		        			$comments_count = get_comments_number( '0', '1', '%' );	
		        			$categories = get_the_category();
		        			if ( ! empty( $categories ) ) {
		        							
		        			    $cat_name = esc_html( $categories[0]->name );
		        			    $link= esc_url( get_category_link( $categories[0]->term_id ) ) ;
		        			}			

		        			$html .= '<div class="news-list-item">';

		        			if ($post_img) {
			                    $html .= '<div class="news-img">
			                        	'.$post_img.'
			                    </div>';
			                }

							$html .='<div class="news-content">
		                    	<h5 class="news-title">'.$post_title_show.'</h5>
		                    	<div class="news-date">
		                    		<i class="fa fa-calendar-check-o"></i>
		                    		<span>'.$post_date.'</span>
		                    	</div>
		                    	<div class="news-desc">
		                    		<p>
		                    			'.$post_content.'
		                    		</p>
		                    	</div>
			                </div>			        			
		        		</div>';

		        		endwhile; 
		        		wp_reset_query();

						$html .= '</div>
					</div>


				</div>
			</div>

		';
	}

	return $html;

}


add_shortcode( 'rs_blog_slider', 'rs_blog_slider_html' );