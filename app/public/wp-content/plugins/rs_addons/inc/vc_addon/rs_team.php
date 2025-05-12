<?php
/*
Element Description: Rs Team Box
*/
     
    // Element Mapping
    function vc_grassyTeam_mapping() {         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        //category for team
        $category_team = array( __( 'All Categories', 'rsaddon' ) => '0' );	
        $args = array(
			'taxonomy'   => array('player-category'),//ur taxonomy
			'hide_empty' => true,                  
        );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_team[$term->name] = $term->slug;		
		} 

		//category for club

        
        $category_dropdown = array( __( 'All Clubs', 'rsaddon' ) => '0' );	
       
        $player_club = new WP_Query( array(
			'post_type'   => 'club',
			'post_status' => 'publish',                
        ));

        if ( $player_club->have_posts() ) :
            while ( $player_club->have_posts() ) :
            	$player_club->the_post();
            	$category_dropdown[get_the_title()] = get_the_ID();			    
            endwhile;
            wp_reset_query();
        endif;

        $player_dropdown = array( __( 'Select Category', 'rsaddon' ) => '0' );	
        
        $player_position = new WP_Query( array(
			'post_type'   => 'players',
			'post_status' => 'publish',                
        ));
        if ( $player_position->have_posts() ) :
            while ( $player_position->have_posts() ) :
                $player_position->the_post();
				$player_cat                   = get_post_meta(get_the_ID($player_position->ID), 'player_position', true);
				$player_dropdown[$player_cat] = $player_cat;			    
            endwhile;
            wp_reset_query();
        endif;
        

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('RS Squad Showcase', 'rsaddon'),
                'base' => 'vc_grassyTeam',
                'description' => __('Squad Showcase Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(
                	array(
						"type"       => "dropdown",
						"heading"    => __("Layout Type", "rsaddon"),
						"param_name" => "type",
						"value" => array(							
							'Slider' => "Slider", 
							'Grid'   => "Grid",											
						),	
					),

                	array(
						"type"       => "dropdown",
						"heading"    => __("Select Squad Style", "rsaddon"),
						"param_name" => "slider_style",
						"value" => array(							
							'Style 1' => "team-slider-style1", 
							'Style 2' => "team-slider-style2",
							'Style 3' => "team-slider-style3",
							'Style 4' => "team-slider-style4",
						),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),

					array(
						"type"       => "dropdown",
						"heading"    => __("Full Width Team", "rsaddon"),
						"param_name" => "slider_full",
						"value" => array(
							'Select' => "",						
							'False' => "false",
							'True'  => "true", 
						),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),

					array(
						"type"       => "dropdown",
						"heading"    => __("Select Squad Style", "rsaddon"),
						"param_name" => "grid_style",
						"value" => array(							
							'Style 1' => "team-grid-style1", 
							'Style 2' => "team-grid-style2",
							'Style 3' => "team-style4",
							'Style 4' => "team-style5"
						),
						"dependency" => Array('element' => 'type', 'value' => array('Grid')),
					),

					array(
						"type"       => "dropdown",
						"heading"    => __("Select Squad Grid", "rsaddon"),
						"param_name" => "team_col",
						"value" => array(							 
							'2 Column' => "2 Column", 
							'3 Column' => "3 Column",
							'4 Column' => "4 Column",
							'6 Column' => "6 Column",
							'Full Width' => "Full Width"																	
						),
						"dependency" => Array('element' => 'type', 'value' => array('Grid')),						
					),			
					  
                         
                    array(
						"type"       => "dropdown",
						"heading"    => __("Show title", "rsaddon"),
						"param_name" => "title",
						"value" => array(							    						
							'Yes' => "Yes", 
							'No'  => "No",						
						),						
					),

					array(
						"type" => "dropdown_multi",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Categories", 'rsaddon' ),
						"param_name" => "team_cat",
						'value' => $category_team,
					), 
					  
					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Select Club", 'rsaddon' ),
						"param_name" => "cat",
						'value'      => $category_dropdown,
					),

					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Select Player Position", 'rsaddon' ),
						"param_name" => "position",
						'value'      => $player_dropdown,
					),                    
					
					array(
						"type"       => "dropdown",
						"heading"    => __("Show Short Description", 'rsaddon'),
						"param_name" => "description",
						"value" => array(
							'Yes' => "Yes", 
							'No'  => "No",
						),
						"dependency" => Array('element' => 'grid_style', 'value' => array('team-grid-style2', 'team-grid-style3')),	
						
					),

					array(
						"type"       => "dropdown",
						"heading"    => __("Content Alignment", 'rsaddon'),
						"param_name" => "content_align",
						"value" => array(
							'Left'   => "text-left", 
							'Center' => "text-center", 	
							'Right'  => "text-right",
						),
						"dependency" => Array('element' => 'grid_style', 'value' => array('team-grid-style2', 'team-grid-style3')),						
					),
					
					array(
						"type"        => "textfield",
						"heading"     => __("Team Per Pgae", "rsaddon"),
						"param_name"  => "team_per",
						'value'       => -1,
						'description' => __( 'You can write how many team member show. ex(2)', 'rsaddon' ),					
					),			

				
					array(
						"type"       => "dropdown",
						"heading"    => __("Show  Pagination", 'rsaddon'),
						"param_name" => "pagination_team",
						"value" 	 => array(			    						
							'No'  => "",											
							'Yes' => "yes", 
						),
						"dependency" => Array('element' => 'type', 'value' => array('Grid')),
					),

					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Number of columns ( Desktops > 1199px )", 'rsaddon' ),
						"param_name" => "col_lg",
						"value" => array(							
									'1' => "1", 
									'2' => "2",
									'3' => "3",	
									'4' => "4",
									'5' => "5",
									'6' => "6",																						
								),
						"std"        => "3",
						"group"      => __( "Slider Options", 'rsaddon' ),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),	
					),
					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Number of columns ( Desktops > 991px )", 'rsaddon' ),
						"param_name" => "col_md",
						"value" => array(							
									'1' => "1", 
									'2' => "2",
									'3' => "3",	
									'4' => "4",
									'5' => "5",
									'6' => "6",																						
								),
						"std"        => "3",
						"group"      => __( "Slider Options", 'rsaddon' ),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Number of columns ( Tablets > 767px )", 'rsaddon' ),
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
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Number of columns ( Phones < 768px )", 'rsaddon' ),
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
						"group"      => __( "Slider Options", 'rsaddon' ),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Number of columns ( Small Phones < 480px )", 'rsaddon' ),
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
						"group"      => __( "Slider Options", 'rsaddon' ),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),

					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Navigation Dots", 'rsaddon' ),
						"param_name" => "slider_dots",
						"value" => array(
							__( 'Disabled', 'rsaddon' ) => 'false',
							__( 'Enabled', 'rsaddon' )  => 'true',
							),
						"description" => __( "Enable or disable navigation dots. Default: Disable", 'rsaddon' ),
						"group"       => __( "Slider Options", 'rsaddon' ),
						"dependency"  => Array('element' => 'type', 'value' => array('Slider')),
					),

					array(
						"type"       => "dropdown",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __( "Navigation Nav", 'rsaddon' ),
						"param_name" => "slider_nav",
						"value" => array(
							__( 'Enabled', 'rsaddon' )  => 'true',
							__( 'Disabled', 'rsaddon' ) => 'false',
							),
						"description" => __( "Enable or disable navigation Nav. Default: Enable", 'rsaddon' ),
						"group"       => __( "Slider Options", 'rsaddon' ),
						"dependency"  => Array('element' => 'type', 'value' => array('Slider')),
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
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
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
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
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
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						"type"		  => "textfield",
						"holder" 	  => "div",
						"class" 	  => "",
						"heading" 	  => __( "Autoplay Slide Speed", 'rsaddon' ),
						"param_name"  => "slider_autoplay_speed",
						"value" 	  => 4000,
						'dependency'  => array(
							'element' => 'slider_autoplay',
							'value'   => array( 'true' ),
							),
						"description" => __( "Slide speed in milliseconds. Default: 200", 'rsaddon' ),
						"group" 	  => __( "Slider Options", 'rsaddon' ),
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
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
						"dependency" => Array('element' => 'type', 'value' => array('Slider')),
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
     
   add_action( 'vc_before_init', 'vc_grassyTeam_mapping' );
     
    // Element HTML
    function vc_grassyTeam_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'                 => '',	
					'description'           => '',	
					'content_align'         => 'text-left',	
					'team_per'              => '-1',			
					'view_details'          => 'View Details',			
					'view_details_show'     => 'true',			
					'appointment_show_btn'  => 'true',			
					'type'                  => 'Slider',	
					'team_col'              => '',
					'excerpt_limit'         => '150',
					'slider_style'          => 'team-slider-style1',
					'grid_style'            => 'team-grid-style1',
					'col_lg'                => '3',
					'col_md'                => '3',
					'col_sm'                => '3',
					'col_xs'                => '2',
					'col_mobile'            => '1',
					'slider_nav'            => 'true',
					'slider_dots'           => 'false',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_autoplay_speed' => '4000',
					'slider_loop'           => 'true',				
					'css'                   => '' ,
					'team_cat'              => '',  
					'cat'                   => '',  
					'pagination_team'       => '',         
					'slider_full'           => '',
					'position'              => ''         
					), 
                $atts,'vc_grassyTeam'
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
		
		//extract content
		

		if(!empty($content)) {
			$atts['content'] = $content;
		} else {
			$atts['content'] = '';
		}

		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 

		$owl_data = array( 
			'nav'                => ( $slider_nav === 'true' ) ? true : false,
			'dots'               => ( $slider_dots === 'true' ) ? true : false,
			'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
			'autoplayTimeout'    => $slider_interval,
			'autoplaySpeed'      => $slider_autoplay_speed,
			'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
			'loop'               => ( $slider_loop === 'true' ) ? true : false,
			'center'             => true,
			'margin'             => 16,
			'responsive'         => array(
				'0'    => array( 'items' => $col_mobile ),
				'576'  => array( 'items' => $col_xs ),
				'768'  => array( 'items' => $col_sm ),
				'992'  => array( 'items' => $col_md ),
				'1200' => array( 'items' => $col_lg ),
				)				
			);
		$owl_data = json_encode( $owl_data );

		//Team data for slick carousel
		$randclass = substr(md5(mt_rand()), 0, 7);
		$team_item_data = array( 
			'slidesToShow'    => $col_lg,
			'nav'             => ( $slider_nav === 'true' ) ? true : false,
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
		wp_localize_script( 'khelo-main', 'team_item_data', $team_item_data );         

		global $khelo_option;

		$hide_details_palyer = empty($khelo_option['show_player_details']) ? 'hide_details_palyer' : '';

        if($type == 'Slider'){
        if($slider_full == "true"){
			$html ='<div class="rs-team '.$slider_style.'">
			<div class="team-slider" id="'.esc_attr( $randclass ).'">';
		}else{
			$html ='<div class="rs-team '.$slider_style.' '.$hide_details_palyer.'">
			<div class="team-carousel owl-carousel owl-navigation-yes owl-center" data-carousel-options="'.esc_attr( $owl_data ).'">';
		}		
		$post_title_show='';
		$description_team='';
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      
        $team_arr_cats = array();
        $team_arr= explode(',', $team_cat);      

		for ($i=0; $i < count($team_arr) ; $i++) { 
           	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
           	// if(is_object($cats)):
           	$team_arr_cats[]= $team_arr[$i];
           	//endif;
        } 
			
        //******************//
        // query post
        //******************//
      
    	 if(!empty($team_cat)) {

	    	if(empty($cat) && !empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(						
				        array(
				            'key' => 'player_position',
				            'value' => $position,
				            'compare' => '=',
				        ),
				    )						
							
				));	  
		    }
		    elseif(empty($cat) && empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,	
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),	
							
				));	  
		    }
		    elseif(!empty($position) && !empty($cat)){    	    
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(
						'relation' => 'AND',
				        array(
							'key'     => 'present_club',
							'value'   => $cat,
							'compare' => '=',
				        ),
				        array(
							'key'     => 'player_position',
							'value'   => $position,
							'compare' => '=',
						),
				    )
				));	  
	    	    }  
	        else{            	
	        	$best_wp = new wp_Query(array(

					'post_type' => 'players',
					'posts_per_page' =>$team_per,
					'paged' => $paged,
					'meta_key'   => 'squad_number',
				    'orderby'    => 'meta_value_num',
				    'order'      => 'ASC',
				    'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(						
				        array(
				            'key' => 'present_club',
				            'value' => $cat,
				            'compare' => '=',
				        ),
				    )
				));	  
	    	}
	    }else{
	    	if(empty($cat) && !empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
					'meta_query' => array(						
				        array(
				            'key' => 'player_position',
				            'value' => $position,
				            'compare' => '=',
				        ),
				    )						
							
				));	  
		    }
		    elseif(empty($cat) && empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,	
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
							
				));	  
		    }
		    elseif(!empty($position) && !empty($cat)){    	    
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
					'meta_query' => array(
						'relation' => 'AND',
				        array(
							'key'     => 'present_club',
							'value'   => $cat,
							'compare' => '=',
				        ),
				        array(
							'key'     => 'player_position',
							'value'   => $position,
							'compare' => '=',
						),
				    )
				));	  
	    	    }  
	        else{            	
	        	$best_wp = new wp_Query(array(

					'post_type' => 'players',
					'posts_per_page' =>$team_per,
					'paged' => $paged,
					'meta_key'   => 'squad_number',
				    'orderby'    => 'meta_value_num',
				    'order'      => 'ASC',				   
					'meta_query' => array(						
				        array(
				            'key' => 'present_club',
				            'value' => $cat,
				            'compare' => '=',
				        ),
				    )
				));	  
	    	}
	    }

		while($best_wp->have_posts()): $best_wp->the_post();
		   $post_title= get_the_title($best_wp->ID);
		   
		    if($title!='No'){
		   		$post_title_show= get_the_title($best_wp->ID);
			}		
					
			$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
			$post_url     =get_post_permalink($best_wp->ID); 
			
			
		    
			if($description!='No'){
		    	$description_team = get_post_meta( get_the_ID(), 'description', true );
			}
		   
			//retrive social icon values
			
			$facebook = get_post_meta( get_the_ID(), 'facebook', true );
			$twitter = get_post_meta( get_the_ID(), 'twitter', true );
			$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
			$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
			$linkedin = get_post_meta( get_the_ID(), 'linkedin', true );
			$appointment = get_post_meta( get_the_ID(), 'appointment', true );
			$appoint_link = get_post_meta( get_the_ID(), 'appoint_link', true );

			$team_excerpt = get_the_excerpt();

			$fb   ='';
			$tw   ='';
			$gp   ='';
			$ldin ='';


			$full_name          = get_post_meta(get_the_ID(),'full_name', true);
			$custom_position    = get_post_meta(  get_the_ID(), 'custom_position', true );
            $player_position    = get_post_meta(get_the_ID(), 'player_position', true);
            $player_sign        = get_post_meta(get_the_ID(),'player-sign', true);
            $squad_numbers      = get_post_meta(get_the_ID(),'squad_number', true);
            $present_club       = get_post_meta(get_the_ID(),'present_club', true);
            $previous_club      = get_post_meta(get_the_ID(),'previous_club', true);
            $debut_club         = get_post_meta(get_the_ID(),'debut_club', true);
            $player_flag        = get_post_meta(get_the_ID(),'player_flag', true);
            $c_short_name        = get_post_meta(get_the_ID(),'c_short_name', true);
            $player_career      = get_post_meta( get_the_ID(), 'player_career', true );
            $player_position = ( !empty( $custom_position )) ? $custom_position : $player_position;

			$ap_details = '';

			if($view_details_show !='No'){
				$ap_details       = '<div class="app_details"><a href="'.$post_url.'">'.$view_details.'</a></div>';
			}
			
			if($facebook      !=''){
				$fb               ='<a href="'.$facebook.'" class="social-icon"><i class="fa fa-facebook"></i></a> ';
			}
			if($twitter       !=''){
				$tw               ='<a href="'.$twitter.'" class="social-icon"><i class="fa fa-twitter"></i></a>';
			}
			if($google_plus   !=''){
				$gp               ='<a href="'.$google_plus.'" class="social-icon"><i class="fa fa-google-plus"></i></a> ';
			}
			if($linkedin      !=''){
				$ldin             ='<a href="'.$linkedin.'" class="social-icon"><i class="fa fa-linkedin"></i></a>';
			}
			
			$team_normal_text = '<h3 class="team-name"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>';			


			if ($slider_style == 'team-slider-style2') {
				$html .='<div class="team-item-wrap">
					   <div class="team-item text-center">
	                        <div class="team-img">
	                            <img src="'.$post_img_url.'" alt="'.$post_title.'" />
								<div class="team-details">
									'.$team_normal_text.'
									<span class="player-position">'.$player_position.'</span>
									<span class="icon-social">
	                                '.$fb.'
									'.$gp.'
									'.$tw.'
									'.$ldin.'
									</span>
								</div>
	                        </div>
	                    </div>				   			    
				</div>';
			}


			elseif($slider_style == 'team-slider-style3') {
				$html .='<div class="rs-team-grid rs-team team-style5">
						<div class="team-item">
							<div class="team-item">
								<div class="team-item-inner">';
									if(!empty($hide_details_palyer)): ;
									$html .='<a href="'.$post_url.'">
										<img src="'.$post_img_url.'" alt="'.$post_title.'" />
									</a>';
									else :
										$html .='<img src="'.$post_img_url.'" alt="'.$post_title.'" />';
									endif;
									
									$html .='<div class="normal-text">
										<span class="squad-numbers">'.$squad_numbers.'</span>
											<a href="'.$post_url.'">'.$post_title_show.'</a>
										<span class="player-position">'.$player_position.'</span>	
									<span class="player-country"><img src="'.$player_flag.'"><span>'.$c_short_name.'</span></span>							
									</div>
								</div>
						  	</div>
					  	</div>
					</div>';
			}

			elseif($slider_style == 'team-slider-style4') {		   
				$html .='<div class="rs-team-grid rs-team team-style4">
					<div class="team-item">
                        <div class="team-item-wrap">
                            <div class="team-img">';
									if(!empty($hide_details_palyer)): ;
									$html .='<a href="'.$post_url.'">
										<img src="'.$post_img_url.'" alt="'.$post_title.'" />
									</a>';
									else :
										$html .='<img src="'.$post_img_url.'" alt="'.$post_title.'" />';
									endif;
									
									$html .='
                                <a href="'.$post_url.'">
									<img src="'.$post_img_url.'" alt="'.$post_title.'" />
								</a>
                                <div class="team-content-style4">
                                	<div class="name-info">
	                                    <h3 class="team-name">
	                                       <a href="'.$post_url.'">'.$post_title_show.'</a>
	                                    </h3>
                                    </div>               
                                    <div class="team-social-4">
                                    	<h3 class="team-link">
	                                       <a href="'.$post_url.'">'.$post_title_show.'</a>
	                                       <span class="player-position2">'.$player_position.'</span>
	                                    </h3>

                                        '.$fb.'
										'.$gp.'
										'.$tw.'
										'.$ldin.'
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
					</div>';
			}

			else {
				$html .='<div class="team-item">
					<div class="team-inner-wrap">
						<div class="image-wrap">
							<img src="'.$post_img_url.'" alt="'.$post_title.'" />
							<div class="social-icons1">
								'.$fb.'
								'.$gp.'
								'.$tw.'
								'.$ldin.'
					        </div>
						</div>

							<div class="team-content1">
							  <h3 class="team-name"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
							  <span class="player-position">'.$player_position.'</span>
							</div>				
			  		</div>
				</div>';
			}				 	
			
		endwhile; 
       	wp_reset_query();
		$html .='</div>
	   <div>
	 </div>
	</div>'
	;
    return $html; 
    }


	if($type == 'Grid'){
		//Slect grid layout
		 $team_col_grid ='';		
		//echo $team_col;
        if($team_col == '2 Column'){
        	$team_col_grid = 6;
        }
        if($team_col == '3 Column'){
        	$team_col_grid = 4;
        }
        if($team_col == '4 Column'){
        	$team_col_grid = 3;
        }
        if($team_col == '6 Column'){
        	$team_col_grid = 2;
        }
        if($team_col == 'Full Width'){
        	$team_col_grid = 12;
        }

        $html='<div class="rs-team-grid rs-team '.$grid_style.' '.$hide_details_palyer.'">
		<div class="row">';		
		$post_title_show='';		
		$description_team='';
			
        //******************//
        // query post
        //******************//     
		
		$team_arr_cats = array();
        $team_arr= explode(',', $team_cat);  
    	for ($i=0; $i < count($team_arr) ; $i++) { 
	       	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
	       	// if(is_object($cats)):
	       	$team_arr_cats[]= $team_arr[$i];
	       	//endif;
	    } 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if(!empty($team_cat)) {

	    	if(empty($cat) && !empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(						
				        array(
				            'key' => 'player_position',
				            'value' => $position,
				            'compare' => '=',
				        ),
				    )						
							
				));	  
		    }
		    elseif(empty($cat) && empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,	
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),	
							
				));	  
		    }
		    elseif(!empty($position) && !empty($cat)){    	    
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(
						'relation' => 'AND',
				        array(
							'key'     => 'present_club',
							'value'   => $cat,
							'compare' => '=',
				        ),
				        array(
							'key'     => 'player_position',
							'value'   => $position,
							'compare' => '=',
						),
				    )
				));	  
	    	    }  
	        else{            	
	        	$best_wp = new wp_Query(array(

					'post_type' => 'players',
					'posts_per_page' =>$team_per,
					'paged' => $paged,
					'meta_key'   => 'squad_number',
				    'orderby'    => 'meta_value_num',
				    'order'      => 'ASC',
				    'tax_query' => array(
					        array(
					            'taxonomy' => 'player-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
					        ),
					    ),
					'meta_query' => array(						
				        array(
				            'key' => 'present_club',
				            'value' => $cat,
				            'compare' => '=',
				        ),
				    )
				));	  
	    	}
	    }else{
	    	if(empty($cat) && !empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
					'meta_query' => array(						
				        array(
				            'key' => 'player_position',
				            'value' => $position,
				            'compare' => '=',
				        ),
				    )						
							
				));	  
		    }
		    elseif(empty($cat) && empty($position)){    			
		        $best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,	
					'paged'          => $paged,	
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
							
				));	  
		    }
		    elseif(!empty($position) && !empty($cat)){    	    
		    	$best_wp = new wp_Query(array(
					'post_type'      => 'players',
					'posts_per_page' =>$team_per,
					'paged'          => $paged,
					'meta_key'       => 'squad_number',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',					
					'meta_query' => array(
						'relation' => 'AND',
				        array(
							'key'     => 'present_club',
							'value'   => $cat,
							'compare' => '=',
				        ),
				        array(
							'key'     => 'player_position',
							'value'   => $position,
							'compare' => '=',
						),
				    )
				));	  
	    	    }  
	        else{            	
	        	$best_wp = new wp_Query(array(

					'post_type' => 'players',
					'posts_per_page' =>$team_per,
					'paged' => $paged,
					'meta_key'   => 'squad_number',
				    'orderby'    => 'meta_value_num',
				    'order'      => 'ASC',				   
					'meta_query' => array(						
				        array(
				            'key' => 'present_club',
				            'value' => $cat,
				            'compare' => '=',
				        ),
				    )
				));	  
	    	}
	    }   
		while($best_wp->have_posts()): $best_wp->the_post();
		   $post_title= get_the_title($best_wp->ID);
		   
		    if($title!='No'){
		   		$post_title_show= get_the_title($best_wp->ID);
			}			

		    $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');

		    $post_url=get_post_permalink($best_wp->ID); 
				
		    
			if($description!='No'){
		    	$description_team = get_post_meta( get_the_ID(), 'description', true );
			}
		   
			//retrive social icon values
			$appointment_schedules = get_post_meta( get_the_ID(), 'appointment_schedule', true );
			$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
			$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
			$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
			$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
			$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
			$show_email  = get_post_meta( get_the_ID(), 'email', true );
			$appointment = get_post_meta( get_the_ID(), 'appointment', true );
			$appoint_link = get_post_meta( get_the_ID(), 'appoint_link', true );
			$fb='';
			$tw='';
			$gp='';
			$ldin='';


			$full_name          = get_post_meta(get_the_ID(),'full_name', true);
			$custom_position    = get_post_meta(  get_the_ID(), 'custom_position', true );
            $player_position    = get_post_meta(get_the_ID(), 'player_position', true);
            $player_sign        = get_post_meta(get_the_ID(),'player-sign', true);
            $squad_numbers      = get_post_meta(get_the_ID(),'squad_number', true);
            $present_club       = get_post_meta(get_the_ID(),'present_club', true);
            $previous_club      = get_post_meta(get_the_ID(),'previous_club', true);
            $debut_club         = get_post_meta(get_the_ID(),'debut_club', true);
            $player_career      = get_post_meta( get_the_ID(), 'player_career', true );
            $player_flag        = get_post_meta(get_the_ID(),'player_flag', true);
            $c_short_name        = get_post_meta(get_the_ID(),'c_short_name', true);


            $player_position = ( !empty( $custom_position )) ? $custom_position : $player_position;


			$ap_details = '';
			if($view_details_show!='No'){
			 	$ap_details = '<div class="app_details"><a href="'.$post_url.'">'.$view_details.'</a></div>';
			}

			if($facebook!=''){
				$fb='<a href="'.$facebook.'" class="social-icon"><i class="fa fa-facebook"></i></a> ';
			}
			if($twitter!=''){
				$tw='<a href="'.$twitter.'" class="social-icon"><i class="fa fa-twitter"></i></a>';
			}
			if($google_plus!=''){
				$gp='<a href="'.$google_plus.'" class="social-icon"><i class="fa fa-google-plus"></i></a> ';
			}
			if($linkedin!=''){
				$ldin='<a href="'.$linkedin.'" class="social-icon"><i class="fa fa-linkedin"></i></a>';
			}

			$team_normal_text = '<h3 class="team-name"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>';


			
			if ($grid_style == 'team-grid-style2') {
				$html .='<div class="col-lg-'.$team_col_grid.' col-md-6 col-sm-6 '.$grid_style.'">	

					<div class="team-item-wrap">
					    <div class="team-item text-center">
	                        <div class="team-img">
	                            <img src="'.$post_img_url.'" alt="'.$post_title.'" />
								<div class="team-details">
									'.$team_normal_text.'
									<span class="player-position">'.$player_position.'</span>
									<span class="icon-social">
	                                '.$fb.'
									'.$gp.'
									'.$tw.'
									'.$ldin.'
									</span>
								</div>
	                        </div>
	                    </div>			    
					</div>

				</div>';
			}


			else if($grid_style == 'team-grid-style3') {
				$html .='<div class="col-lg-'.$team_col_grid.' col-md-6 col-sm-6 '.$grid_style.'">
				<div class="team-item-wrap">
					    <div class="team-img">
						    <div class="team-img-sec">
						    	<a href="'.$post_url.'">
						        	<img src="'.$post_img_url.'" alt="'.$post_title.'" />
						        </a>
					        	<div class="team-content">
							        '.$team_normal_text.'
							        <p class="team-desc">'.$description_team.'</p>				                
				                  	<div class="team-social">			  
				                  	  '.$fb.'
				                	  '.$gp.'
				                	  '.$tw.'
				                	  '.$ldin.'	
				                  	</div>
			                  	</div>
				            </div>
					    </div>				    
				    </div>				    
				</div>';
			}



			elseif($grid_style == 'team-style4') {
			$html .='<div class="team-item col-lg-'.$team_col_grid.' col-md-6 col-sm-6">
					<div class="team-wrapper">
					    <div class="team_photo">
					        <a href="'.$post_url.'">
								<img src="'.$post_img_url.'" class="img_team" alt="'.$post_title.'" />
					        </a>
					    </div>
					    <div class="team_desc">
					        <div class="name">
					        	<a href="'.$post_url.'">'.$post_title_show.'</a>
					        </div>

					        <span class="player-position">'.$player_position.'</span>
							
					        <div class="team-social">
								'.$fb.'
								'.$gp.'
								'.$tw.'
								'.$ldin.'
					        </div>
					    </div>
					</div>
			  	</div>';
			}


			elseif( $grid_style =='team-style5' ){	
				$html .='<div class="col-lg-'.$team_col_grid.' col-md-6 col-sm-6 '.$grid_style.'">
						<div class="team-item">
							<div class="team-item-inner">
								<a href="'.$post_url.'">
									<img src="'.$post_img_url.'" alt="'.$post_title.'" />
								</a>
								
								<div class="normal-text">
									<span class="squad-numbers">'.$squad_numbers.'</span>
										<a href="'.$post_url.'">'.$post_title_show.'</a>
									<span class="player-position">'.$player_position.'</span>	
									<span class="player-country"><img src="'.$player_flag.'"><span>'.$c_short_name.'</span></span>
							
								</div>
							</div>
					  	</div>
		  		</div>';
			}

			else {
				$html .='<div class="col-lg-'.$team_col_grid.' col-md-6 col-sm-6">
					<div class="team-item">
						<div class="team-inner-wrap">
							<div class="image-wrap">
								<a href="'.$post_url.'">
									<img src="'.$post_img_url.'" alt="'.$post_title.'" />
								</a>
								<div class="social-icons1">
									'.$fb.'
									'.$gp.'
									'.$tw.'
									'.$ldin.'
						        </div>
							</div>	
							<div class="team-content1">
							  <h3 class="team-name"><a href="'.$post_url.'">'.$post_title_show.'</a></h3>
							  <span class="player-position">'.$player_position.'</span>
							</div>					
				  		</div>
			  		</div>
				</div>';
			}				 	
			
		endwhile; 
       	wp_reset_query();
		$html .='</div>
	   <div>
	 </div>
	</div>'
	;


	$paginaiton = paginate_links( array(
		'total' => $best_wp->max_num_pages
	));
	if( $paginaiton && $pagination_team == 'yes' ){
		    $pagination_page = paginate_links( array(
		    	'total' => $best_wp->max_num_pages
		    ));
		$html .=  '<div class="pagination-area pagination-gap"><div class="nav-links">'.$pagination_page.'</div></div>';  
	}

        return $html; 
	}
}

add_shortcode( 'vc_grassyTeam', 'vc_grassyTeam_html' );