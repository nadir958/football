<?php
/*
Element Description: Rs Team Box
*/
     
    // Element Mapping
     function vc_fixture_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        $category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );	
        $args = array(
            'taxonomy' => array('league-category'),//ur taxonomy
            'hide_empty' => true,                  
        );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_dropdown[$term->name] = $term->slug;		
		}

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('RS Match Fixture', 'rsaddon'),
                'base' => 'vc_rsfixture',
                'description' => __('Rs fixture Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(	   
					
					array(
						"type" => "dropdown",
						"heading" => __("Select fixtures Style", "rsaddon"),
						"param_name" => "fixtures_style",
						"value" => array(						    
							'Default' => "Default",						
							'Slider' => 'Slider',
							'Sidebar Style' => 'sidebar',						
						),						
					),

					array(
						"type" => "dropdown_multi",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Select Categories", 'rsaddon' ),
						"param_name" => "cat",
						'value' => $category_dropdown,
					),


					array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order", 'rsaddon' ),
					"param_name" => "order",
					"value" => array(							
						'Assending' => "ASC", 
						'Desecnding' => "DESC",
																												
					),
					),

					
					array(
						"type" => "textfield",
						"heading" => __("Fixture Per Pgae", "rsaddon"),
						"param_name" => "team_per",
						'value' =>"-1",
						'description' => __( 'You can write how many team member show. ex(2)', 'rsaddon' ),					
					),

					array(
						"type" => "textfield",
						"heading" => __("Full Fixture Button Text", "rsaddon"),
						"param_name" => "btn_text",						
						"dependency" => Array('element' => 'fixtures_style', 'value' => array('sidebar')),				
					),

					array(
						"type" => "textfield",
						"heading" => __("Button Link", "rsaddon"),
						"param_name" => "btn_text_link",						
						"dependency" => Array('element' => 'fixtures_style', 'value' => array('sidebar')),				
					),

					array(
						"type" => "textfield",
						"heading" => __("VS Text", "rsaddon"),
						"param_name" => "vs_text",						
						'description' => __( 'You can add here VS text', 'rsaddon' ),					
					),

					array(
						"type" => "textfield",
						"heading" => __("Vanue Pretext", "rsaddon"),
						"param_name" => "vanue_text",						
						'description' => __( 'Vanue Pretext', 'rsaddon' ),					
					),	

					array(
						"type"        => "attach_image",
						"heading"     => __( "Background Image", "rsaddon" ),
						"description" => __( "Add Background image", "rsaddon" ),
						"param_name"  => "screenshots",
						"value"       => "",
						'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Team Text Color", "rsaddon" ),
						"param_name" => "team_color",
						"value" => '',
						"description" => __( "Choose team text color here", "rsaddon" ),
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
						"heading" => __( "Date Color", "rsaddon" ),
						"param_name" => "date_color",
						"value" => '',
						"description" => __( "Choose date time color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Time Color", "rsaddon" ),
						"param_name" => "time_color",
						"value" => '',
						"description" => __( "Choose Time color here", "rsaddon" ),
		                'group' => 'Styles',
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Venue Text Color", "rsaddon" ),
						"param_name" => "vanue_color",
						"value" => '',
						"description" => __( "Choose venue text color here", "rsaddon" ),
		                'group' => 'Styles',
					),					

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Venue Pretext Color", "rsaddon" ),
						"param_name" => "venue_text_color",
						"value" => '',
						"description" => __( "Choose Venue Pretext text color here", "rsaddon" ),
		                'group' => 'Styles',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Even Row Bg Color", "rsaddon" ),
						"param_name" => "even_row",
						"value" => '',						
		                'group' => 'Styles',
					),
					

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Odd Row Bg Color", "rsaddon" ),
						"param_name" => "odd_row",
						"value" => '',						
		                'group' => 'Styles',
					),
					
					

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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'rsaddon' ),
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'rsaddon' ),
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'rsaddon' ),
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'rsaddon' ),
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),				
					
				),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Navigation", 'rsaddon' ),
					"param_name" => "slider_nav",
					"value" => array(
						__( 'Disabled', 'rsaddon' ) => 'false',
						__( 'Enabled', 'rsaddon' )  => 'true',
					),
					"description" => __( "Enable or disable navigation arrow. Default: Disable", 'rsaddon' ),
					"group" => __( "Slider Options", 'rsaddon' ),
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),					
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
					
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
					"dependency" => Array('element' => 'fixtures_style', 'value' => array('Slider')),
				),


				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'rsaddon'),
					'param_name'  => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon'),
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
     
   add_action( 'vc_before_init', 'vc_fixture_mapping' );
     
    // Element HTML
     function vc_fixtureslider_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'title'                 => '',	
					'fixtures_style'        => 'Default',
					'vs_text'               => 'VS',
					'vanue_text'            => 'Vanue',
					'team_per'              => '',
					'col_lg'                => '3',
					'col_md'                => '3',
					'col_sm'                => '3',
					'col_xs'                => '2',
					'col_mobile'            => '1',
					'slider_nav'            => 'false',
					'slider_dots'           => 'false',
					'slider_autoplay'       => 'true',
					'slider_stop_on_hover'  => 'true',
					'slider_interval'       => '5000',
					'slider_autoplay_speed' => '200',
					'slider_loop'           => 'true',					
					'team_color'            => '',					
					'versus_color'          => '',
					'cat'                   => '',				
					'date_color'            => '',		
					'time_color'            => '',					
					'vanue_color'           => '',	
					'venue_text_color'      => '',					
					'el_class'              => '',          
					'css'                   => '',
					'order'                 => 'ASC',
					
					'even_row'              => '',
					'odd_row'               => '',
					'btn_text'				=> '',
					'btn_text_link'				=> '',
					
                ), 
                $atts,'vc_rsfixture'
           )
        );
	
        $a = shortcode_atts(array(
			'screenshots' => 'screenshots',
		), $atts);

		$img    = wp_get_attachment_image_src($a["screenshots"], "large");

		$imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}

		if ($imgSrc) {
			$imagebg ='style="background-image: url('.$imgSrc.')"';
		}else{
			$imagebg = "";
		}

        $owl_data = array( 
			'nav'                => ( $slider_nav === 'true' ) ? true : false,
			'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
			'dots'               => ( $slider_dots === 'true' ) ? true : false,
			'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
			'autoplayTimeout'    => $slider_interval,
			'autoplaySpeed'      => $slider_autoplay_speed,
			'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
			'loop'               => ( $slider_loop === 'true' ) ? true : false,
			'margin'             => 30,
			'responsive'         => array(
				'0'    => array( 'items' => $col_mobile ),
				'480'  => array( 'items' => $col_xs ),
				'768'  => array( 'items' => $col_sm ),
				'992'  => array( 'items' => $col_md ),
				'1200' => array( 'items' => $col_lg ),
			)				
		);
		$owl_data = json_encode( $owl_data );

		//extact icon 
		$iconClass = isset( ${'icon_fontawesome'} ) ? esc_attr( ${'icon_fontawesome'} ) : 'fa fa-users';
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

		//custom class added
		$wrapper_classes  = array($el_class) ;			
		$class_to_filter  = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
		$versase          = $vs_text;		
		$team_color       = ($team_color) ? ' style="color: '.$team_color.'"' : '';
		$versus_color     = ($versus_color) ? ' style="color: '.$versus_color.'"' : '';
		$date_color       = ($date_color) ? ' style="color: '.$date_color.'"' : '';
		$time_color       = ($time_color) ? ' style="color: '.$time_color.'"' : '';
		$vanue_color      = ($vanue_color) ? ' style="color: '.$vanue_color.'"' : '';
		$venue_text_color = ($venue_text_color) ? ' style="color: '.$venue_text_color.'"' : '';
		$team_per         = ($team_per) ? $team_per : -1;
		$btn_text		  = !empty($btn_text) ? $btn_text : '';
		$btn_text_link		  = !empty($btn_text_link) ? $btn_text_link : '';


		$table_localize_data  = array(
			'even' => $even_row,
			'odd' => $odd_row
		);
		
		wp_localize_script( 'khelo-main', 'table_row', $table_localize_data );

		//featured area		
		$cat;
            $arr_cats = array();
            $arr= explode(',', $cat);
				for ($i=0; $i < count($arr) ; $i++) { 
               	
               	$arr_cats[]= $arr[$i];
               	
            }

  		if(empty($cat)){
        	$best_wp = new wp_Query(array(
				'post_type'      => 'fixture-results',
				'posts_per_page' => $team_per,
				'meta_key'       => 'match_date',
				'orderby'        => 'meta_value',
				'order'          => $order,				
				'meta_query' => array(				    
				    array(
				     'key' => 'total_goal',
				     'compare' => 'NOT EXISTS'
				    ),					 
				)
			));	  
        }else{
	    	$best_wp = new wp_Query(array(
				'post_type'      => 'fixture-results',
				'posts_per_page' => $team_per,
				'meta_key'       => 'match_date',
				'orderby'        => 'meta_value',
				'order'          => $order,					
				'meta_query' => array(
					
				    array(
				     'key' => 'total_goal',
				     'compare' => 'NOT EXISTS'
				    ),
				     
				),
				'tax_query' => array(
			        array(
			            'taxonomy' => 'league-category',
			            'field' => 'slug', //can be set to ID
			            'terms' => $arr_cats//if field is ID you can reference by cat/term number
			        ),
			    )
		));
	    }

    		
    	if( $fixtures_style == 'Slider' ){

			$html ='<div class="match-list team-carousel owl-carousel owl-navigation-yes match-slider-styles '.$css_class_custom.' '.$css_class.'" data-carousel-options="'.esc_attr( $owl_data ).'">';

				while($best_wp->have_posts()): $best_wp->the_post();
					$match_title = get_the_title();
					$team1       = get_post_meta( get_the_ID(), 'team1', true );
					$team2       = get_post_meta( get_the_ID(), 'team2', true );
					$date        = get_post_meta( get_the_ID(), 'match_date', true );
					$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
					$match_date  = date_i18n('F d Y', $date );
					$match_time  = date_i18n('H:i', $date );
					$team_logo = '';
					$team_one = '';
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

					$team_two =  '';
					$team_logo2 = '';

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
					$vanue = '';
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
	            	$html .= '
	                <div class="fixture-item" '.$imagebg.'>
	                	
	                	<div class="mid-sec">
	                		<div class="medium-font" '.$team_color.'>
	                			'.$team_logo.'
	                			'.$team_one.'
	                		</div>
		                    <div class="big-font" >
								<div class="top-date-sec">	
			                    	<span '.$date_color.' class="match-date">'.$match_date.'</span>
			                    	<span  '.$time_color.' class="match-time">'.$match_time.'</span>
			                	</div>
                                <span class="versase" '.$versus_color.'>'.$versase.'</span>
		                    </div>

		                    <div class="medium-font" '.$team_color.'>
		                    	'.$team_logo2.'
		                    	'.$team_two.'
		                    </div>
	                	</div>

	                	<div class="match-venue">
	                		<span '.$vanue_color.'><span class="venue-text" '.$venue_text_color.'>'.$vanue_text.'</span> '. $vanue.'</span>
	                	</div>
	                </div>';
		           
					endwhile;
			    	wp_reset_query();
            $html .='</div>';
        } 

        elseif($fixtures_style == 'sidebar' )
        {
        	$html ='<div class="match-list sidebar-style '.$css_class_custom.' '.$css_class.'" '.$imagebg.'>
	        	<div class="match-table">
	            ';

				while($best_wp->have_posts()): $best_wp->the_post();
					$match_title = get_the_title();
					$team1       = get_post_meta( get_the_ID(), 'team1', true );
					$team2       = get_post_meta( get_the_ID(), 'team2', true );
					$date        = get_post_meta( get_the_ID(), 'match_date', true );
					$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
					$match_date  = date_i18n('F d Y', $date );
					$match_time  = date_i18n('H:i', $date );


					$team_logo = '';
					$team_one = '';
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
					$team_two =  '';
					$team_logo2 = '';   
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
					$vanue = '';
		            if(!empty($team_home)){
		                $team_home_query = new WP_Query( array(
							'post_type'   => 'club',
							'post_status' => 'publish',
							'p'           => $team_home,
		                ));

		                if ( $team_home_query->have_posts() ) :
		                    while ( $team_home_query->have_posts() ) :
		                        $team_home_query->the_post();                        	
		                        	$vanue = get_post_meta( get_the_ID(), 'club_stadium', true );   
		                    endwhile;
		                    wp_reset_query();
		                endif;
		            }
	            	$html .= '
	            	<div class="sidebar-fixture">
	            	<div class="list-1">
	            	'.$team_logo.'<span '.$team_color.'>'.$team_one.'</span>
	            	</div>
	            	<div class="list-2">
	            		<table>
	            		<tr>	                                 
	                    
	                     <td class="sidebar_middle"><span '.$date_color.'>'.$match_date.'</span> 
	                     <span class="match_time" '.$time_color.'>'.$match_time.'</span>
	                     <span '.$vanue_color.'>'.$vanue.'</span></td>	
	                                   
	                    
	                    </tr>
	            		</table>
	            	</div>
	            	<div class="list-3">
	            	'.$team_logo2.' <span '.$team_color.'>'.$team_two.' </span>
	            	</div>
	            	</div>
	               ';
		           
					endwhile;
			    	wp_reset_query();
			    	if(!empty($btn_text)) : 
				$html .='
				<div class="link">
					<a href="'.$btn_text_link.'">'.$btn_text.'</a> 
				</div>';
			endif;

            $html .='</div>
            </div>';
        }

        else {

        	$html ='<div class="match-list '.$css_class_custom.' '.$css_class.'" '.$imagebg.'>
	        	<table class="match-table">
	            <tbody>';

				while($best_wp->have_posts()): $best_wp->the_post();
					$match_title = get_the_title();
					$team1       = get_post_meta( get_the_ID(), 'team1', true );
					$team2       = get_post_meta( get_the_ID(), 'team2', true );
					$date        = get_post_meta( get_the_ID(), 'match_date', true );
					$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
					$match_date  = date_i18n('F d Y, H:i', $date );
					$team_one =  '';
					$team_logo = '';
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
					$team_logo2 = '';
					$team_two = '';
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
					$vanue = '';
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
	            	$html .= '
	                <tr>
	                     <td class="medium-font" '.$team_color.'>'.$team_one.'</td>
	                     <td class="big-font" '.$versus_color.'>'.$versase.'</td>
	                     <td class="medium-font" '.$team_color.'>'.$team_two.'</td>
	                     <td '.$date_color.'>'.$match_date.'</td>
	                     <td '.$vanue_color.'>'.$vanue.'</td>
	                </tr>';
		           
					endwhile;
			    	wp_reset_query();
				$html .='</tbody>
                </table>
            </div>';
        }
	return $html;
}

add_shortcode( 'vc_rsfixture', 'vc_fixtureslider_html' );