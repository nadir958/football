<?php
 if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
}
if ( !class_exists( 'RSTheme_VC_Testimonial' ) ) {

   class RSTheme_VC_Testimonial extends RSTheme_VC_Modules_Testimonial {
		public $icon = null;
		public $name = null;
		public $base = null;
		public function __construct(){
			$this->name = __( "CL Testimonial", 'clt_testimonial' );
			$this->base = 'clt_testimonial';
			$this->icon = plugins_url( '/../img/icon.png', __FILE__ );
			/*$this->translate = array(
				'title'    => __( "What Our Client’s Say", 'financepro-core' ),
				'cols' => array( 
					__( '1 col', 'financepro-core' ) => '12',
					__( '2 col', 'financepro-core' ) => '6',
					__( '3 col', 'financepro-core' ) => '4',
					__( '4 col', 'financepro-core' ) => '3',
					__( '6 col', 'financepro-core' ) => '2',
				),
			);*/
			parent::__construct();
		}
	

		public function fields(){

			$fields = array(
					array(
						"type"        => "dropdown",
						"heading"     => __("Testimonial Source", "cl_testimonial"),
						"param_name"  => "source",
						"value"       => array(							
						'Dynamic'     => "Dynamic",
						'Manual'      => "Manual",										
						),
						'std'         => 'Dynamic', // Your default value
						'description' => 'Note: Slider layout will worked when you select dynamic source.', // Your default value
					),
                	array(
						"type"       => "dropdown",
						"heading"    => __("Show Title", "cl_testimonial"),
						"param_name" => "show_title",
						"value"      => array(							
						'Show'       => "show",
						'Hide'       => "hide",
						),	
						"dependency" => Array('element' => 'source', 'value' => array('Dynamic')),	
					),
					
					array(
						"type"       => "dropdown",
						"heading"    => __("Show Designation", "cl_testimonial"),
						"param_name" => "show_designation",
						"value"      => array(							
						'Show'       => "show", 
						'Hide'       => "hide",											
						),	
						"dependency" => Array('element' => 'source', 'value' => array('Dynamic')),					
					),
					
					array(
						'type'        => 'textfield',
						'holder'      => 'h3',
						'class'       => 'title-class',
						'heading'     => __( 'Per Page', "cl_testimonial" ),
						'param_name'  => 'per_page',						
						'description' => __( 'Testimonial Per Page', "cl_testimonial" ),
						'admin_label' => false,
						'weight'      => 0,
						"dependency"  => Array('element' => 'source', 'value' => array('Dynamic')),					   
              		),
					  
					  
					array(
						"type"        => "attach_image",
						"heading"     => __( "Customer Image", "cl_testimonial" ),
						"description" => __( "Add Customer image", "cl_testimonial" ),
						"param_name"  => "screenshots",
						"value"       => "",
						"dependency" => Array('element' => 'source', 'value' => array('Manual')),
					),				  
					  
					array(
						'type'       => 'textfield',
						'holder'     => 'h3',
						'class'      => 'customer_name',
						'heading'    => __( 'Customer Name', "cl_testimonial" ),
						'param_name' => 'customer_name',						
						"dependency" => Array('element' => 'source', 'value' => array('Manual')),					   
              		 ), 			   
					  
					array(
						'type'       => 'textfield',
						'holder'     => 'h3',
						'class'      => 'customer_degination',
						'heading'    => __( 'Customer Designation', "cl_testimonial" ),
						'param_name' => 'customer_degination',						
						"dependency" => Array('element' => 'source', 'value' => array('Manual')),					   
              		),			  
					  
					array(
						"type"       => "textarea_html",
						"holder"     => "div",
						"class"      => "",
						"heading"    => __("Content", "cl_testimonial"),
						"param_name" => "content",						
						"dependency" => Array('element' => 'source', 'value' => array('Manual')),		
					),	
					  
					array(
						"type"          => "dropdown",
						"heading"       => __("Testimonial Type", "cl_testimonial"),
						"param_name"    => "type",
						"value"         => array(							
						'Slider'        => "Slider",
						'Grid'          => "Grid", 
						'List'          => "List", 																		
						),	
						'std'           => 'Grid', // Your default value 		
						// "dependency" => Array('element' => 'source', 'value' => array('Dynamic')),
					),					
					
					array(
						"type" => "dropdown",
						"heading" => __("Select Testimonial Grid Style", "cl_testimonial"),
						"param_name" => "grid_style",
						"value" => array(							
							'Style 1' => "Style 1",
							'Style 2' => "Style 2", 
							'Style 3' => "Style 3",
							'Style 4' => "Style 4",
							'Style 5' => "Style 5",										
						),	
						'std'         => 'Style 1', // Your default value 	
						"dependency" => Array('element' => 'type', 'value' => array('Grid')),	
					),
										
					array(
						"type" => "dropdown",
						"heading" => __("Select Testimonial Grid Column", "cl_testimonial"),
						"param_name" => "grid_col",
						"value" => array(							
							__('Column 2', 'cl_testimonial') => "6",
							__('Column 3', 'cl_testimonial') => "4", 
							__('Column 4', 'cl_testimonial') => "3",
							__('Column Fullwidth', 'cl_testimonial') => "12",
						),	
						'std'         => '12', // Your default value 	
						"dependency" => Array('element' => 'type', 'value' => array('Grid')),
						'description'         => 'Note: Testimonial grid column will worked when you select dynamic source.',
					),

					array(
						"type" => "dropdown",
						"heading" => __("Select Testimonial Slider Style", "cl_testimonial"),
						"param_name" => "slider_style",
						"value" => array(							
							'Style 1' => "Style 1",
							'Style 2' => "Style 2",
							'Style 3' => "Style 3",					
							'Style 4' => "Style 4",
							'Style 5' => "Style 5",		
							'Style 6' => "Style 6",
						),	
						'std'         => '1', // Your default value 	
						"dependency" => Array('element' => 'type', 'value' => array('Slider')
						),	
					),
					
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Testimonial Quote Icon', 'cl_testimonial' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-quote-left', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
					
						'description' => __( 'Select icon from library.', 'cl_testimonial' ),
					),

					
					array(
						"type" => "dropdown",
						"heading" => __("Select Testimonial List Style", "cl_testimonial"),
						"param_name" => "list_style",
						"value" => array(							
							'Style 1' => "Style 1",
							'Style 2' => "Style 2",	
							'Style 3' => "Style 3",		
							'Style 4' => "Style 4", 																																															
						),	
						'std'         => '1', // Your default value 	
						"dependency" => Array('element' => 'type', 'value' => array('List')),	
					),
					
					array(
						"type" => "dropdown",
						"heading" => __("Show Ratings", "cl_testimonial"),
						"param_name" => "d_ratings_show",
						"value" => array(							
							'Show' => "show", 
							'Hide' => "hide",				
						),
						"dependency" => Array('element' => 'source', 'value' => array('Dynamic')),
					),

					array(
						"type" => "dropdown",
						"heading" => __("Show Author Image", "cl_testimonial"),
						"param_name" => "show_avatar",
						"value" => array(							
							'Show' => "show",
							'Hide' => "hide",				
						),
						"dependency" => Array('element' => 'source', 'value' => array('Dynamic')),
					),

					array(
						"type" => "dropdown",
						"heading" => __("Show Ratings", "cl_testimonial"),
						"param_name" => "ratings_show",
						"value" => array(							
							'Show' => "show", 
							'Hide' => "hide",																				
						),
						"dependency" => Array('element' => 'source', 'value' => array('Manual')),
					),
					
					array(
						"type" => "dropdown",
						"heading" => __("Set Your Ratings", "cl_testimonial"),
						"param_name" => "set_ratings",
						"value" => array(	
							'1' => "1",						
							'1.5' => "1.5", 
							'2'   => "2",
							'2.5' => "2.5",
							'3'	  => "3",
							'3.5' => "3.5", 
							'4'	  => "4", 
							'4.5' => "4.5",	
							'5'	  => "5",
						),	
						"dependency" => Array('element' => 'ratings_show', 'value' => array('show')),											
					),
									
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Title color", "cl_testimonial" ),
						"param_name" => "titlecolor",
						"value" => '#212121', //Default Red color
						"description" => __( "Choose color", "cl_testimonial" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					 ),				 
					
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Designation color", "cl_testimonial" ),
						"param_name" => "dsignation_color",
						"value" => '#555', //Default Black color
						"description" => __( "Choose color", "cl_testimonial" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					 ),
					 
					 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Testimonial Content Text color", "cl_testimonial" ),
						"param_name" => "content_color",
						"value" => '#111', //Default Black color
						"description" => __( "Choose color", "cl_testimonial" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					 ),		
					 
					 array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Testimonial Content Background", "cl_testimonial" ),
						"param_name" => "dsignation_bg_color",
						"value" => '#fff', //Default Red color
						"description" => __( "Choose color", "cl_testimonial" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					 ),
					 
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Testimonial Quote Icon Colors", "cl_testimonial" ),
						"param_name" => "quote_color",
						"value" => '#f10909', //Default Red color
						"description" => __( "Choose color", "cl_testimonial" ),
						'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Style',
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Testimonial Dots Colors", "cl_testimonial" ),
						"param_name" => "dots_color",
						"value" => '', //Default Red color
						"description" => __( "Choose color", "cl_testimonial" ),
                        'group' => 'Style',
                        "dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Testimonial Nav Colors", "cl_testimonial" ),
						"param_name" => "nav_color",
						"value" => '', //Default Red color
						"description" => __( "Choose color", "cl_testimonial" ),
                        'group' => 'Style',
                        "dependency" => Array('element' => 'type', 'value' => array('Slider')),
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'cl_testimonial' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', "cl_testimonial" 										                            ),
					),

					array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'cl_testimonial' ),
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
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),
				
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'cl_testimonial' ),
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
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),				
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'cl_testimonial' ),
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
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'cl_testimonial' ),
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
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'cl_testimonial' ),
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
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
					),

				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'cl_testimonial' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'cl_testimonial' ) => 'false',
						__( 'Enabled', 'cl_testimonial' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'cl_testimonial' ),
					"group" => __( "Slider Options", 'cl_testimonial' ),					
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Slider Nav", 'cl_testimonial' ),
					"param_name" => "slider_nav",
					"value" => array(
						__( 'Disabled', 'cl_testimonial' ) => 'false',
						__( 'Enabled', 'cl_testimonial' )  => 'true',
						),
					"description" => __( "Enable or disable navigation. Default: Disable", 'cl_testimonial' ),
					"group" => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'cl_testimonial' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "cl_testimonial" )  => 'true',
						__( "Disable", "cl_testimonial" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'cl_testimonial' ),
					"group" => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'cl_testimonial' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "cl_testimonial" )  => 'true',
						__( "Disable", "cl_testimonial" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'cl_testimonial' ),
					"group" => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
				),

				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'cl_testimonial' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "cl_testimonial" )  => '5000',
						__( "4 Seconds", "cl_testimonial" )  => '4000',
						__( "3 Seconds", "cl_testimonial" )  => '3000',
						__( "2 Seconds", "cl_testimonial" )  => '4000',
						__( "1 Seconds", "cl_testimonial" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'cl_testimonial' ),
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
				
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'cl_testimonial' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'cl_testimonial' ),
					"group" 	  => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
				
				),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'cl_testimonial' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "cl_testimonial" )  => 'true',
						__( "Disable", "cl_testimonial" ) => 'false',
						),
					"description"=> __( "Loop to first item. Default: Enable", 'cl_testimonial' ),
					"group" 	 => __( "Slider Options", 'cl_testimonial' ),
					"dependency" => Array('element' => 'type', 'value' => array('Slider')),			
					
				),


						
				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', "cl_testimonial" ),
					'param_name' => 'css',
					'group' => __( 'Design Options', "cl_testimonial" ),
				),               											
						
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '', $ratings = '' ){
			$attributes = array();
    		extract(
					$atts = shortcode_atts(	
					array(
						'show_title'            => 'show',
						'show_designation'      => 'show',
						'slider_icon'           => 'Bullet Style',
						'source'                => 'Dynamic',
						'ratings_show'          => 'show',
						'd_ratings_show'        => 'show',
						'set_ratings'           =>'1',	
						'titlecolor'            => '#212121',
						'dsignation_color'      => '#555',
						'content_color'         => '#111',
						'quote_color'           => '#f10909',
						'nav_color'             => '',
						'dots_color'            => '',
						'dsignation_bg_color'   => '#fff',	
						'css'                   => '',
						'el_class'              => '',
						'type'                  =>'Grid',
						'grid_style'            => 'Style 1', 
						'grid_style_manual'     => 'Style 1',
						'slider_style'          => 'Style 1',
						'icon_fontawesome'      => 'fa fa-quote-left', 
						'list_style'            => 'Style 1', 
						'per_page'              => '4', 
						'grid_col'              => '12', 
						'screenshots'           => '',
						'customer_name'         =>'',
						'customer_degination'   =>'',
						
						'col_lg'                => '3',
						'col_md'                => '3',
						'col_sm'                => '2',
						'col_xs'                => '1',
						'col_mobile'            => '1',
						'slider_nav'            => 'false',
						'slider_dots'           => 'false',
						'slider_autoplay'       => 'true',
						'slider_stop_on_hover'  => 'true',
						'slider_interval'       => '5000',
						'slider_autoplay_speed' => '200',
						'slider_loop'           => 'true',
						'show_avatar'           => 'show',
						
					), $atts, 'clt_testimonial'
				)	
			);

			
			//get image for customer	
			$customer_image = shortcode_atts(array(
			     'screenshots' => 'screenshots',
			    ), $atts);
				
			$img = wp_get_attachment_image_src($customer_image["screenshots"], "large");
			//$imgSrc = $img[0];	
			$imgSrc = (isset($img[0])) ? $img[0] : '';	
			$imageClass='<img src="'.$imgSrc.'" alt="customer-image" />';

			//content extraxt
			$atts['content'] = $content;	


			//for css edit box value extract
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

			//custom class added
			$wrapper_classes = array($el_class) ;			
			$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
			$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

			$post_title_show='';
			$degination='';


			$type_check='';
			$type_check=$type;
			$cl_source='';
			$cl_source=$source;
			$style_check='';
			$style_check2='';
			$style_check3='';
			$style_check=$grid_style;
			$style_check2=$slider_style;
			$style_check3=$list_style;

			if($dots_color || $nav_color) : ?>

				<style type="text/css">

					<?php if($dots_color) : ?>
						#cl-testimonial.owl-carousel .owl-dots button {
						    border-color: <?php echo $dots_color; ?>;
						}
						#cl-testimonial.owl-carousel .owl-dots button.active {
						    background: <?php echo $dots_color; ?>;
						}
					<?php endif; ?>

					<?php if($nav_color) : ?>
						#cl-testimonial.owl-carousel .owl-nav button {
							background: <?php echo $nav_color;?>;
						}
					<?php endif; ?>

				</style>

			<?php endif;

			$best_wp = new wp_Query(array(
				'post_type' => 'clt_testimonials',
				'posts_per_page' => $per_page,
			));

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 10,
				'responsive'         => true,
				'responsive'         => array(
					'0'    => array( 'items' => $col_mobile ),
					'480'  => array( 'items' => $col_xs ),
					'768'  => array( 'items' => $col_sm ),
					'992'  => array( 'items' => $col_md ),
					'1200' => array( 'items' => $col_lg ),
				)				
			);
			$owl_data = json_encode( $owl_data );

			$dir = plugin_dir_path( __FILE__ );

			 if($type == 'Grid'){
				switch ( $grid_style ) {
					case 'Style 5':				
					$template = 'testimonial-grid-style-5';
					break;

					case 'Style 4':				
					$template = 'testimonial-grid-style-4';
					break;

					case 'Style 3':				
					$template = 'testimonial-grid-style-3';
					break;	

					case 'Style 2':				
					$template = 'testimonial-grid-style-2';
					break;	
					
					default:					
						$template = 'testimonial-grid-style-1';
					break;
				}

			}

			elseif($type == 'Slider'){
				switch ( $slider_style ) {
					case 'Style 6':
					$template = 'testimonial-slider-style-6';
					break;

					case 'Style 5':				
					$template = 'testimonial-slider-style-5';
					break;

					case 'Style 4':				
					$template = 'testimonial-slider-style-4';
					break;

					case 'Style 3':				
					$template = 'testimonial-slider-style-3';
					break;	

					case 'Style 2':				
					$template = 'testimonial-slider-style-2';
					break;	
					
					default:					
						$template = 'testimonial-slider-style-1';
					break;
				}
			}

			else {
				switch($list_style) {
					case "Style 4":
						$template = 'testimonial-list-style-4';
						break;

					case "Style 3":
						$template = 'testimonial-list-style-3';
						break;

					case "Style 2":
						$template = 'testimonial-list-style-2';
						break;

					default:
						$template = 'testimonial-list-style-1';

				}
			}					

			return $this->template( $template, get_defined_vars() );
		}
	
	}
}
new RSTheme_VC_Testimonial;