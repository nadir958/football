<?php
/*
Element Description: RS Circular Skillbar elements
*/
// Element Mapping

function vc_skillbar_mapping() {
	 
	// Stop all if VC is not enabled
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}
	 
	// Map the block with vc_map()
	vc_map( 
		array(
			'name' => __('RS Circular Skillbar', 'rsconstruction'),
			'base' => 'vc_skillbar',
			'description' => __('RS Circular Skill Bars', 'rsconstruction'), 
			'category' => __('by RS Theme', 'rsconstruction'),   
			'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',    
			'params' => array( 
			array(
				'type' => 'textfield',
				'holder' => 'h3',
				'class' => 'title-class',
				'heading' => __( 'Skill Title', 'rs-addons'),
				'param_name' => 'skill_title',
				'value' => __( '', 'rs-addons'),				
				'admin_label' => false,
				'weight' => 0,			   
			),

			array(
				'type' => 'textfield',
				'holder' => 'h3',
				'class' => 'title-class',
				'heading' => __( 'Skill Units', 'rs-addons'),
				'param_name' => 'skill_unit',
				'value' => __( '80', 'rs-addons'),				
				'admin_label' => false,
				'weight' => 0,	
				'description' => __( 'Enter units in percentage. Exe: 80', 'rs-addons'),		   
			),

			array(
				'type' => 'textfield',
				'holder' => 'h3',
				'class' => 'title-class',
				'heading' => __( 'Skill Animation Duration', 'rs-addons'),
				'param_name' => 'animation_duration',
				'value' => __( '1000', 'rs-addons'),				
				'admin_label' => false,
				'weight' => 0,	
				'description' => __( 'Enter animation duration time. Dufault: 1000', 'rs-addons'),		   
			),

			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __( "Skill Bar Primary Color", "bstart" ),
				"param_name" => "primary_color",
				"value" => '#bdc3c7',
				"description" => __( "Choose primary color here", "bstart" ),
                'group' => 'Styles',
			),

			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __( "Skill Bar Secondary Color", "bstart" ),
				"param_name" => "secondary_color",
				"value" => '#3498db',
				"description" => __( "Choose secondary color here", "bstart" ),
                'group' => 'Styles',
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'rs-addons'),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rs-addons'),
			),	
			
			array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'rs-addons'),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'rs-addons'),
			),           
		 ),
		)
	);                                
	
}
     
 add_action( 'vc_before_init', 'vc_skillbar_mapping' );
     
    // Element HTML
   function vc_skillbar_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'skill_title'        => '',
					'skill_unit'         => '80',
					'animation_duration' => '1000',
					'primary_color'      => '#bdc3c7',
					'secondary_color'    => '#3498db',
					'el_class'           => '',		
					'css'                => ''            
                ), 
                $atts,'vc_skillbar'
           )
        );
	
       //post per page
	  
	   //custom class added
		$wrapper_classes = array($el_class) ;			
		$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
		$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

		$primary_color      = ($primary_color) ? $primary_color : '#bdc3c7';		
		$secondary_color    = ($secondary_color) ? $secondary_color : '#3498db';		
		$skill_title        = ($skill_title) ? '<div class="skill-title">'.$skill_title.'</div>' : '';		
		$animation_duration = ($animation_duration) ? $animation_duration : '1000';		
		$skill_unit         = ($skill_unit) ? $skill_unit : '80';		
	
		//extract css edit box
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
		
        //******************//
        // query post
        //******************//
		
		$html='
			<div class="skillbar-wrap '.$css_class_custom.'">
				<div class="cdev" data-percent="'.$skill_unit.'" data-duration="'.$animation_duration.'" data-color="'.$primary_color.', '.$secondary_color.'"></div>
				'.$skill_title.'
			</div>';
 		return $html; 
	}
add_shortcode( 'vc_skillbar', 'vc_skillbar_html' );