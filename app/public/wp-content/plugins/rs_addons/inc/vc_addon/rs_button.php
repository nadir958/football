<?php
/*
Element Description: Rs Button*/
	
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	// Element Mapping
	if ( !class_exists( 'RSTheme_Button_Schedule' ) ) {   
	 
		class RSTheme_Button_Schedule extends RSTheme_VC_Modules {
			public function __construct(){
				$this->name = __( "RS Button", 'rsaddon' );
				$this->base = 'vc_button_title';				
				parent::__construct();
			}

			public function fields(){
				$fields = array(
					array(
						'type' => 'textfield',
						'class' => 'title-class',
						'heading' => __( 'Button Text', 'rs-addon' ),
						'param_name' => 'rs_button',
						'value' => __( '', 'rs-addon' ),
						'description' => __( 'Button', 'rs-addon' ),
						'admin_label' => false,
						'weight' => 0,				   
					),

					array(
						'type' => 'textfield',
						'class' => 'title-class',
						'heading' => __( 'Button link', 'rs-addon' ),
						'param_name' => 'rs_button_link',
						'value' => __( '', 'rs-addon' ),
						'description' => __( 'Button Link', 'rs-addon' ),
						'admin_label' => false,
						'weight' => 0,				   
					), 

					array(
	                    'type'       => 'dropdown',
	                    'heading'    => __( 'Select Button Align', 'rsaddon' ),
	                    'param_name' => 'align',
	                    'value' => array(
	                        __( 'Select' )   => '',
	                        __( 'Left', 'rsaddon' )   => 'left',
	                        __( 'Center', 'rsaddon' )   => 'center',
	                        __( 'Right', 'rsaddon' )  => 'right',
	                    ),
	                ),

					array(
						"type"       => "dropdown",
						"heading"    => __("Button Style", "rs-addon"),
						"param_name" => "button_style",
						"value"      => array(							
							'Flat'   => "flat",			
							'Icon' => "icon_border",				
							'Border' => "btn-border",																	
						),										
					), 
			
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Button Text color", "rs-addon" ),
						"param_name" => "buttoncolor",
						"value" => '#3e537c', //Default Red color
						"description" => __( "Choose title color", "rs-addon" ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'Style',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Button border color", "rs-addon" ),
						"param_name" => "bnt_border",
						"value" => '#ea4c23', //Default Red color
						"description" => __( "Choose Button border color", "rs-addon" ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'Style',
					),
			
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Gradient Primary background Color", "rs-addon" ),
						"param_name" => "bnt_background",
						"value" => '#ea4c23', //Default Red color
						"description" => __( "Choose Button background color", "rs-addon" ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'Style',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Gradient Secondary background Color", "rs-addon" ),
						"param_name" => "bnt_background_hover",
						"value" => '#101010', //Default Red color
						"description" => __( "Choose Button background color", "rs-addon" ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'Style',
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Button Hover Text color", "rs-addon" ),
						"param_name" => "bnt_hover_text",
						"value" => '#fff', //Default Red color
						"description" => __( "Choose Button background color", "rs-addon" ),
						'admin_label' => false,
						'weight' => 0,
						'group' => 'Style',
					),

					
			
					array(
						'type' => 'css_editor',
						'heading' => __( 'CSS box', 'rs-addon' ),
						'param_name' => 'css',
						'group' => __( 'Design Options', 'rs-addon' ),
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
							'rs_button'            => 'Read More',
							'align'                => 'left', 
							'buttoncolor'          => '#fff',					
							'bnt_background'       => '#ea4c23',					
							'bnt_background_hover' => '#101010',					
							'bnt_hover_text'       => '#fff',					
							'rs_button_link'       => '',				
							'button_style'         => '',
							'bnt_border'		   => '',				
							'el_fontsize'          => '18px',
							'css'                  => ''
		                ), 
		                $atts, 'vc_button_title'
		            )
		        );

		        //for css edit box value extract
				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
				
				//fontsize
				$wrapper_classes_font = array($el_fontsize) ;			
				$class_to_font = implode( ' ', array_filter( $wrapper_classes_font ) );		
				$css_class_font = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_font, $atts );
				$normal_btn = $buttoncolor;
				$button_leave = $bnt_background;
				

				switch ( $button_style ) {

		    		case 'btn-border':
						$template = 'border-button';
						break;

					case 'flat':
						$template = 'flat-button';
						break;

					default:
						$template = 'flat-button';
						break;
				}
				return $this->template( $template, get_defined_vars() );
		    }
		}
	}
	new RSTheme_Button_Schedule;