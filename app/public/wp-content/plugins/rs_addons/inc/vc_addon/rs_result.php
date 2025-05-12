<?php
/*
Element Description: Point Table
*/
 if ( !defined( 'WPB_VC_VERSION' ) ) {
    return;
 }
    

if ( !class_exists( 'RSTheme_VC_Match_Results' ) ) {   
   
         
        // Stop all if VC is not enabled       
        
        

        // Map the block with vc_map()
       class RSTheme_VC_Match_Results extends RSTheme_VC_Modules {
		public function __construct(){
			$this->name = __( "RS Result Information", 'rsaddon' );
			$this->base = 'rs_result';				
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
                    	"type" => "dropdown",
                    	"heading" => __("Result Table Style", "rsaddon"),
                    	"param_name" => "resultable",
                    	"value" => array(	                    	
                    		__("Default Style", "rsaddon") => "1",
                    		__("Sidebar Style", "rsaddon") => "2"
                    		
                    	),
                    	"description" => __("Select your style here", "rsaddon"),                    	
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
						'type' => 'textfield',
						'heading' => __( 'Result Per Page', 'js_composer' ),
						'param_name' => 'result_per_page',
						'default' => -1,
						'description' => __( 'You can show here how many resut show here', 'rsaddon' ),
					),

				  	array(
						'type' => 'textfield',
						'heading' => __( 'Button text', 'js_composer' ),
						'param_name' => 'btn_text',
						'default' => 'View Statistics',
						'description' => __( 'You can add here button text', 'rsaddon' ),
					),

				

             	
				  	array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
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
						"heading" => __( "Result Text Color", "rsaddon" ),
						"param_name" => "result_color",
						"value" => '',
						"description" => __( "Choose text color here", "rsaddon" ),
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
						
					'resultable'      => '1',					
					'el_class'        => '',					
					'css'             => '',
					'cat'             => '',
					'team_color'      => '',
					'result_color'    => '',
					'date_color'      => '',
					'even_row'        => '',
					'odd_row'         => '',
					'result_per_page' => '',
					'btn_text'        => 'View Statistics',
					
					
                ), 
                $atts,'rs_result'
           )
        );

        $taxonomy = '';
		$team_color   = ($team_color) ? ' style="color: '.$team_color.'"' : '';
		$result_color = ($result_color) ? ' style="color: '.$result_color.'"' : '';
		$date_color   = ($date_color) ? ' style="color: '.$date_color.'"' : '';	
	

		$result_table_localize_data  = array(
			'even' => $even_row,
			'odd' => $odd_row
		);
		
		wp_localize_script( 'khelo-main', 'result_table_row', $result_table_localize_data );
		
		//extact icon 		
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
		 //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );


		if (!function_exists('result_find_club')){
  
			function result_find_club($team){
				$args =new wp_Query(array(
				    'post_type' => 'club',  
				    'p' => $team       
				));		
		  	
				if ( $args->have_posts() ) {

				  $team  = get_the_post_thumbnail($team) .' '.get_the_title($team);

				  $team1 = get_the_post_thumbnail($team);
				  $title1 = get_the_title($team);


				  return $team;		 
				                            
				}
			}
		}

		if (!function_exists('result_find_club2')){
			function result_find_club2($team){
				$args =new wp_Query(array(
				    'post_type' => 'club',  
				    'p' => $team       
				));		
		  	
				if ( $args->have_posts() ) {

				  $team  = get_the_post_thumbnail($team);
				  return $team;		 
				                            
				}
			}
		}

		switch ( $resultable ) {

			case '2':
				$template = 'result-style-2';
			break;			
			
			default:
				$template = 'result-style-1';
			break;
		}

		return $this->template( $template, get_defined_vars() );
		}

	}
	
}

new RSTheme_VC_Match_Results;