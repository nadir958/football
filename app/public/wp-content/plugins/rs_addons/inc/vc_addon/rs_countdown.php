<?php

	// Element Mapping
	 function vc_counter_mapping() {
         
    // Stop all if VC is not enabled
    if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
    }
         
    // Map the block with vc_map()
    vc_map( 
  
        array(
            'name' => __('Rs Counter', 'bstart'),
            'base' => 'vc_counter',
            'description' => __('Rs counter for project', 'bstart'), 
            'category' => __('by RS Theme', 'bstart'),   
            'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',            
            'params' => array(   
                      
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'Porject Title', 'bstart' ),
                    'param_name' => 'title',
                    'value' => __( '', 'bstart' ),
                    'description' => __( 'Project Title', 'bstart' ),
                    'admin_label' => false,
                    'weight' => 0,
                   
                ),  
				
				array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'project-class',
                    'heading' => __( 'Project Count', 'bstart' ),
                    'param_name' => 'project',
                    'value' => __( '', 'bstart' ),
                    'description' => __( 'Project counter (Example: 100 only number)', 'bstart' ),
                    'admin_label' => false,
                    'weight' => 0,
                    
                ),

                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon Alignment', 'bstart' ),
                    'param_name' => 'align',
                    'value' => array(
                        __( 'Center', 'bstart' ) => 'center',
                        __( 'Left', 'bstart' ) => 'left',
                        __( 'Right', 'bstart' ) => 'right',
                    ), 
                    'description' => __( 'Select counter icon align here.', 'bstart' ),
                ), 
                
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon library', 'bstart' ),
                    'value' => array(
                        __( 'Font Awesome', 'bstart' ) => 'fontawesome',
                        __( 'Open Iconic', 'bstart' ) => 'openiconic',
                        __( 'Typicons', 'bstart' ) => 'typicons',
                        __( 'Entypo', 'bstart' ) => 'entypo',
                        __( 'Linecons', 'bstart' ) => 'linecons',
                        __( 'Mono Social', 'bstart' ) => 'monosocial',
                        __( 'Material', 'bstart' ) => 'material',
                    ),
                    'admin_label' => true,
                    'param_name' => 'type',
                    'description' => __( 'Select icon library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
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
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
                    'param_name' => 'icon_openiconic',
                    'value' => 'vc-oi vc-oi-dial',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'openiconic',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'openiconic',
                    ),
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
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
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
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
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
                    'param_name' => 'icon_linecons',
                    'value' => 'vc_li vc_li-heart',
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
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
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
                        'value' => 'monosocial',
                    ),
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'bstart' ),
                    'param_name' => 'icon_material',
                    'value' => 'vc-material vc-material-cake',
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
                        'value' => 'material',
                    ),
                    'description' => __( 'Select icon from library.', 'bstart' ),
                ),
                
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'bstart' ),
					'param_name' => 'el_class',
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'bstart' 										                            ),
				),        
                 
           	)
        )
    );                                
        
}

 add_action( 'vc_before_init', 'vc_counter_mapping' );
 
// Element HTML
function vc_counter_html( $atts ) {
     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'title'            => '',
                'align'            => 'center',
                'project'          => '',
                'type'             => '',                    
                'icon_fontawesome' => '',
                'icon_openiconic'  => '',
                'icon_typicons'    => '',
                'icon_entypo'      => '',
                'icon_linecons'    => '',
                'icon_monosocial'  => '',
                'icon_material'    => '',
                'el_class'         =>'',
            ), 
            $atts,'vc_counter'
        )
    );
	
    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue( $type );
    
    //custom class added
	$wrapper_classes = array($el_class) ;			
	$class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );		
	$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );
     $services_icon = '';
    if($icon_fontawesome != ''):
      $services_icon = esc_attr($icon_fontawesome);
    endif;

    if ($icon_openiconic != ''):
        $services_icon .= esc_attr($icon_openiconic);
    endif;

    if ($icon_typicons != ''):
        $services_icon .= esc_attr($icon_typicons);
    endif;

    if ($icon_entypo != ''):
        $services_icon .= esc_attr($icon_entypo);
    endif;

    if ($icon_linecons != ''):
        $services_icon .= esc_attr($icon_linecons);
    endif;

    if ($icon_monosocial != ''):
        $services_icon .= esc_attr($icon_monosocial);
    endif;
    
    if ($icon_material != ''):
        $services_icon .= esc_attr($icon_material);
    endif;
		
    $html = '
        	<div class="counter-top-area '.$align.' clearfix">
                <div class="rs-counter-list">
                    <div class="count-icon">
                        <i class="vc_icon_element-icon '.$services_icon.'"></i>
                    </div>     
                    <div class="count-desc">
                        <h2 class="rs-counter">' . $project. '</h2>         
                        <h3>'.$title.'</h3>
                    </div>     
                </div>
            </div>';      
     
    return $html;
     
}
add_shortcode( 'vc_counter', 'vc_counter_html' );