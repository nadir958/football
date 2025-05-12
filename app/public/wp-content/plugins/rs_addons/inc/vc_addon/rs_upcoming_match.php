<?php
/*
Element Description: Rs Team Box
*/
     
    // Element Mapping
     function vc_upcoming_slider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('RS Upcoming Match Slider', 'rsaddon'),
                'base' => 'vc_rsupcomingslider',
                'description' => __('Rs upcoming Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                	array(
                		"type" => "dropdown",
                		"heading" => __("Style", 'rsaddon'),
                		"param_name" => "slider_style",
                		"value" => array(	
                			__('Slider', 'rsaddon') => "slider", 
                			__('Grid', 'rsaddon') => "grid",
                		),
                		'description' => __( 'Select your upcoming slider style here.', 'rsaddon' ),                		
                	),

                	array(
                		"type" => "dropdown",
                		"heading" => __("Slider Design", 'rsaddon'),
                		"param_name" => "slider_design",
                		"value" => array(	
                			__('Slider Style 1', 'rsaddon') => "style1", 
                			__('Slider Style 2', 'rsaddon') => "style2",
                		),
                		'description' => __( 'Select your upcoming slider design here.', 'rsaddon' ),  
                		"dependency" => Array('element' => 'slider_style', 'value' => array('slider')),            		
                	),	
					
					array(
						"type" => "textfield",
						"heading" => __("Upcoming Match Per Page", "rsaddon"),
						"param_name" => "team_per",
						'value' =>"-1",
						'description' => __( 'You can write how many team member show. ex(2)', 'rsaddon' ),					
					),

					array(
						"type" => "textfield",
						"heading" => __("VS Text", "rsaddon"),
						"param_name" => "vs_text",						
						'description' => __( 'You can add here VS text', 'rsaddon' ),					
					),

					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Number of columns ( Desktops > 1199px )", 'rsaddon'),
						"param_name" => "col_lg",
						"value" => array(							
							'1' => "1", 
							'2' => "2",
							'3' => "3",	
							'4' => "4",
							'5' => "5",
							'6' => "6",																						
						),
						"std" => "1",
						"group" 	  => __( "Slider Options", 'rsaddon'),

					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Number of columns ( Desktops > 991px )", 'rsaddon'),
						"param_name" => "col_md",
						"value" => array(							
							'1' => "1", 
							'2' => "2",
							'3' => "3",	
							'4' => "4",
							'5' => "5",
							'6' => "6",																						
						),
						"std" => "1",
						"group" 	  => __( "Slider Options", 'rsaddon'),
						
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Number of columns ( Tablets > 767px )", 'rsaddon'),
						"param_name" => "col_sm",
						"value" => array(							
							'1' => "1", 
							'2' => "2",
							'3' => "3",	
							'4' => "4",
							'5' => "5",
							'6' => "6",																						
						),
						"std" => "1",
						"group" 	  => __( "Slider Options", 'rsaddon'),
						
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Number of columns ( Phones < 768px )", 'rsaddon'),
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
						"group" 	  => __( "Slider Options", 'rsaddon'),
						"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Number of columns ( Small Phones < 480px )", 'rsaddon'),
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
						"group" 	  => __( "Slider Options", 'rsaddon'),
						
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Title Color", "rsaddon" ),
						"param_name" => "title_color",
						"value" => '',
						"description" => __( "Choose Title text color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Item Background Color", "rsaddon" ),
						"param_name" => "item_bg",
						"value" => '',
						"description" => __( "Choose item background color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Date Color", "rsaddon" ),
						"param_name" => "date_color",
						"value" => '',
						"description" => __( "Choose date date color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Time Color", "rsaddon" ),
						"param_name" => "time_color",
						"value" => '',
						"description" => __( "Choose date time color here", "rsaddon" ),
		                'group' => 'Styles',
					),
					
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Versus Text Color", "rsaddon" ),
						"param_name" => "versus_color",
						"value" => '',
						"description" => __( "Choose versus text color here", "rsaddon" ),
		                'group' => 'Styles',
					),
					
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Versus Text Color", "rsaddon" ),
						"param_name" => "cat_color",
						"value" => '',
						"description" => __( "Choose versus text color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Club Title Color", "rsaddon" ),
						"param_name" => "club_color",
						"value" => '',
						"description" => __( "Choose club text color here", "rsaddon" ),
		                'group' => 'Styles',
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
					"description" => __( "Enable or disable navigation arrow. Default: Disable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),					
					
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
     
   add_action( 'vc_before_init', 'vc_upcoming_slider_mapping' );
     
    // Element HTML
     function vc_upcomingslider_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'                 => '',
					'item_bg'           	=> '#ffffff',
					'club_color'            => '#111111',
					'title_color'           => '#111111',
					'date_color'            => '#555555',
					'time_color'            => '#555555',
					'versus_color'          => '#fbc02d',
					'cat_color'          	=> '#555555',
					'slider_style'          => 'slider',	
					'slider_design'         => 'style1',	
					'team_per'              => '',				
					'icon_fontawesome'      => 'fa fa-users',
					'col_lg'                => '1',
					'col_md'                => '1',
					'col_sm'                => '1',
					'col_xs'                => '1',
					'col_mobile'            => '1',
					'slider_nav'            => '',
					'vs_text'				=> 'VS',
					'slider_dots'           => '',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_autoplay_speed' => '200',
					'slider_loop'           => 'true',				
					'css'                   => ''            
                ), 
                $atts,'vc_rsupcomingslider'
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

		//extact icon 
		$iconClass = isset( ${'icon_fontawesome'} ) ? esc_attr( ${'icon_fontawesome'} ) : 'fa fa-users';
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		$team_per = ($team_per) ? $team_per : -1;

		$owl_data = array( 
			'nav'                => ( $slider_nav === 'true' ) ? true : false,
			'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
			'dots'               => ( $slider_dots === 'true' ) ? true : false,
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

		$versase = $vs_text;

		//featured area
    	$best_wp = new wp_Query(array(
				'post_type' => 'fixture-results',
				'posts_per_page' => $team_per,
				'meta_query' => array(
				    array(
				     'key' => 'total_goal',
				     'compare' => 'NOT EXISTS'
				    ),
				)
		));

		if( $slider_style == 'slider' ){
			$html ='<div class="upcoming-section '.$css_class.'">
				<div class="umatch-carousel umatch-matches owl-carousel owl-navigation-yes" data-carousel-options="'.esc_attr( $owl_data ).'">';

			while($best_wp->have_posts()): $best_wp->the_post();
				$match_title = get_the_title();
				$match_logo  = get_the_post_thumbnail($best_wp->ID);
				$team1       = get_post_meta( get_the_ID(), 'team1', true );
				$team2       = get_post_meta( get_the_ID(), 'team2', true );
				$date        = get_post_meta( get_the_ID(), 'match_date', true );
				$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
				$match_date  = date('H:i', $date );
				$match_date2 = date('F d Y', $date );
				$match_date3 = date('F d', $date );
				$cat         = get_the_term_list( $best_wp->ID, 'league-category');	

				if(!empty($team1)){
	                $team_one_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team1,
	                ));

	                if ( $team_one_query->have_posts() ) :
	                    while ( $team_one_query->have_posts() ) :
	                        $team_one_query->the_post();
	                        	$team_one =  get_the_title();
	                        	$team_logo = get_the_post_thumbnail($best_wp->ID);   
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

	            if(!empty($team2)){
	                $team_two_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team2,
	                ));

	                if ( $team_two_query->have_posts() ) :
	                    while ( $team_two_query->have_posts() ) :
	                        $team_two_query->the_post();
	                        	$team_two =  get_the_title();
	                        	$team_logo2 = get_the_post_thumbnail($best_wp->ID);    
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

	            if(!empty($team_home)){
	                $team_home_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team_home,
	                ));

	                if ( $team_home_query->have_posts() ) :
	                    while ( $team_home_query->have_posts() ) :
	                        $team_home_query->the_post();                        	
	                        	$vanue = get_post_meta( get_the_ID(), 'club_stadium', true );   
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

	            if( $slider_design == 'style2' ){
	            	$html .= '<div class="item upcoming-match2" style="background:'.$item_bg.'">
	            		<span class="stadium" style="color:'.$title_color.'">'.$vanue.'</span>
						<div class="rs-match-style2">
	                        <div class="match-item first">
	                            '.$team_logo.'
	                            <h4 style="color:'.$club_color.'">'.$team_one.'</h4>
	                        </div>
	                        <div class="match-item middle">                        	
	                            <span class="date3" style="color:'.$date_color.'">'.$match_date3.', '.$match_date.'</span>
	                            <span class="vs2" style="color:'.$versus_color.'">'.$versase.'</span>	                           
	                        </div>
	                        <div class="match-item last">
	                            '.$team_logo2.'
	                            <h4 style="color:'.$club_color.'">'.$team_two.'</h4>
	                        </div>
	                    </div>
	                    <span class="cat" style="color:'.$cat_color.'">'.$cat.'</span>
	                </div>';
	            }

				else{
				$html .= '<div class="item">
					<div class="row">
                        <div class="col-lg-4 col-sm-4 col-xs-12 first">
                            '.$team_logo.'
                            <h4>'.$team_one.'</h4>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-12">
                            <span class="date2">'.$match_date2.'</span>
                            <span class="date">'.$match_date.'</span>
                            <span class="vs">'.$versase.'</span>
                            <span>'.$vanue.'</span>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-12 last">
                            '.$team_logo2.'
                            <h4>'.$team_two.'</h4>
                        </div>
                    </div>
                </div>';
				}
			endwhile;
	    	wp_reset_query();
			$html .='</div>
		  		</div>';
		return $html;
	}

	else{
			$html ='<div class="upcoming-section">
				<div class="umatch-matches grid-style">';

			while($best_wp->have_posts()): $best_wp->the_post();
				$match_title = get_the_title();
				$match_logo  = get_the_post_thumbnail($best_wp->ID);
				$team1       = get_post_meta( get_the_ID(), 'team1', true );
				$team2       = get_post_meta( get_the_ID(), 'team2', true );
				$date        = get_post_meta( get_the_ID(), 'match_date', true );
				$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
				$match_date  = date('H:i', $date );
				$match_date2  = date('F d Y', $date );

				if(!empty($team1)){
	                $team_one_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team1,
	                ));

	                if ( $team_one_query->have_posts() ) :
	                    while ( $team_one_query->have_posts() ) :
	                        $team_one_query->the_post();
	                        	$team_one =  get_the_title();
	                        	$team_logo = get_the_post_thumbnail($best_wp->ID);   
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

	            if(!empty($team2)){
	                $team_two_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team2,
	                ));

	                if ( $team_two_query->have_posts() ) :
	                    while ( $team_two_query->have_posts() ) :
	                        $team_two_query->the_post();
	                        	$team_two =  get_the_title();
	                        	$team_logo2 = get_the_post_thumbnail($best_wp->ID);    
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

	            if(!empty($team_home)){
	                $team_home_query = new WP_Query( array(
	                    'post_type' => 'club',
	                    'post_status' => 'publish',
	                    'p' => $team_home,
	                ));

	                if ( $team_home_query->have_posts() ) :
	                    while ( $team_home_query->have_posts() ) :
	                        $team_home_query->the_post();                        	
	                        	$vanue = get_post_meta( get_the_ID(), 'club_stadium', true );   
	                    endwhile;
	                    wp_reset_query();
	                endif;
	            }

				$html .= '<div class="item">
							<div class="row">
		                        <div class="col-lg-4 col-sm-4 col-xs-12 first">
		                            '.$team_logo.'
		                            <h4>'.$team_one.'</h4>
		                        </div>
		                        <div class="col-lg-4 col-sm-4 col-xs-12">
		                            <span class="date">'.$match_date.'</span>
		                            <span class="vs">'.$versase.'</span>
		                            <span>'.$vanue.'</span>
		                        </div>
		                        <div class="col-lg-4 col-sm-4 col-xs-12 last">
		                            '.$team_logo2.'
		                            <h4>'.$team_two.'</h4>
		                        </div>
		                    </div>
	                    </div>';
			endwhile;
	    	wp_reset_query();
			$html .='</div>
		  		</div>';
		return $html;
	}
}

add_shortcode( 'vc_rsupcomingslider', 'vc_upcomingslider_html' );