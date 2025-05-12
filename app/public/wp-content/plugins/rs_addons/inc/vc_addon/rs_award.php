<?php
/*
Element Description: RS Client elements
*/
// Element Mapping

function RSTheme_VC_Champion_Award() {

	// Stop all if VC is not enabled
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	$event_id = '';
    $args = array(
		'post_type'           => 'club',
		'meta_key'            => 'club_champion',
		'posts_per_page'      => -1,
		'suppress_filters'    => false,
		'ignore_sticky_posts' => 1,
    );

    $posts_array = get_posts( $args );

    if( !empty( $posts_array ) ){

        foreach ( $posts_array as $post ) {
            $post_dropdown[$post->post_title] = $post->ID;                  
        }        
        $event_id = $posts_array[0]->ID;
    }
    else {
        $post_dropdown = $event_id;
    }

	// Map the block with vc_map()
	vc_map( 
		array(
			'name' => __('RS Champion Awards', 'rsconstruction'),
			'base' => 'vc_champion_awrard',
			'description' => __('RS Champion Awards', 'rsconstruction'), 
			'category' => __('by RS Theme', 'rsconstruction'),   
			'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',    
			'params' => array(

				array(
					'type' => 'textfield',
					'holder' => 'h3',
					'class' => 'title-class',
					'heading' => __( 'Post Per Page', 'brickx'),
					'param_name' => 'title',
					'value' => __( '6', 'brickx'),				
					'admin_label' => false,
					'weight' => 0,
					'description' => __( 'Write -1 to show all', 'brickx'),	
				), 


				array(
                    "type"       => "dropdown",
                    "holder"     => "div",
                    "class"      => "",
                    "heading"    => __( "Select A Club", 'rsaddon' ),
                    "param_name" => "club_title",
                    'value'      => $post_dropdown,
                ),

                array(
				    "type" => "dropdown",
				    "heading" => __("Show Champion Year", "rsaddon"),
				    "param_name" => "show_year",
				    "value" => array(
				        __( 'Yes', 'rsaddon') => 'yes',
				        __( 'No', 'rsaddon')  => 'no',
				    ),
				),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'brickx'),
					"param_name" => "col_lg",
					"value" => array(							
						'1' => "1", 
						'2' => "2",
						'3' => "3",	
						'4' => "4",
						'5' => "5",
						'6' => "6",																						
					),
					"std" => "6",
					"group" 	  => __( "Slider Options", 'brickx'),

				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'brickx'),
					"param_name" => "col_md",
					"value" => array(							
						'1' => "1", 
						'2' => "2",
						'3' => "3",	
						'4' => "4",
						'5' => "5",
						'6' => "6",																						
					),
					"std" => "6",
					"group" 	  => __( "Slider Options", 'brickx'),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'brickx'),
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
					"group" 	  => __( "Slider Options", 'brickx'),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'brickx'),
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
					"group" 	  => __( "Slider Options", 'brickx'),
					"dependency" => Array('element' => 'blog_style', 'value' => array('Slider')),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'brickx'),
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
					"group" 	  => __( "Slider Options", 'brickx'),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Navigation", 'brickx'),
					"param_name" => "slider_nav",
					"value" => array(
						__( 'Disabled', 'brickx') => 'false',
						__( 'Enabled', 'brickx')  => 'true',
					),
					"description" => __( "Enable or disable navigation arrows. Default: Disable", 'brickx'),
					"group" => __( "Slider Options", 'brickx'),
					
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'brickx'),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'brickx') => 'false',
						__( 'Enabled', 'brickx')  => 'true',
					),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'brickx'),
					"group" => __( "Slider Options", 'brickx'),
					
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'brickx'),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "rsconstruction" )  => 'true',
						__( "Disable", "rsconstruction" ) => 'false',
					),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'brickx'),
					"group" => __( "Slider Options", 'brickx'),
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'brickx'),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "rsconstruction" )  => 'true',
						__( "Disable", "rsconstruction" ) => 'false',
					),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'brickx'),
					"group" => __( "Slider Options", 'brickx'),
					
				),

				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'brickx'),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "rsconstruction" )  => '5000',
						__( "4 Seconds", "rsconstruction" )  => '4000',
						__( "3 Seconds", "rsconstruction" )  => '3000',
						__( "2 Seconds", "rsconstruction" )  => '4000',
						__( "1 Seconds", "rsconstruction" )  => '1000',
					),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'brickx'),
					"group" 	  => __( "Slider Options", 'brickx'),
					
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'brickx'),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'brickx'),
					"group" 	  => __( "Slider Options", 'brickx'),
					
				),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'brickx'),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "rsconstruction" )  => 'true',
						__( "Disable", "rsconstruction" ) => 'false',
					),
					"description"=> __( "Loop to first item. Default: Enable", 'brickx'),
					"group" 	 => __( "Slider Options", 'brickx'),
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "League Title Color", "rsaddon" ),
					"param_name" => "title_color",
					"value" => '',
					"description" => __( "Choose color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "League Champion Number Color", "rsaddon" ),
					"param_name" => "cham_no",
					"value" => '',
					"description" => __( "Choose color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Champion Year Color", "rsaddon" ),
					"param_name" => "cham_year",
					"value" => '',
					"description" => __( "Choose color here", "rsaddon" ),
	                'group' => 'Styles',
				),

				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'brickx'),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'brickx'),
				),	

				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'brickx'),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'brickx'),
				),           
			),
)
);                                

}

