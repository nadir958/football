<?php
/*
Element Description: Club List
*/

    function RS_Club_Mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        
        $category_dropdown = array( __( 'All Clubs', 'rsaddon' ) => '0' );	
        $args = array(
            'taxonomy' => array('club-category'),//ur taxonomy
            'hide_empty' => true,                  
        );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_dropdown[$term->name] = $term->slug;		
		}

        // Map the block with vc_map()
        vc_map( 
            array(
				'name'        => __('RS Club List', 'rsaddon'),
				'base'        => 'vc_rs_club',
				'description' => __('Display Club List', 'rsaddon'), 
				'category'    => __('by RS Theme', 'rsaddon'),   
				'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                	 array(
                    	"type" => "dropdown",
                    	"heading" => __("Select Style", "rsaddon"),
                    	"param_name" => "style",
                    	"value" => array(	
                    	    __("Select Style", "rsaddon") => "",                    	
                    		__("Grid Style", "rsaddon") => "style1",
                    		__("List Style(with ranking)", "rsaddon") => "style2",
                    		__("Table style(Ranking Points wtih position)", "rsaddon") => "style3"
                    		
                    	),
                    	"description" => __("Select your style here", "rsaddon"),                    	
                    ),
                                     
                    array(
						"type"       => "dropdown_multi",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Select Categories", 'rsaddon' ),
						"param_name" => "cat",
						'value'      => $category_dropdown,
					),

					 array(
						"type"       => "textfield",
						"heading"    => __("Club Per Page", "rsaddon"),
						"param_name" => "club_per_page",                    	               	
                    ),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Odd Boxes Color", "rsaddon" ),
						"param_name" => "team_color_odd",
						"value" => '',
						"description" => __( "Choose color here", "rsaddon" ),	
						"dependency" => Array('element' => 'style', 'value' => array('style1')),  

					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Even Boxes Color", "rsaddon" ),
						"param_name" => "team_color_even",
						"value" => '',
						"description" => __( "Choose color here", "rsaddon" ),	
						"dependency" => Array('element' => 'style', 'value' => array('style1')),  	                
					),
				

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Text Color", "rsaddon" ),
						"param_name" => "textcolor_list",
						"value" => '',
						"description" => __( "Choose color here", "rsaddon" ),	
						"dependency" => Array('element' => 'style', 'value' => array('style2')),  

					),

					array(
						"type" => "textfield",
						"heading" => __("Button Text", "rsaddon"),
						"param_name" => "btn_text",						
						"dependency" => Array('element' => 'style', 'value' => array('style2')),  				
					),

					array(
						"type" => "textfield",
						"heading" => __("Button Link", "rsaddon"),
						"param_name" => "btn_text_link",						
						"dependency" => Array('element' => 'style', 'value' => array('style2')),  				
					),



					array(
						'type'        => 'textfield',
						'heading'     => __( 'Extra class name', 'js_composer' ),
						'param_name'  => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
					),
					
					array(
						'type'       => 'css_editor',
						'heading'    => __( 'CSS box', 'rsaddon' ),
						'param_name' => 'css',
						'group'      => __( 'Design Options', 'rsaddon' ),
					),            
                        
                ),
				
					
            )
        );                                
        
    }
     add_action( 'vc_before_init', 'RS_Club_Mapping' );
     
    // Element HTML
     function RS_Club_Portfolio_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
						
					'pointtable'      => '1',		
					'el_class'        => '',
					'club_per_page'   => -1,
					'team_color_even' => '',
					'team_color_odd'  => '',				
					'css'             => '',
					'cat'             => '',				
					'style'           => '',	
					'textcolor_list'  => '',
					'btn_text'        => '',
					'btn_text_link'   => '',		
					), 
                $atts,'vc_rs_club'
           )
        );

        $taxonomy = '';	
      
		
		//extact icon 		
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
		//custom class added
		$wrapper_classes  = array($el_class) ;			
		$class_to_filter  = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );  			
        $html ='<div class="rs-club-list club-list '.$style.'">
		<div class="all-club-list '.$css_class.'">'; 
   

         //******************//
        // query post
        //******************//
    		$cat;
			$arr_cats = array();
			$arr      = explode(',', $cat);
				for ($i=0; $i < count($arr) ; $i++) {                	
               	$arr_cats[]= $arr[$i];               
            }
         
      		if(empty($cat)){
	        	$best_wp = new wp_Query(array(
					'post_type' => 'club',						
					'posts_per_page' => $club_per_page,	
					'orderby' => 'menu_order',
					'order' => 'ASC',							
						
				));	  
	        }

	        else{            
		    	$best_wp = new wp_Query(array(
					'post_type' => 'club',					
					'posts_per_page' => $club_per_page,	
					'orderby' => 'menu_order',
					'order' => 'ASC',	
					'tax_query' => array(
				        array(
				            'taxonomy' => 'club-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    ),							
					
				));
			}


			$x= 1;


	if($style == 'style1'){

       		if( $best_wp->have_posts() ): while( $best_wp->have_posts() ) : $best_wp->the_post(); //start while loop	   			
				$post_title   = get_the_title($best_wp->ID);		 	
				$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
				$post_url     = get_post_permalink($best_wp->ID); 
				$country      = get_post_meta( get_the_ID(), 'club_country',true );
				$country = ($country) ? '(<h5>'. $country.'</h5>)' : '';
				$color = '#fff';		
			


			  
				if($x<=6){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}


				if($x>6 && $x<=12){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}


				if($x>12 && $x<=18){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}


				if($x>18 && $x<=24){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}


				if($x>24 && $x<=30){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}

				if($x>30 && $x<=36){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}


				if($x>36 && $x<=42){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}

				if($x>42 && $x<=48){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}

				if($x>48 && $x<=54){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}

				if($x>54 && $x<=60){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}

				if($x>60 && $x<=66){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}

				if($x>66 && $x<=72){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}

				if($x>72 && $x<=78){
					if($x % 2 ==0){
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					}else{
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
					};
				}

				if($x>78 && $x<=150){
					if($x % 2 ==0){
						if(!empty($team_color_odd)) :
							$color = 'style="background:'.$team_color_odd.'"';
						endif;
						
					}else{
						if(!empty($team_color_even)) :
							$color = 'style="background:'.$team_color_even.'"';
						endif;
					};
				}



				$html .= '<div class="club-item" '.$color.'>
				<a href="'.$post_url .'"><img src="'.$post_img_url.'"></img></a>
				<h3><a href="'.$post_url .'">'	.$post_title. '</a></h3>
				'.$country.'
				</div>';
			
			
				$x++;			    
				endwhile; 
				wp_reset_query();
			endif;
		}
		elseif($style == 'style3'){

			if(empty($cat)){
	        	$best_wp = new wp_Query(array(
					'post_type'      => 'club',						
					'posts_per_page' => $club_per_page,	
					'meta_key'       => 'club_points',
					'orderby'        => 'meta_value_num',					
					'order'          => 'DSC' 						
						
				));	  
	        }

	        else{            
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'club',					
					'posts_per_page' => $club_per_page,	
					'meta_key'       => 'club_points',
					'orderby'        => 'meta_value_num',					
					'order'          => 'DSC' ,					
					'tax_query' => array(
				        array(
				            'taxonomy' => 'club-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    ),				    
				));
			}

			$textcolor_list = !empty($textcolor_list) ? 'style="color:'.$textcolor_list.'"' : '';
			?>
			<table class="full-ranking">
				<tr>
					<th><?php echo esc_html__('POS', 'rsaddon');?></th>
					<th><?php echo esc_html__('Team', 'rsaddon');?></th>
					<th><?php echo esc_html__('Country', 'rsaddon');?></th>
					<th><?php echo esc_html__('Total Points', 'rsaddon');?></th>
				</tr>
				
		<?php
			$x =1;
			if( $best_wp->have_posts() ): while( $best_wp->have_posts() ) : $best_wp->the_post(); //start while loop	  

				$post_title   = get_the_title($best_wp->ID);		 	
				$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
				$post_url     = get_post_permalink($best_wp->ID); 
				$country      = get_post_meta( get_the_ID(), 'club_country',true );
				$points      = get_post_meta( get_the_ID(), 'club_points',true );
				$country = ($country) ? '<span '.$textcolor_list.'>'. $country.'</span>' : '';
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><div class="list-points"><div class="club-item">
				<a href="<?php echo $post_url;?>"><img src="<?php echo $post_img_url; ?>"></img></a>
				<a <?php echo $textcolor_list; ?>  href="<?php echo $post_url;?>"><?php echo $post_title; ?></a></span>
				
				</div></td>
						<td><?php echo $country; ?></td>
						<td><div class="points"><?php echo $points;?></div></td>
					</tr>
				<?php
							

				$html .='</div>';
				$x++;
				endwhile; 
				wp_reset_query();
			endif;
			?>
		</table>
		<?php
			
		}

		else{

			if(empty($cat)){
	        	$best_wp = new wp_Query(array(
					'post_type'      => 'club',						
					'posts_per_page' => $club_per_page,	
					'meta_key'       => 'club_points',
					'orderby'        => 'meta_value_num',					
					'order'          => 'DSC' 						
						
				));	  
	        }

	        else{            
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'club',					
					'posts_per_page' => $club_per_page,	
					'meta_key'       => 'club_points',
					'orderby'        => 'meta_value_num',					
					'order'          => 'DSC' ,					
					'tax_query' => array(
				        array(
				            'taxonomy' => 'club-category',
				            'field' => 'slug', //can be set to ID
				            'terms' => $arr_cats//if field is ID you can reference by cat/term number
				        ),
				    ),				    
				));
			}

			$textcolor_list = !empty($textcolor_list) ? 'style="color:'.$textcolor_list.'"' : '';

			if( $best_wp->have_posts() ): while( $best_wp->have_posts() ) : $best_wp->the_post(); //start while loop	  

				$post_title   = get_the_title($best_wp->ID);		 	
				$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
				$post_url     = get_post_permalink($best_wp->ID); 
				$country      = get_post_meta( get_the_ID(), 'club_country',true );
				$points      = get_post_meta( get_the_ID(), 'club_points',true );
				$country = ($country) ? '(<span '.$textcolor_list.'>'. $country.'</span>)' : '';
			
				$html .= '<div class="list-points" '.$textcolor_list.'><div class="club-item">
				<a href="'.$post_url .'"><img src="'.$post_img_url.'"></img></a>
				<span '.$textcolor_list.'><a '.$textcolor_list.' href="'.$post_url .'">'	.$post_title. '</a></span>
				'.$country.'
				</div>';
				if(!empty( $points )) : 
					$html .='<div class="points" '.$textcolor_list.'>'.$points.'</div>';
				endif;

				$html .='</div>';
				endwhile; 
				wp_reset_query();
			endif;

			if(!empty($btn_text)) : 
				$html .='
				<div class="link">
					<a href="'.$btn_text_link.'">'.$btn_text.'</a> 
				</div>';
			endif;
			}
			
		$html .= '
		
		</div>
		</div>';		
	  return $html;   
}

add_shortcode( 'vc_rs_club', 'RS_Club_Portfolio_html' );  