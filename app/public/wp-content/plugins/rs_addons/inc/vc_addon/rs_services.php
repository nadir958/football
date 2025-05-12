<?php
/*
Element Description: Rs Services Box
*/
	if ( !defined( 'WPB_VC_VERSION' ) ) {
		return;
	}

	// Element Mapping
	if ( !class_exists( 'RSTheme_Service_Box' ) ) {   
	 
		class RSTheme_Service_Box extends RSTheme_VC_Modules {
			public function __construct(){
				$this->name = __( "Rs Service Box", 'rsaddon' );
				$this->base = 'vc_RsServices';				
				parent::__construct();
			}
			
			public function fields(){
				$fields = array(
					array(
						"type" => "dropdown",
						"heading" => __("Select Sevices Style", "rsaddon"),
						"param_name" => "service_style",
						"value" => array(						    
							'Default' => "Default",						
							'Style 1' => 'Style 8',						
							'Style 2' => "Style 2", 
							'Style 3' => "Style 3",
							'Style 4' => "Style 4",
							'Style 5' => "Style 5",
						),						
					),
					array(
	                    'type' => 'textfield',
	                    'holder' => 'h3',
	                    'class' => 'title-class',
	                    'heading' => __( 'Rs Service Title ', 'rsaddon' ),
	                    'param_name' => 'title',
	                    'value' => __( '', 'rsaddon' ),
	                    'description' => __( 'Rs services title here', 'rsaddon' ),
	                    'admin_label' => false,
	                    'weight' => 0,                       
	                ),

	                array(
	                    'type' => 'textfield',
	                    'heading' => __( 'Rs Service Subtitle ', 'rsaddon' ),
	                    'param_name' => 'subtilte',
	                    'value' => __( '', 'rsaddon' ),
	                    'description' => __( 'Rs services subtitle here', 'rsaddon' ),  
	                     "dependency" => Array('element' => 'service_style', 'value' => array('Default')),                
	                ),

	                array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"admin_label" => false,
						"heading" => __( "Title Font Size", 'rsaddon' ),
						"param_name" => "title_size",
						'description' => __( 'Title font size in px. eg 20. If not defined, default h3 font size will be used', 'rsaddon' ),
					),

					array(
					    "type" => "dropdown",
					    "heading" => __("Title Uppercase", "rsaddon"),
					    "param_name" => "title_transform",
					    'description' => __( 'Make service title in uppercase', 'rsaddon' ),
					    "value" => array(
					        __( 'No', 'rsaddon')   => '',
					        __( 'Yes', 'rsaddon') => 'title-upper',
					    ),
					    "dependency" => Array('element' => 'service_style', 'value' => array('Style 9', 'Style 7')),
					),

					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						'admin_label' => false,
						"heading" => __( "Spacing Before Title", 'rsaddon' ),
						"param_name" => "spacing_top",
						"description" => __( "Spacing between icon and title in px eg. 25", 'rsaddon' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					'admin_label' => false,
					"heading" => __( "Spacing After Title", 'rsaddon' ),
					"param_name" => "spacing_bottom",
					"description" => __( "Spacing between title and content in px eg. 12", 'rsaddon' ),
				),

					array(
						"type" => "colorpicker",
						"class" => "",
						'admin_label' => false,
						"heading" => __( "Service Title Color", "rsaddon" ),
						"param_name" => "title_color",
						"value" => '',
						"description" => __( "Choose title color", "rsaddon" ),
		               
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Title Hover Color", "rsaddon" ),
						"param_name" => "title_hovercolor",
						'admin_label' => false,
						"value" => '',
						"description" => __( "Choose title hover color", "rsaddon" ),
		                
					),


					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Subtitle Color", "rsaddon" ),
						"param_name" => "subtitle_color",
						"value" => '',
						"description" => __( "Choose Subtitle color", "rsaddon" ),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default')),	

					), 


	                array(
						"type" => "textarea_html",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Services content here", "rsaddon" ),
						"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a 	"param_name"
						"value" =>'',
						"description" => __( "Duis in mi erat. Phasellus vitae in to lorem vehicula, viverra libero quis, sodalesnulla. Donec at the turpis quis tellus laoreet.", "rsaddon" ),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1',  'Style 2', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Style 7', 'Style 8', 'Style 9')),	

					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Description Color", "rsaddon" ),
						"param_name" => "desc_color",
						"value" => '',
						"description" => __( "Choose description color", "rsaddon" ),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 2', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Style 7', 'Style 8', 'Style 9')),	

					), 


					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Content Background Color", "rsaddon" ),
						"param_name" => "desc_bg",
						"value" => '',
						"description" => __( "Choose description Background color", "rsaddon" ),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Style 7', 'Style 9')),	

					), 						


					array(
						"type"        => "attach_image",
						"heading"     => __( "Service Image", "rsaddon" ),
						"description" => __( "Add services image", "rsaddon" ),
						"param_name"  => "screenshots",
						"value"       => "",
						"dependency" => Array('element' => 'service_style', 'value' => array('Style 2', 'Style 3', 'Style 7', 'Style 8', 'Style 9')),
					),
														
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon library', 'rsaddon' ),
						'value' => array(
							__( 'Font Awesome', 'rsaddon' ) => 'fontawesome',
							__( 'Open Iconic', 'rsaddon' ) => 'openiconic',
							__( 'Typicons', 'rsaddon' ) => 'typicons',
							__( 'Entypo', 'rsaddon' ) => 'entypo',
							__( 'Linecons', 'rsaddon' ) => 'linecons',
							__( 'Mono Social', 'rsaddon' ) => 'monosocial',
							__( 'Material', 'rsaddon' ) => 'material',
						),
						'admin_label' => true,
						'param_name' => 'type',
						"dependency" => Array('element' => 'service_style', 'value' => array('Style 1', 'Style 3', 'Style 4', 'Style 5', 'Style 6')),
						'description' => __( 'Select icon library.', 'rsaddon' ),
					),

					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-users',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'fontawesome',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_openiconic',
						'value'      => 'vc-oi vc-oi-dial',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon'    => false,
							// default true, display an "EMPTY" icon?
							'type'         => 'openiconic',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'openiconic',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_typicons',
						'value' => 'typcn typcn-adjust-brightness',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'type' => 'typicons',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'typicons',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_entypo',
						'value' => 'entypo-icon entypo-icon-note',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'type' => 'entypo',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'entypo',
						),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_linecons',
						'value'      => 'vc_li vc_li-heart',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'type' => 'linecons',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'linecons',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_monosocial',
						'value' => 'vc-mono vc-mono-fivehundredpx',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'type' => 'monosocial',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value'   => 'monosocial',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => __( 'Icon', 'rsaddon' ),
						'param_name' => 'icon_material',
						'value'      => 'vc-material vc-material-cake',
						// default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false,
							// default true, display an "EMPTY" icon?
							'type' => 'material',
							'iconsPerPage' => 4000,
							// default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value'   => 'material',
						),
						'description' => __( 'Select icon from library.', 'rsaddon' ),
					),
	                array(
						"type"       => "dropdown",
						"heading"    => __("Show Icon", 'rsaddon'),
						"param_name" => "show_icon",
						"value"      => array(						    						
							'Yes' => "yes", 
							'No' => "no", 																			
						),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default')),						
					),
				    array(
						'type'       => 'dropdown',
						'heading'    => __( 'Custom Icons', 'rsaddon' ),
						'param_name' => 'custom_icons',
						'value' => array(
							__( 'Graphic', 'rsaddon' )   => 'flaticon-graphic',
							__( 'Bulb', 'rsaddon' ) => 'flaticon-bulb',
							__( 'Heart', 'rsaddon' )  => 'flaticon-heart',
							__( 'Money', 'rsaddon' )  => 'flaticon-money',
							__( 'Money-1', 'rsaddon' )  => 'flaticon-money-1',
							__( 'Money-2', 'rsaddon' )  => 'flaticon-money-2',
							__( 'Analysis', 'rsaddon' )  => 'flaticon-analysis',
							__( 'Headset', 'rsaddon' )  => 'flaticon-headset',
							__( 'Law', 'rsaddon' )  => 'flaticon-law',
							__( 'Document', 'rsaddon' )  => 'flaticon-document',
							__( 'Idea', 'rsaddon' )  => 'flaticon-idea',
							__( 'Career', 'rsaddon' )  => 'flaticon-career',
							__( 'Target', 'rsaddon' )  => 'flaticon-target',
							__( 'Speed', 'rsaddon' )  => 'flaticon-speed',
							__( 'Admin', 'rsaddon' )  => 'flaticon-admin',
							__( 'Tax', 'rsaddon' )  => 'flaticon-tax',
							__( 'Diamond', 'rsaddon' )  => 'flaticon-diamond',
							__( 'Partnership', 'rsaddon' )  => 'flaticon-partnership',
							__( 'Growth', 'rsaddon' )  => 'flaticon-growth',
							__( 'Sales', 'rsaddon' )  => 'flaticon-sales',
							__( 'Sale', 'rsaddon' )  => 'flaticon-sale',
							__( 'Whiteboard', 'rsaddon' )  => 'flaticon-whiteboard',
							__( 'Pen', 'rsaddon' )  => 'flaticon-pen',
							__( 'Best', 'rsaddon' )  => 'flaticon-best',
							__( 'Umbrella', 'rsaddon' )  => 'flaticon-umbrella',
							__( 'Dashboard', 'rsaddon' )  => 'flaticon-dashboard',
							__( 'Gear', 'rsaddon' )  => 'flaticon-gear',
							__( 'Pyramid', 'rsaddon' )  => 'flaticon-pyramid',
							__( 'Business And Finance', 'rsaddon' )  => 'flaticon-business-and-finance',
							__( 'Flower', 'rsaddon' )  => 'flaticon-flower',
							__( 'Chart', 'rsaddon' )  => 'flaticon-chart',
							__( 'Timer', 'rsaddon' )  => 'flaticon-timer',
							__( 'Banknote', 'rsaddon' )  => 'flaticon-banknote',
							__( 'Maze', 'rsaddon' )  => 'flaticon-maze',
							__( 'Suitcase', 'rsaddon' )  => 'flaticon-suitcase',
							__( 'Chess Piece', 'rsaddon' )  => 'flaticon-chess-piece',
							__( 'Puzzle Pieces', 'rsaddon' )  => 'flaticon-puzzle-pieces',
							__( 'Profits', 'rsaddon' )  => 'flaticon-profits',
							__( 'Pie Chart', 'rsaddon' )  => 'flaticon-pie-chart',
							__( 'Computer', 'rsaddon' )  => 'flaticon-computer',
							__( 'Clock', 'rsaddon' )  => 'flaticon-clock',
							__( 'Time Call', 'rsaddon' )  => 'flaticon-time-call',
							__( 'Phone', 'rsaddon' )  => 'flaticon-phone',
							__( 'Call', 'rsaddon' )  => 'flaticon-call',
							__( 'Email', 'rsaddon' )  => 'flaticon-email',
							__( 'Location', 'rsaddon' )  => 'flaticon-location',
							__( 'Send', 'rsaddon' )  => 'flaticon-send',
						),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default')),
						'description' => __( 'Select Custom Icons.', 'rsaddon' ),
					),

				    array(
						"type" => "dropdown",
						"heading" => __("Select Icon Style", "rsaddon"),
						"param_name" => "icon_style",
						"value" => array(						    
							'Border' => "border_style",				
							'Flat' => "flat_style",				
						),
						"dependency" => Array('element' => 'service_style', 'value' => array('Style 6')),			
					),
					
					array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon style", 'rsaddon' ),
					"param_name" => "icon_style_2",
					'value' => array( 
						__( 'Rounded', 'rsaddon' )    => 'rounded',
						__( 'Square', 'rsaddon' )     => 'square',
						__( 'Circle', 'rsaddon' )     => 'circle',

					),
						'dependency' => array(
							'element' => 'service_style',
							'value'   => array( 'Default', 'Style 1', 'Style 3' ),
						),
					),

				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Border Radius", 'rsaddon' ),
					"param_name" => "icon_radiussize",
					'description' => __( 'Icon border radius size in px eg. 30', 'rsaddon' ),
					'dependency' => array(
							'element' => 'icon_style_2',
							'value'   => array( 'square', 'circle' ),
						),					
					),			

				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					'admin_label' => false,
					"heading" => __( "Icon size", 'rsaddon' ),
					"param_name" => "size",
					'description' => __( 'Icon size in px eg. 30', 'rsaddon' ),	
					"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Default')),			
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					'admin_label' => false,
					"heading" => __( "Icon Wrapper Size", 'rsaddon' ),
					"param_name" => "wrapper_size",
					'description' => __( 'Icon size in px eg. 30', 'rsaddon' ),	
					"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Default')),	
					),
					

				array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Icon Color", "rsaddon" ),
						"param_name" => "icon_color",
						"value" => '',
						"description" => __( "Choose icon color", "rsaddon" ),
						"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 3', 'Style 4', 'Style 5', 'Style 6', 'Default')),              
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Icon Background", "rsaddon" ),
						"param_name" => "service_icon_bg",
						"value" => '',
						"description" => __( "Choose icon background", "rsaddon" ),		                
		                "dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 3', 'Style 4', 'Style 5')),
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Button Background", "rsaddon" ),
						"param_name" => "btn_bg",
						"value" => '#ea4c23',
						"description" => __( "Choose button background", "rsaddon" ),		                
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Button Color", "rsaddon" ),
						"param_name" => "btn_color",
						"value" => '#fff',
						"description" => __( "Choose button color", "rsaddon" ),		                
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Overlay Color", "rsaddon" ),
						"param_name" => "overlay_color",
						"value" => '',
						"description" => __( "Choose overlay color", "rsaddon" ),		                
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),

					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __( "Overlay Color Opacity", "rsaddon" ),
						"param_name" => "overlay_opacity",
						"value" => '0.8',
						"description" => __( "Choose overlay color Opacity. Example. 0.01 - 0.1", "rsaddon" ),		                
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Service Icon Hover Color", "rsaddon" ),
						"param_name" => "icon_hover_color",
						"value" => '',
						"description" => __( "Choose icon hover color", "rsaddon" ),		               
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 1', 'Style 3', 'Style 4', 'Style 5', 'Default')),
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Icon Hover Background", "rsaddon" ),
						"param_name" => "icon_hover_bg",
						"value" => '',
						"description" => __( "Choose icon hover background", "rsaddon" ),                
		                "dependency" => Array('element' => 'service_style', 'value' => array( 'Style 3', 'Style 4', 'Style 5', 'Default')),
					),

					array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon padding", 'rsaddon' ),
					"param_name" => "icon_padding",
					'description' => __( "Icon padding in px eg. 15. Doesn't work on custom image" , 'rsaddon' ),
					'admin_label' => false,	
					"dependency" => Array('element' => 'service_style', 'value' => array('Default', 'Style 1', 'Style 3', 'Style 4', 'Style 5', 'Default')),				
					),

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Border Color", "rsaddon" ),
						"param_name" => "border_color",
						"value" => '',
						'admin_label' => false,
						"description" => __( "Choose border color", "rsaddon" ),
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),	

				

					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Services Align', 'rsaddon' ),
						'param_name' => 'align',
						'value' => array(
							__( 'Left', 'rsaddon' )   => 'left',
							__( 'Center', 'rsaddon' ) => 'center',
							__( 'Right', 'rsaddon' )  => 'right',
						),
						"dependency" => Array('element' => 'service_style', 'value' => array('Style 1', 'Style 2', 'Style 3', 'Style 4', 'Style 5', 'Style 7', 'Style 8', 'Style 9', 'Default')),
						'description' => __( 'Select alignment here.', 'rsaddon' ),
					),

					array(
						'type'        => 'vc_link',
						'heading'     => __( 'URL (Link)', 'rsaddon' ),
						'param_name'  => 'button_link',
						'description' => __( 'Add link to Serices Pages.', 'rsaddon' ),						
					),

					array(
					    "type" => "dropdown",
					    "heading" => __("Show Read More Icon", "rsaddon"),
					    "param_name" => "readmore",
					    'description' => __( 'Show read more icon', 'rsaddon' ),
					    "value" => array(
					        __( 'No', 'rsaddon')   => '',
					        __( 'Yes', 'rsaddon') => 'yes',
					    ),
					    "dependency" => Array('element' => 'service_style', 'value' => array('Style 9')),
					),

					array(
					    "type" => "textfield",
					    "heading" => __("Read More Text", "rsaddon"),
					    "param_name" => "readmoretext",
					    'description' => __( 'Change read more text', 'rsaddon' ),
					    "value" => __("Read More", "rsaddon"),
					    "dependency" => Array('element' => 'service_style', 'value' => array('Style 3')),
					),		

					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __( "Icon Image Background", "rsaddon" ),
						"param_name" => "icon_bg_color",
						"value" => '',
						"description" => __( "Icon Image Background", "rsaddon" ),
		                "dependency" => Array('element' => 'service_style', 'value' => array('Style 6')),
		                'group' => 'Styles',
					),
					
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Extra class name', 'rsaddon' ),
						'param_name'  => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
					),
					
					array(
						'type'       => 'css_editor',
						'heading'    => __( 'CSS box', 'rsaddon' ),
						'param_name' => 'css',
						'group'      => __( 'Design Options', 'rsaddon' ),
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
							'title'             => '',
							'subtilte'          => '',
							'subtitle_color'    => '#101010',
							'title_size'		=> '',
							'title_transform'	=> '',
							'spacing_top'		=> '',
							'spacing_bottom'	=> '',
							'type'              => '',
							'icon_fontawesome'  => '',
							'icon_openiconic'   => '',
							'icon_typicons'     => '',
							'services_icon'     => '',
							'icon_entypo'       => '',
							'icon_linecons'     => '',
							'icon_monosocial'   => '',
							'custom_icons'      => 'flaticon-bulb',
							'title_color'       => '#101010',
							'title_hovercolor'  => '#101010',
							'service_icon_bg'   => '',
							'overlay_color'     => '#222',
							'overlay_opacity'   => '0.8',
							'icon_style'		=> '',
							'icon_style_2'		=> '',
							'icon_radiussize'	=> '',
							'icon_hover_bg'     => '',
							'icon_color'        => '#101010',
							'btn_bg'            => '#ea4c23',
							'btn_color'         => '#fff',
							'icon_hover_color'  => '#ccc',
							'desc_color'        => '',
							'border_color'      => '',
							'show_icon'      => 'true',
							'icon_bg_color'     => '',
							'desc_bg'           => '',
							'icon_material'     => '',
							'icon'              => 'Image',	
							'size'				=> '',
							'wrapper_size'	    => '',
							'icon_padding'		=> '',				
							'text_font'         => '',
							'align'             => 'left',
							'el_class'          =>'',
							'service_style'     => 'Default',
							'icon_style'        => 'border_style',
							'button_link'       => '',					
							'readmore'          => '',					
							'readmoretext'      => 'Read More',		
							'css'               => '','vc_RsServices'
		                ), 
		                $atts,'vc_RsServices'
		            )
		        );

		        $a = shortcode_atts(array(
		          'screenshots' => 'screenshots',
		        ), $atts);
		           
				// Enqueue needed icon font.
				vc_icon_element_fonts_enqueue( $type );
				
				//parse link for vc linke		
				$button_link = ( '||' === $button_link ) ? '' : $button_link;
				$button_link = vc_build_link( $button_link );
				$use_link = false;
				if ( strlen( $button_link['url'] ) > 0 ) {
					$use_link = true;
					$a_href = $button_link['url'];
					$a_title = $button_link['title'];
					$a_target = $button_link['target'];
				}
				
				if ( $use_link ) {
					$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
					$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
					if ( ! empty( $a_target ) ) {
						$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
					}
				}
				$attributes = implode( ' ', $attributes );
				
			

				if($icon_fontawesome != ''):
				  $services_icon = esc_attr($icon_fontawesome);
				endif;

				if ($icon_openiconic != ''):
					$services_icon = esc_attr($icon_openiconic);
				endif;

				if ($icon_typicons != ''):
					$services_icon = esc_attr($icon_typicons);
				endif;

				if ($icon_entypo != ''):
					$services_icon = esc_attr($icon_entypo);
				endif;

				if ($icon_linecons != ''):
					$services_icon = esc_attr($icon_linecons);
				endif;

				if ($icon_monosocial != ''):
					$services_icon = esc_attr($icon_monosocial);
				endif;
				
				if ($icon_material != ''):
					$services_icon = esc_attr($icon_material);
				endif;
				if ($custom_icons != ''):
					$custom_icons = esc_attr($custom_icons);
				endif;

				
		        $img = wp_get_attachment_image_src($a["screenshots"], "large");

		        
				$imgSrc = '';
				if(isset($img[0])) {
					$imgSrc = $img[0];
				}

		        if ($imgSrc) {
					$imageClass='<img src="'.$imgSrc.'" alt="Rs-service" />';
		        }else{
		        	$imageClass= "";
		        }
		        $icon_bg = '';
		        if ($imgSrc) {
					$icon_bg ='style="background-color:'.$icon_bg_color.'"';
					$imagebg ='<img src="'.$imgSrc.'" alt="Rs-service" />';
		        }else{
		        	$imagebg = "";
		        }


						
				//extract content
				

				if(!empty($content)) {
					$main_content = $content;
				} else {
					$main_content = ''; 
				}

				$icon_color_normal       = ($icon_color) ? $icon_color : '';

				$icon_hover_color = $icon_hover_color ? $icon_hover_color : '';
				$icon_hover_bg    = $icon_hover_bg ? $icon_hover_bg : '';
				$service_icon_bg  = $service_icon_bg ? $service_icon_bg : '';
				$icon_hover_color = $icon_hover_color ? $icon_hover_color : '';

				//custom color added		
				
				$border_color     = ($border_color) ? ' style="border-color: '.$border_color.'"' : '';
				$desc_color       = ($desc_color) ? ' style="color: '.$desc_color.'"' : '';
				$desc_bg          = ($desc_bg) ? ' style="background: '.$desc_bg.'"' : '';
				$icon_bg_color    = ($icon_bg_color) ? ' style="background: '.$icon_bg_color.'"' : '';

				//extract css edit box
				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );
				
				 //custom class added
				$wrapper_classes = array($el_class) ;			
				$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
				$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

				//variable
				$read_more = !empty($readmore) ? '<a '.$attributes.' class="service-readon"><i class="flaticon flaticon-right-arrow"></i></a>' : '';


				//checking services style
	                
		        // Fill $html var with data

		        switch ( $service_style ) {

		    		case 'Style 8':
						$template = 'service-one';
						break;

					case 'Style 2':
						$template = 'service-two';
						break;

					case 'Style 3':
						$template = 'service-three';
						break;

					case 'Style 4':
						$template = 'service-four';
						break;

					case 'Style 5':
						$template = 'service-five';
						break;

					default:
						$template = 'service-default';
						break;
				}
				return $this->template( $template, get_defined_vars() );
		    }
		}
	}	
	new RSTheme_Service_Box;
 