add_action( 'vc_before_init', 'RSTheme_VC_Champion_Award' );

    // Element HTML
function vc_champion_awrard_html( $atts,$content ) {
	$attributes = array();
        // Params extraction
	extract(
		shortcode_atts(
			array(
				'title'                 => '6',
				'show_year'             => 'yes',
				'club_title'            => '',
				'title_color'           => '',
				'cham_no'               => '',
				'cham_year'             => '',
				'col_lg'                => '6',
				'col_md'                => '6',
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
				'el_class'              => '',					
				'css'                   => ''            
			), 
			$atts,'vc_champion_awrard'
		)
	);
	
       //post per page
	$per_page = $title;

	   //custom class added
	$wrapper_classes = array($el_class) ;			
	$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
	$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

	
	//extract css edit box
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

	$title_color = ($title_color) ? ' style="color: '.$title_color.'"' : '';
	$cham_no_color = ($cham_no) ? ' style="color: '.$cham_no.'"' : '';
	$cham_year_color = ($cham_year) ? ' style="color: '.$cham_year.'"' : '';

	$owl_data = array( 
		'nav'                => ( $slider_nav === 'true' ) ? true : false,
		'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
		'dots'               => ( $slider_dots === 'false' ) ? false : true,
		'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
		'autoplayTimeout'    => $slider_interval,
		'autoplaySpeed'      => $slider_autoplay_speed,
		'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
		'loop'               => ( $slider_loop === 'true' ) ? true : false,
		'margin'             => 30,
		'items'              => 4,
		'responsive'         => array(
			'0'    => array( 'items' => $col_mobile ),
			'480'  => array( 'items' => $col_xs ),
			'768'  => array( 'items' => $col_sm ),
			'992'  => array( 'items' => $col_md ),
			'1200' => array( 'items' => $col_lg ),
		)				
	);
	$owl_data = json_encode( $owl_data );

        //******************//
        // query post
        //******************//

	//query
    $club_list_wp = new wp_Query(array(
        'post_type' => 'club',
        'post__in' => array($club_title),
    ));

    $html = '<div class="award-section">
    			<div class="award-carourel owl-carousel owl-navigation-yes" data-award-options="'.esc_attr( $owl_data ).'">';  

	while($club_list_wp->have_posts()): $club_list_wp->the_post();
		$post_title = get_the_title($club_list_wp->ID);
		$club_champion = get_post_meta( get_the_ID(), 'club_champion', true );
        if(!empty($club_champion)){
            foreach ( $club_champion as $value ) { 
				$houner_image =  $value['houner_image'];
				$award_no     = wp_kses_post($value['champion_number']);
				$award_title  = wp_kses_post($value['league_title']);
				$award_year   = wp_kses_post($value['year_list']);
				if($show_year == "yes"){
					$year_show = '<span '.$cham_year_color.'>'.$award_year.'</span>';
				}else{
					$year_show = '';
				}

                $html .= '<div class="award-wrap">
	                        <div class="champion-logo">
	                           <img src="'.$houner_image.'" alt="'.$award_title.'" />
	                        </div>
	                        <div class="champion-details">                                                        
	                            <div class="year-details">
	                                <h3 '.$title_color.'>'.$award_title.'</h3>	                                
	                            </div>
	                            <div class="champion-no" '.$cham_no_color.'>
		                           '.$award_no.'
		                        </div>
		                        '.$year_show.'
	                        </div> 
	                    </div>';     
            }
        }

		endwhile; 
		wp_reset_query();
		$html .='</div>
		</div>';
		return $html; 
}
add_shortcode( 'vc_champion_awrard', 'vc_champion_awrard_html' );