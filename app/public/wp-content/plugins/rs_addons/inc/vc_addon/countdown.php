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
            'name'        => __('Rs Counter', 'rsaddon'),
            'base'        => 'vc_counter',
            'description' => __('Rs counter for project', 'rsaddon'), 
            'category'    => __('by RS Theme', 'rsaddon'),   
            'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',            
            'params'      => array(   
            
                array(
                    "type"                => "dropdown",
                    "heading"             => __("Border Style", 'rsaddon'),
                    "param_name"          => "border_style",
                    "value"               => array(
                    __( 'No', 'rsaddon')  => '',
                    __( 'Yes', 'rsaddon') => 'border-style',
                    ),
                    "description"         => __("Select yes for border style", 'rsaddon')
                ),
                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Border Color", 'rsaddon' ),
                    "param_name"  => "border_color",
                    "value"       => '',
                    "description" => __( "Box border color", 'rsaddon' ),
                    "dependency" => Array('element' => 'border_style', 'value' => array('border-style')),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Porject Title', 'rsaddon'),
                    'param_name'  => 'title',
                    'value'       => __( '', 'rsaddon'),
                    'description' => __( 'Project Title', 'rsaddon'),
                    'admin_label' => false,
                    'weight'      => 0,
                   
                ),              
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Counter Number', 'rsaddon'),
                    'param_name'  => 'project',
                    'value'       => __( '', 'rsaddon'),
                    'description' => __( 'Project counter (Example: 100 only number)', 'rsaddon'),
                    'admin_label' => false,
                    'weight'      => 0,
                    
                ),

                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Counter Post Text', 'rsaddon'),
                    'param_name'  => 'post_text',
                    'value'       => __( '', 'rsaddon'),
                    'description' => __( 'Counter post text here. Example: %, $ etc', 'rsaddon'),                    
                ),

                array(
                    'type'         => 'iconpicker',
                    'heading'      => __( 'Counter Icon', 'rsaddon'),
                    'param_name'   => 'icon_fontawesome',
                    'value'        => '', // default value to backend editor admin_label
                    'settings'     => array(
                    'emptyIcon'    => true,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    
                    'description'  => __( 'Select icon from library.', 'rsaddon'),
                ),
                array(
                    "type"                   => "dropdown",
                    "heading"                => __("Select Icon Align", 'rsaddon'),
                    "param_name"             => "align",
                    "value"                  => array(
                    __( 'Left', 'rsaddon')   => 'left',
                    __( 'Center', 'rsaddon') => 'text-center',
                    __( 'Right', 'rsaddon')  => 'right',
                    ),
                    "std"                    => 'style1',
                    "admin_label"            => true,
                    "description"            => __("", 'rsaddon')
                ),
                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Counter Background Color", 'rsaddon' ),
                    "param_name"  => "counter_bg",
                    "value"       => '',
                    "description" => __( "Counter background here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),
                
                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Icon Color", 'rsaddon' ),
                    "param_name"  => "icon_color",
                    "value"       => '',
                    "description" => __( "Choose icon color here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),
                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Number Color", 'rsaddon' ),
                    "param_name"  => "number_color",
                    "value"       => '',
                    "description" => __( "Choose number color here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),
                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Title Color", 'rsaddon' ),
                    "param_name"  => "title_color",
                    "value"       => '',
                    "description" => __( "Choose title color here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Icon Size", 'rsaddon' ),
                    "param_name"  => "icon_size",
                    "value"       => '',
                    "description" => __( "Choose Icon Size here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),  

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Title Font Size", 'rsaddon' ),
                    "param_name"  => "title_font_size",
                    "value"       => '',
                    "description" => __( "Choose Font Size here", 'rsaddon' ),
                    'group'       => 'Styles',
                ), 
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Number Font Size", 'rsaddon' ),
                    "param_name"  => "number_font_size",
                    "value"       => '',
                    "description" => __( "Choose Font Size here", 'rsaddon' ),
                    'group'       => 'Styles',
                ), 

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Post Text Size", 'rsaddon' ),
                    "param_name"  => "pre_text_size",
                    "value"       => '',
                    "description" => __( "Choose Font Size here", 'rsaddon' ),
                    'group'       => 'Styles',
                ), 

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Margin Top", 'rsaddon' ),
                    "param_name"  => "margin_spc_top",
                    "value"       => '',
                    "description" => __( "Enter Margin here", 'rsaddon' ),
                    'group'       => 'Styles',
                ), 

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Margin Buttom", 'rsaddon' ),
                    "param_name"  => "margin_spc_btm",
                    "value"       => '',
                    "description" => __( "Enter Margin here", 'rsaddon' ),
                    'group'       => 'Styles',
                ),

                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Extra class name', 'rsaddon'),
                    'param_name'  => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon'                                                                    ),
                ), 
                array(
                    "type"        => "attach_image",
                    "heading"     => __( "Counter Background Image", "rsaddon" ),
                    "description" => __( "Add Counter Background image", "rsaddon" ),
                    "param_name"  => "conterbg",
                    "value"       => "",
                    'group' => 'Styles',
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
                'title'            => 'Counter Title',
                'title_font_size'  => '22px',
                'number_font_size' => '30px',
                'icon_size'        => '',
                'margin_spc_top'       => '0px',
                'margin_spc_btm'       => '4px',
                'pre_text_size'    => '',
                'border_style'     => '',
                'border_color'     => '',
                'project'          => '',
                'post_text'        => '',
                'align'            => '',
                'icon_fontawesome' =>'',
                'icon_color'       =>'',
                'icon_color'       =>'',
                'counter_bg'       =>'',
                'conterbg'         =>'',
                'title_color'      =>'',
                'number_color'     =>'#e2c606',
                'el_class'         =>'',
            ), 
            $atts,'vc_counter'
        )
    );

    //Counter Background Image
    $a = shortcode_atts(array(
      'conterbg' => 'conterbg',
    ), $atts);

    $img = wp_get_attachment_image_src($a["conterbg"], "large");

    if(isset($img[0])) {
        $imgSrc = $img[0];
    } else {
        $imgSrc = '';
    }

    $counter_bg_img = ($imgSrc) ? ' style="background-image: url('.$imgSrc.')"' : '';
    
     //custom class added
    $wrapper_classes = array($el_class) ;           
    $class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );        
    $css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

    $border_style = ($border_style) ? 'border-style' : '';
    $icon_color = ($icon_color) ? ' style="color: '.$icon_color.'"' : '';
    $title_color = ($title_color) ? ' style="color: '.$title_color.'"' : '';   
    $title_font_size = ($title_font_size) ? ' style="font-size: '.$title_font_size.'; line-height: '.$title_font_size.'!important"' : '';
    $icon_size = ($icon_size) ? ' style="font-size: '.$icon_size.'; line-height: '.$icon_size .'!important"' : '';
    $border_color = ($border_color) ? ' style="border-color: '.$border_color.'"' : '';
    $counter_bg = ($counter_bg) ? ' style="background: '.$counter_bg.'"' : '';
    $post_text = ($post_text) ? '<span style="font-size:'.$pre_text_size.'; line-height:'.$pre_text_size.'">'.$post_text.'</span>' : '';
    $count_icon = ($icon_fontawesome !== '') ? '<div class="count-icon" '.$icon_size.'><i class="'.$icon_fontawesome.'"'.$icon_color.'></i></div>' : '';

    $html = '
    <div class="counter-top-area '.$align.' '.$border_style.'" '.$counter_bg.' '.$counter_bg_img.' '.$border_color.'>

    <div class="rs-counter-list">
        '.$count_icon.'
    <div class="count-text"><div style="margin-top:'.$margin_spc_top.'; margin-bottom:'.$margin_spc_btm.'; color:'.$number_color.'" class="count-number">
    <span style="font-size:'.$number_font_size.'; line-height:'.$number_font_size.'; color:'.$number_color.'" class="rs-counter"> ' . $project. '</span> <span style="color:'.$number_color.'">'.$post_text.'</span></div>         
        <h4 '.$title_color.'><span '.$title_font_size.'>'.$title.'</span></h4></div>
    </div></div>';
     
    return $html;
     
}
add_shortcode( 'vc_counter', 'vc_counter_html' );