<?php
/*
	Element Description: Rs Latest Product Slider
*/
 if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
}     
// Element Mapping
if ( !class_exists( 'RSTheme_VC_Top_Player_Slider' ) ) {    
         
    class RSTheme_VC_Top_Player_Slider extends RSTheme_VC_Modules {
		public function __construct(){
			$this->name = __( "RS Top Player", 'eshkool' );
			$this->base = 'rs_top_player_slider';				
			parent::__construct();
		}     
       
		public function fields(){

			//category for team

	        $category_team = array( __( 'All Categories', 'rsaddon' ) => '0' );	
	        $args = array(
	            'taxonomy' => array('player-category'),//ur taxonomy
	            'hide_empty' => true,                  
	        );

			$terms_= new WP_Term_Query( $args );
			foreach ( (array)$terms_->terms as $term ) {
				$category_team[$term->name] = $term->slug;		
			}

			$fields = array(

				array(
					"type" => "dropdown",
					"heading" => __("Select Style", "rsaddon"),
					"param_name" => "player_style",
					"value" => array(						    
						'Slider 1' => "Slider 1",						
						'Slider 2' => 'Slider 2',						
						'Slider 3' => 'Slider 3',						
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
					"type" => "textfield",
					"heading" => __("Player Per Pgae", "eshkool"),
					"param_name" => "player_per",
					'value' =>"6",
					'description' => __( 'You can write how many player show. ex(2)', 'eshkool' ),					
				),


				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content Background Color", "rsaddon" ),
					"param_name" => "content_bg",
					"value" => '',
					"description" => __( "Choose content background color here", "rsaddon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title Color", "rsaddon" ),
					"param_name" => "title_color",
					"value" => '',
					"description" => __( "Choose title color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Squad Numbers Color", "rsaddon" ),
					"param_name" => "number_color",
					"value" => '',
					"description" => __( "Choose squad numbers color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Player Position Text Color", "rsaddon" ),
					"param_name" => "player_color",
					"value" => '',
					"description" => __( "Choose player-position text color here", "rsaddon" ),
	                'group' => 'Styles',
				),
									 
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'eshkool' ),
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
					"group" 	  => __( "Slider Options", 'eshkool' ),
				
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'eshkool' ),
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
					"group" 	  => __( "Slider Options", 'eshkool' ),
				
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'eshkool' ),
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
					"group" 	  => __( "Slider Options", 'eshkool' ),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'eshkool' ),
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
					"group" 	  => __( "Slider Options", 'eshkool' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'eshkool' ),
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
					"group" 	  => __( "Slider Options", 'eshkool' ),
					
					),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'eshkool' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'eshkool' ) => 'false',
						__( 'Enabled', 'eshkool' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'eshkool' ),
					"group" => __( "Slider Options", 'eshkool' ),					
					
				),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Navigation", 'eshkool' ),
					"param_name" => "slider_nav",
					"value" => array(
						__( 'Disabled', 'eshkool' ) => 'false',
						__( 'Enabled', 'eshkool' )  => 'true',
						),
					"description" => __( "Enable or disable navigation arrow. Default: Disable", 'eshkool' ),
					"group" => __( "Slider Options", 'eshkool' ),					
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'eshkool' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "eshkool" )  => 'true',
						__( "Disable", "eshkool" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'eshkool' ),
					"group" => __( "Slider Options", 'eshkool' ),
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'eshkool' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "eshkool" )  => 'true',
						__( "Disable", "eshkool" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'eshkool' ),
					"group" => __( "Slider Options", 'eshkool' ),
					
				),

				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'eshkool' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "eshkool" )  => '5000',
						__( "4 Seconds", "eshkool" )  => '4000',
						__( "3 Seconds", "eshkool" )  => '3000',
						__( "2 Seconds", "eshkool" )  => '4000',
						__( "1 Seconds", "eshkool" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'eshkool' ),
					"group" 	  => __( "Slider Options", 'eshkool' ),
				
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'eshkool' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'eshkool' ),
					"group" 	  => __( "Slider Options", 'eshkool' ),
				
				),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'eshkool' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "eshkool" )  => 'true',
						__( "Disable", "eshkool" ) => 'false',
						),
					"description"=> __( "Loop to first item. Default: Enable", 'eshkool' ),
					"group" 	 => __( "Slider Options", 'eshkool' ),
					
				),

				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'eshkool' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'eshkool' ),
		     
				),     
			); 
	        return $fields;                                   
	    }    

     
    // Element HTML
    public function shortcode( $atts, $content = '' ) {
        $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'content_bg'           	=> '',				
					'title_color'           => '',				
					'player_color'          => '',				
					'number_color'          => '',				
					'player_per'           	=> '6',				
					'player_style'          => 'Slider 1',				
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
					'css'                   => '' , 
					'team_cat'				=> '',               
                ), 
                $atts,'rs_top_player_slider'
           		)
        	);	


			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='glyph-icon flaticon-back-2'></i>", "<i class='glyph-icon flaticon-arrow'></i>" ),
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

			
			



			$title_color  = ($title_color) ? ' style="color: '.$title_color.'"' : '';
			$number_color = ($number_color) ? ' style="color: '.$number_color.'"' : '';
			$player_color = ($player_color) ? ' style="color: '.$player_color.'"' : '';
			$content_bg   = ($content_bg) ? ' style="background: '.$content_bg.'"' : '';


        	switch ( $player_style ) {
				case 'Slider 2':
				$template = 'top-player-slider2';
				break;

				case 'Slider 3':
				$template = 'top-player-slider3';
				break;
				
				default:
				$template = 'top-player-slider';
				break;
			}
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RSTheme_VC_Top_Player_Slider;