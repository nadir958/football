<?php
/*
Element Description: Point Table
*/
if ( !defined( 'WPB_VC_VERSION' ) ) {
	return;
}


if ( !class_exists( 'RSTheme_VC_Match_Recent_Results' ) ) {   
	
	
        // Stop all if VC is not enabled       
	
	

        // Map the block with vc_map()
	class RSTheme_VC_Match_Recent_Results extends RSTheme_VC_Modules {
		public function __construct(){
			$this->name = __( "RS Recent Match Result", 'rsaddon' );
			$this->base = 'rs_recent_result';				
			parent::__construct();
		}     
		
		public function fields(){

			$category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );	
			$args = array(
	            'taxonomy' => array('league-category'),//ur taxonomy
	            'hide_empty' => true,                  
	        );

			$terms_= new WP_Term_Query( $args );

			foreach ( (array)$terms_->terms as $term ) {
				$category_dropdown[$term->name] = $term->slug;		
			}

			$fields = array(

				array(
					"type" => "dropdown_multi",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Select Categories", 'rsaddon' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
				),


				array(
					"type"       => "textfield",
					"class"      => "",
					"heading"    => __( "Recent Match Title", 'rsaddon' ),
					"param_name" => "custom_title",
					'value'      => __( "Last Match Result", 'rsaddon' ),
				),

				array(
					"type"        => "attach_image",
					"heading"     => __( "Background Image", "rsaddon" ),
					"description" => __( "Add Background image", "rsaddon" ),
					"param_name"  => "screenshots",
					"value"       => "",
				), 	

				array(
					"type" => "dropdown",
					"heading" => __("Select Style", "rsaddon"),
					"param_name" => "result_style",
					"value" => array(						    
						'Style 1' => "Default",						
						'Style 2' => 'Slider',						
						'Style 3' => 'style3',						
						'Style 4' => 'style4',						
					),						
				),

				array(
					"type" => "textfield",
					"heading" => __("Result Per Page On Slider", 'rsaddon'),
					"param_name" => "post_per_slider",
					'description' => __( 'Write -1 to show all', 'rsaddon' ),
					"dependency" => Array('element' => 'result_style', 'value' => array('Default', 'style3')),										
				),

				array(
					"type" => "dropdown",
					"heading" => __("Show More Previous Result On Grid", "rsaddon"),
					"param_name" => "grid_result",
					"value" => array(						    
						'Yes' => "yes",						
						'No' => 'no',						
					),
					"dependency" => Array('element' => 'result_style', 'value' => array('Default', 'style3')),						
				),

				array(
					"type" => "textfield",
					"heading" => __("Result Per Page On Grid", 'rsaddon'),
					"param_name" => "post_per_grid",
					'description' => __( 'Write -1 to show all', 'rsaddon' ),
					"dependency" => Array('element' => 'grid_result', 'value' => array('yes')),										
				),

				array(
					"type" => "textfield",
					"heading" => __("View All Text", 'rsaddon'),
					"param_name" => "more_text",
					'value'       => __( 'View All', 'rsaddon'),
					'description' => __( 'Type your read more text here', 'rsaddon' ),
					"dependency" => Array('element' => 'grid_result', 'value' => array('yes')),	
				),

				array(
					"type"        => "textfield",
					"heading"     => __("View All Link", 'rsaddon'),
					"param_name"  => "more_text_link",					
					'description' => __( 'Type your read more link here', 'rsaddon' ),
					"dependency"  => Array('element' => 'grid_result', 'value' => array('yes')),	
				),

				array(
					"type"       => "textfield",
					"class"      => "",
					"heading"    => __( "Previous Result Title", 'rsaddon' ),
					"param_name" => "previous_title",
					'value'      => __( "Previous Results", 'rsaddon' ),
					"dependency"  => Array('element' => 'grid_result', 'value' => array('yes')),
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
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Item Background", "rsaddon" ),
					"param_name" => "item_bg",
					"value" => '',
					"description" => __( "Choose Item Background color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Score Color", "rsaddon" ),
					"param_name" => "score_color",
					"value" => '',
					"description" => __( "Choose score color here", "rsaddon" ),
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
					"heading" => __( "Date Color", "rsaddon" ),
					"param_name" => "date_color",
					"value" => '',
					"description" => __( "Choose Date color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content Color", "rsaddon" ),
					"param_name" => "desc_color",
					"value" => '',
					"description" => __( "Choose content color here", "rsaddon" ),
	                'group' => 'Styles',
				),
				
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'js_composer' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
				),
				
				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'rsaddon' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'rsaddon' ),
				),              
				
			);                                
