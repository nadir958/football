<?php
/*
	Element Description: Rs Blog Slider Box*/
    
    // Element Mapping
    function rs_blog_grid_mapping() {
         
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
				'name'        => __('Rs Latest Blog Grid', 'khelo'),
				'base'        => 'rs_blog_grid',
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
						"type" => "textfield",
						"heading" => __("Post Per page", 'rsaddon'),
						"param_name" => "post_per",
						'description' => __( 'Write -1 to show all', 'rsaddon' ),										
					),
					array(
						"type" => "dropdown",
						"heading" => __("Select Grid Style", "khelo"),
						"param_name" => "slider_style",
						"value" => array(					
							'Style 1' => "Style 1", 
							'Style 2' => "Style 2",	
							'Style 3' => "Style 3",																								
						),						
					),                         
                ),			
					
            )
        );                                   
    }
     
add_action( 'vc_before_init', 'rs_blog_grid_mapping' );    
 
     
function rs_blog_grid_html( $atts, $content ='' ) {
    $attributes = array();
    // Params extraction
    extract(
        shortcode_atts(
            array(
				'cat'          => '',
				'post_per'     => '',
				'slider_style' => 'Style 1',
            ), 
            $atts,'rs_blog_grid'
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
	$post_per_page = ($post_per) ? $post_per-1 : 3;

    if( empty($cat) ){
    	$best_wp = new wp_Query(array(
					'posts_per_page' => 1,
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
			'posts_per_page' => 1,
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
				'posts_per_page' => $post_per_page,
				'order'          => 'DESC',
				'offset'         => 1,							
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
			'posts_per_page' => $post_per_page,
			'order'          => 'DESC',
			'offset'         => 1,
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

    if($slider_style=="Style 2"){
		$html = '
			<div class="rs-latest-news style2">
				<div class="row mb-30">
					<div class="col-md-12">
				    	<div class="latest-news-grid">
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
									$post_content = '';
									if(function_exists('khelo_custom_excerpt')) {
										$post_content = khelo_custom_excerpt( '15' ); 	
									}
				    				

		    		    			// Start Item
		    		                $html .= '<div class="news-normal-block featured-news-grid">
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
			    		                	<h3 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
			    		                </div>
		    		                </div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>
				</div>
				<div class="row">';

			    	while($best_list_wp->have_posts()): $best_list_wp->the_post();
	        		   $post_title= get_the_title($best_list_wp->ID);
	        		   
	        		   	$post_title_show= get_the_title($best_list_wp->ID);
	        		    $post_img = get_the_post_thumbnail($best_list_wp->ID, 'khelo_blog_sm_grid');

	        		    $post_url = get_post_permalink($best_list_wp->ID); 
	        			
	        			if($degination!='No'){
	        		    	$designation = get_post_meta( get_the_ID(), 'designation', true );
	        			}
	        		    
	        			$post_date = get_the_date();				
	        			//$post_comment=get_wp_count_comments($best_list_wp->ID);
	        			$post_admin = get_the_author();
	        			$post_author_image=get_avatar(( $best_list_wp->ID ) , 70 ); 	
	        			$post_content = '';
						if(function_exists('khelo_custom_excerpt')) {
							$post_content = khelo_custom_excerpt( '15' ); 	
						}
	        			$user_id='';
	        			$author_desigination = get_the_author_meta( 'position', $user_id );
	        			$comments_count = get_comments_number( '0', '1', '%' );	
	        			$categories = get_the_category();
	        			if ( ! empty( $categories ) ) {        							
	        			    $cat_name = esc_html( $categories[0]->name );
	        			    $link= esc_url( get_category_link( $categories[0]->term_id ) ) ;
	        			}			

	        			$html .= '<div class="col-md-4 col-sm-4 mb-30">
	        				<div class="news-list-item">';

	        			if ($post_img) {
		                    $html .= '<div class="news-img">
		                        	<a href="'.$post_url.'">'.$post_img.'</a>
		                    </div>';
		                }

						$html .='<div class="news-info-list">
							<div class="news-date">
	                    		<i class="fa fa-calendar-check-o"></i>
	                    		<span>'.$post_date.'</span>
	                    	</div>
	                    	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
		                </div>
		                </div>			        			
	        		</div>';

	        		endwhile; 
	        		wp_reset_query();

				$html .= '</div>
			</div>';
	}
	elseif($slider_style=="Style 3"){
		$html = '
			<div class="rs-latest-news style3">
				<div class="row mb-30">
					<div class="col-md-12">
				    	<div class="latest-news-grid">
				    		';

				    			while($best_wp->have_posts()): $best_wp->the_post();
				    			   	$post_title_show = get_the_title($best_wp->ID);
				    						
				    			    $post_img = get_the_post_thumbnail($best_wp->ID, 'khelo_latest_featured_blog_3column');
				    			    
				    			    $post_url = get_post_permalink($best_wp->ID); 
				    				
				    				if($degination!='No'){
				    			       $designation = get_post_meta( get_the_ID(), 'designation', true );
				    				}
				    			    
				    				$post_date = get_the_date();				
				    				$post_admin = get_the_author();
				    				$post_author_image = get_avatar(( $best_wp->ID ) , 70 ); 	
				    				$post_content = '';
									if(function_exists('khelo_custom_excerpt')) {
										$post_content = khelo_custom_excerpt( '15' ); 	
									}

		    		    			// Start Item
		    		                $html .= '<div class="news-normal-block featured-news-grid">
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
			    		                	<h3 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
			    		                </div>
		    		                </div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>
				</div>
				<div class="row">';

			    	while($best_list_wp->have_posts()): $best_list_wp->the_post();

						$post_title      = get_the_title($best_list_wp->ID);						
						$post_title_show = get_the_title($best_list_wp->ID);
						$post_img        = get_the_post_thumbnail($best_list_wp->ID, 'khelo_latest_featured_blog_thumb');						
						$post_url        = get_post_permalink($best_list_wp->ID); 
	        			
	        			if($degination!='No'){
	        		    	$designation = get_post_meta( get_the_ID(), 'designation', true );
	        			}
	        		    
						$post_date           = get_the_date();					
						$post_admin          = get_the_author();
						$post_author_image   = get_avatar(( $best_list_wp->ID ) , 70 ); 	
						$post_content = '';
						if(function_exists('khelo_custom_excerpt')) {
							$post_content = khelo_custom_excerpt( '15' ); 	
						}
						$user_id             = '';
						$author_desigination = get_the_author_meta( 'position', $user_id );
						$comments_count      = get_comments_number( '0', '1', '%' );	
						$categories          = get_the_category();

	        			if ( ! empty( $categories ) ) {        							
							$cat_name = esc_html( $categories[0]->name );
							$link     = esc_url( get_category_link( $categories[0]->term_id ) ) ;
	        			}			

	        			$html .= '<div class="col-md-6 col-sm-6 mb-35">
	        				<div class="news-list-item">';

	        			if ($post_img) {
		                    $html .= '<div class="news-img">
		                        	<a href="'.$post_url.'">'.$post_img.'</a>
		                    </div>';
		                }

						$html .='<div class="news-info-list">
							<div class="news-date">
	                    		<i class="fa fa-calendar-check-o"></i>
	                    		<span>'.$post_date.'</span>
	                    	</div>
	                    	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
		                </div>
		                </div>			        			
	        		</div>';

	        		endwhile; 
	        		wp_reset_query();

				$html .= '</div>
			</div>';
	}else{

		$html = '
			<div class="rs-latest-news style1">
				<div class="row">
					<div class="col-md-12 col-lg-8">
				    	<div class="latest-news-grid">
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
				    				$post_content = '';
									if(function_exists('khelo_custom_excerpt')) {
										$post_content = khelo_custom_excerpt( '15' ); 	
									}

		    		    			// Start Item
		    		                $html .= '<div class="news-normal-block featured-news-grid">
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
			    		                	<h3 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
			    		                	<div class="news-desc">
			    		                		<p>
			    		                			'.$post_content.'
			    		                		</p>
			    		                	</div>
			    		                </div>
		    		                </div>';
		    		                // End Item

				                endwhile; 
				                wp_reset_query();

				    		$html .='
				    	</div>			        			
					</div>

					<div class="col-md-12 col-lg-4">';

			    	while($best_list_wp->have_posts()): $best_list_wp->the_post();
	        		   $post_title= get_the_title($best_list_wp->ID);
	        		   
	        		   	$post_title_show= get_the_title($best_list_wp->ID);

	        		    $post_img = get_the_post_thumbnail($best_list_wp->ID, 'khelo_blog_grid_sm');

	        		    $post_url = get_post_permalink($best_list_wp->ID); 
	        			
	        			if($degination!='No'){
	        		    $designation = get_post_meta( get_the_ID(), 'designation', true );
	        			}
	        		    
	        			$post_date = get_the_date();				
	        			//$post_comment=get_wp_count_comments($best_list_wp->ID);
	        			$post_admin = get_the_author();
	        			$post_author_image=get_avatar(( $best_list_wp->ID ) , 70 ); 	
	        			$post_content = '';
									if(function_exists('khelo_custom_excerpt')) {
										$post_content = khelo_custom_excerpt( '15' ); 	
									}
	        			$user_id='';
	        			$author_desigination = get_the_author_meta( 'position', $user_id );
	        			$comments_count = get_comments_number( '0', '1', '%' );	
	        			$categories = get_the_category();
	        			if ( ! empty( $categories ) ) {
	        							
	        			    $cat_name = esc_html( $categories[0]->name );
	        			    $link= esc_url( get_category_link( $categories[0]->term_id ) ) ;
	        			}			

	        			$html .= '<div class="news-list-item ipadmt-30">';

	        			if ($post_img) {
		                    $html .= '<div class="news-img">
		                        	<a href="'.$post_url.'">'.$post_img.'</a>
		                    </div>';
		                }

						$html .='<div class="news-info-list">
							<div class="news-date">
	                    		<i class="fa fa-calendar-check-o"></i>
	                    		<span>'.$post_date.'</span>
	                    	</div>
	                    	<h4 class="news-title"><a href="'.$post_url.'">'.$post_title_show.'</a></h4>
		                </div>
		                </div>';

	        		endwhile; 
	        		wp_reset_query();

				$html .= '</div>
				</div>
			</div>';
	}

	return $html;

}


add_shortcode( 'rs_blog_grid', 'rs_blog_grid_html' );