return $fields; 
}



    // Element HTML
public function shortcode ( $atts, $content ='' ) {
	$attributes = array();
        // Params extraction
	extract(
		shortcode_atts(
			array(				
				'el_class'              => '',
				'col_lg'                => '3',
				'col_md'                => '3',
				'col_sm'                => '3',
				'col_xs'                => '2',
				'col_mobile'            => '1',
				'slider_nav'            => 'false',
				'item_bg'               => '#214790',
				'slider_dots'           => 'false',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				'result_style'          => 'Default',					
				'post_per_slider'       => '',					
				'grid_result'           => 'yes',					
				'post_per_grid'         => '',					
				'custom_title'          => 'Last Match Result',					
				'previous_title'        => 'Previous Results',					
				'more_text'             => 'View All',					
				'score_color'           => '#fff',					
				'title_color'           => '',					
				'date_color'            => '',					
				'desc_color'            => '',					
				'more_text_link'        => '',					
				'css'                   => '',
				'cat'                   => ''				
				
			), 
			$atts,'rs_recent_result'
		)
	);

	$taxonomy = '';
	
	$a = shortcode_atts(array(
		'screenshots' => 'screenshots',
	), $atts);

	$img = wp_get_attachment_image_src($a["screenshots"], "large");
	$imgSrc = '';
	if(isset($img[0])) {
		$imgSrc = $img[0];
	}

	if ($imgSrc) {
		$imageClass='<img src="'.$imgSrc.'" alt="rs-result" />';
	}else{
		$imageClass= "";
	}
	

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

		//extact icon 		
		//extract css edit box
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
	
		 //custom class added
	$wrapper_classes = array($el_class) ;			
	$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
	$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

	$score_color = ($score_color) ? ' style="color: '.$score_color.'"' : '';
	$title_color = ($title_color) ? ' style="color: '.$title_color.'"' : '';
	$date_color = ($date_color) ? ' style="color: '.$date_color.'"' : '';
	$desc_color = ($desc_color) ? ' style="color: '.$desc_color.'"' : '';
	$recent_title    = ($custom_title) ? '<h4 '.$title_color.'>'.wp_kses_post($custom_title).'</h4>' : '';
	$pre_result_title    = ($previous_title) ? '<h4 '.$title_color.'>'.wp_kses_post($previous_title).'</h4>' : '';
	$readmore_text = (!empty($more_text)) ? '<div class="view-all-result"><a href="'.esc_url($more_text_link).'">'.$more_text.' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>' : '';

	$post_per_slider = (!empty($post_per_slider)) ? $post_per_slider : 3;
	$post_per_grid   = (!empty($post_per_grid)) ? $post_per_grid : 3;
	if (!function_exists('result_find_club')) {
		function result_find_club($team){
			$args =new wp_Query(array(
				'post_type' => 'club',  
				'p' => $team       
			));		
			
			if ( $args->have_posts() ) {		
				$team = get_the_post_thumbnail($team) .' '.get_the_title($team);

				return $team;		 
				
			}
		}
	}

	//checking Result  style
	switch ( $result_style ) {

		case 'Slider':
			$template = 'result-recent2';
		break;

		case 'style4':
			$template = 'result-recent4';
		break;

		case 'style3':
			$template = 'result-recent3';
		break;
		
		default:
			$template = 'result-recent';
		break;
	}

	return $this->template( $template, get_defined_vars() );
}

}

}
new RSTheme_VC_Match_Recent_Results;