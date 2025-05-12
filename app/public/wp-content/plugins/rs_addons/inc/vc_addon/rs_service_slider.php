<?php
/*
Element Description: Rs Team Box
*/
     
    // Element Mapping
    function vc_rs_service_slider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        
        $category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );  
        $args = array(
            'taxonomy' => array('service-category'),//ur taxonomy
            'hide_empty' => false,                  
        );

        $terms_= new WP_Term_Query( $args );
        foreach ( (array)$terms_->terms as $term ) {
            $category_dropdown[$term->name] = $term->slug;      
        } 
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs Service Slider', 'rsaddon'),
                'base' => 'vc_serviceslider',
                'description' => __('Rs Service Slider Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(   
                    
                    array(
                        "type" => "dropdown",
                        "heading" => __("Slider Style", "rsaddon"),
                        "param_name" => "service_slider_style",
                        "value" => array(                                                       
                            'Style 1' => "Style 1", 
                            'Style 2' => "Style 2",                                                   
                                                                               
                        ),                        
                    ),

                    array(
                        'type'       => 'dropdown',
                        'heading'    => __( 'Slider Thumbnail Align', 'rsaddon' ),
                        'param_name' => 'align',
                        'value' => array(
                            __( 'Select' )   => '',
                            __( 'Left', 'rsaddon' )   => 'left',
                            __( 'Right', 'rsaddon' )  => 'right',
                        ),
                        "dependency" => Array('element' => 'service_slider_style', 'value' => array('Style 3')),
                    ),

                    array(
                        "type" => "dropdown",
                        "heading" => __("Show title", "rsaddon"),
                        "param_name" => "title",
                        "value" => array(                                                       
                            'Yes' => "Yes", 
                            'No' => "No",                                                                                                                                                                       
                        ),                                                
                    ),

                    array(
                        "type" => "checkbox",
                        "class" => "",
                        "heading" => __( "Title Uppercase", "rsaddon" ),
                        "param_name" => "title_case",
                        "value" => '',
                        "description" => __( "If checked title will be show in uppercase.", "rsaddon" ),
                        "dependency" => Array('element' => 'title', 'value' => array('Yes')),
                    ),

                    array(
                        "type"       => "textfield",
                        "heading"    => __("Excerpt Limit", 'rsaddon'),
                        "param_name" => "excerpt_limit",
                        'value' => "22",                                              
                    ), 

                    array(
                    "type" => "dropdown_multi",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Categories", 'rsaddon' ),
                    "param_name" => "cat",
                    'value' => $category_dropdown,
                    ),

                    array(
                        "type" => "textfield",
                        "heading" => __("Service Per Pgae", "rsaddon"),
                        "param_name" => "team_per",
                        'value' =>"6",
                        'description' => __( 'You can write how many team member show. ex(2)', 'rsaddon' ),                  
                    ),

                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Service Link', 'rsaddon' ),
                        'param_name'  => 'link_type',
                        "value" => array(                                                       
                            'No Link' => "", 
                            'Default Link' => "default_link",                                                                  
                            'External Link' => "external_link"                                                                        
                        ),                     
                    ),

                    array(
                        'type'        => 'vc_link',
                        'heading'     => __( 'External URL (Link)', 'rsaddon' ),
                        'param_name'  => 'service_link',
                        'description' => __( 'Add link to Serices Pages.', 'rsaddon' ),
                        "dependency" => Array('element' => 'link_type', 'value' => array('external_link')),                   
                    ),

                    array(
                        "type" => "dropdown",
                        "heading" => __("Show Read More", "rsaddon"),
                        "param_name" => "read_more",
                        'description' => __( 'Show read more', 'rsaddon' ),
                        "value" => array(
                            __( 'No', 'rsaddon')   => '',
                            __( 'Yes', 'rsaddon') => 'yes',
                        ),
                        
                    ),

                    array(
                        "type"       => "dropdown",
                        "heading"    => __("Button Type", 'rsaddon'),
                        "param_name" => "readmore_type",
                        "value"      => array(
                            'Select' => "",
                            'Text' => "text",
                            'Icon' => "icon",
                        ),
                        "dependency" => Array('element' => 'read_more', 'value' => array('yes')),                    
                    ),

                    array(
                        "type" => "textfield",
                        "heading" => __("Read More Text", 'rsaddon'),
                        "param_name" => "more_text",
                        'description' => __( 'Type your read more text here', 'rsaddon' ),
                        "dependency" => Array('element' => 'readmore_type', 'value' => array('text')),
                    ),

                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __( "Service Title Color", "rsaddon" ),
                        "param_name" => "title_color",
                        "value" => '',
                        "description" => __( "Choose title color", "rsaddon" ),
                       
                    ), 

                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __( "Border Color", "rsaddon" ),
                        "param_name" => "border_color",
                        "value" => '',
                        "description" => __( "Choose border color", "rsaddon" ),
                       
                    ),

                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __( "Service Description Color", "rsaddon" ),
                        "param_name" => "desc_color",
                        "value" => '',
                        "description" => __( "Choose description color", "rsaddon" ),
                        
                    ), 

                    array(
                        "type" => "colorpicker",
                        "class" => "",
                        "heading" => __( "Service Background Color", "rsaddon" ),
                        "param_name" => "desc_bg",
                        "value" => '',
                        "description" => __( "Choose description Background color", "rsaddon" ),
                       
                    ),

                    //item show depending on screen size
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Number of items ( Desktops > 1199px )", 'rsaddon' ),
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
                        'group' => 'Style',
                        "dependency" => Array('element' => 'service_slider_style', 'value' => array('Style 2', 'Style 1')),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Number of items ( Desktops > 991px )", 'rsaddon' ),
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
                        'group' => 'Style',
                        "dependency" => Array('element' => 'service_slider_style', 'value' => array('Style 2', 'Style 1')),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Number of items ( Tablets > 767px )", 'rsaddon' ),
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
                        'group' => 'Style',
                        "dependency" => Array('element' => 'service_slider_style', 'value' => array('Style 2', 'Style 1')),
                    ),
                    array(
                        "type" => "dropdown",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __( "Number of items ( Small Phones < 480px )", 'rsaddon' ),
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
                        'group' => 'Style',
                        "dependency" => Array('element' => 'service_slider_style', 'value' => array('Style 2', 'Style 1')),
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
                        'group' => 'Style',                      
                    ),
                
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'rsaddon' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'rsaddon' ),
                    ),            
                        
                ),
                
                    
            )
        );                                   
    }
     
   add_action( 'vc_before_init', 'vc_rs_service_slider_mapping' );
     
    // Element HTML
    function vc_rsservice_slider_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'                => '',                      
                    'title_case'           => '',                      
                    'team_per'             => '6',                                     
                    'align'                => '',                                     
                    'css_class_custom'     => '',                                     
                    'excerpt_limit'        => '22',                                     
                    'service_slider_style' => '',                                     
                    'css'                  => '' ,
                    'cat'                  => '',           
                    'read_more'            => '',           
                    'readmore_type'        => '',           
                    'more_text'            => '',           
                    'link_type'            => '',           
                    'service_link'         => '',           
                    'title_color'          => '',           
                    'border_color'         => '',           
                    'desc_color'           => '',           
                    'desc_bg'              => '',
                    'col_lg'               => '3',
                    'col_md'               => '3',
                    'col_sm'               => '3',
                    'col_mobile'           => '1',          
                    'slider_dots'          => 'false',          
                ), 
                $atts,'vc_serviceslider'
           )
        );
    
        $a = shortcode_atts(array(
            'screenshots' => 'screenshots',
        ), $atts);

        //parse link for vc linke
        if($link_type == "external_link"){
            //parse link for vc linke       
            $service_link = ( '||' === $service_link ) ? '' : $service_link;
            $service_link = vc_build_link( $service_link );
            $use_link = false;
            if ( strlen( $service_link['url'] ) > 0 ) {
                $use_link = true;
                $a_href = $service_link['url'];
                $a_title = $service_link['title'];
                $a_target = $service_link['target'];
            }
            
            if ( $use_link ) {
                $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
                $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
                if ( ! empty( $a_target ) ) {
                    $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
                }
            }
            $attributes = implode( ' ', $attributes );
        }

        $img = wp_get_attachment_image_src($a["screenshots"], "large");
        $imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}
        
        //extract content
       // $atts['content'] = $content;

        if(!empty($content)) {
            $main_content = $content;
        } else {
            $main_content = ''; 
        }

        //extact icon 
        $iconClass = isset( ${'icon_fontawesome'} ) ? esc_attr( ${'icon_fontawesome'} ) : 'fa fa-users';
        //extract css edit box
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 

        //custom color added
        $title_color  = ($title_color) ? ' style="color: '.$title_color.'"' : '';
        $border_color = ($border_color) ? ' style="border-color: '.$border_color.'"' : '';
        $desc_color   = ($desc_color) ? ' style="color: '.$desc_color.'"' : '';
        $desc_bg      = ($desc_bg) ? ' style="background: '.$desc_bg.'"' : '';
        $title_case = ($title_case=="true") ? 'title-upper' : '';

        $html='<div class="rs-team">
        <div class="team-carousel owl-carousel owl-navigation-yes">';       
        $post_title_show='';
        $degination='';
        $description_team='';

            
        //******************//
        // query post
        //******************//
        $cat;
        $arr_cats=array();
        $arr= explode(',', $cat);  

            for ($i=0; $i < count($arr) ; $i++) { 
            //$cats = get_term_by('slug', $arr[$i], $taxonomy);
            // if(is_object($cats)):
            $arr_cats[]= $arr[$i];
            //endif;
        }  
        if(empty($cat)){
            $best_wp = new wp_Query(array(
                    'post_type' => 'services',
                    'posts_per_page' =>$team_per,
                    
            ));   
        }   
        else{
            $best_wp = new wp_Query(array(
                    'post_type' => 'services',
                    'posts_per_page' =>$team_per,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'service-category',
                            'field' => 'slug', //can be set to ID
                            'terms' => $arr_cats//if field is ID you can reference by cat/term number
                        ),
                    )
            ));   
        }  
            
            if("Style 2" == $service_slider_style ){

                $html = '<div class="service-carousel">';
                    while($best_wp->have_posts()): $best_wp->the_post();

                        $post_title= get_the_title($best_wp->ID);
                        $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');

                        if($link_type == ""){
                            $attributes = '';
                            $service_title = $post_title;
                        }
                        if($link_type == "default_link"){
                            $attributes = 'href="' . get_post_permalink($best_wp->ID) . '"';
                            $service_title = '<a '.$attributes.' '.$title_color.'>'.$post_title.'</a>';
                        }
                        if($link_type == "external_link"){
                            $service_title = '<a '.$attributes.' '.$title_color.'>'.$post_title.'</a>';
                        }

                        $title = get_the_title();

                        $excerpt = khelo_custom_excerpt($excerpt_limit);

                        if($link_type != ""){
                            $more_text = ($more_text) ? '<a class="service-readon" '.$attributes.'>Read More</a>' : '';
                            if("icon"==$readmore_type){
                                $more_text = '<div class="icon-button"><a '.$attributes.'><i class="glyph-icon flaticon-right-arrow"></i></a></div>';
                            }
                        }else{
                            $more_text = '';
                        }

                        $service_item_data = array(
                                'col_lg'     => $col_lg,
                                'col_md'     => $col_md,
                                'col_sm'     => $col_sm,
                                'col_mobile' => $col_mobile,
                                'slider_dots'=> $slider_dots,
                            );                            
                            wp_localize_script( 'khelo-main', 'service_slider_data', $service_item_data );

                        $html .= '
                            <div class="service-item slider-services-style2 '.$css_class.' '.$css_class_custom.'" '.$border_color.'>';
                                if ($post_img_url) {
                                    $html .= '<div class="service-img">                                    
                                        <img src="'.$post_img_url.'" alt="" />

                                    </div>';

                                }
                                $html .= '
                                    <div class="services-desc">
                                        <h4 class="services-title '.$title_case.'">'.$service_title.'</h4>
                                        <p '.$desc_color.'>'.$excerpt.'</p>
                                        '.$more_text.'
                                    </div>
                                </div>';
                        endwhile;
                $html .='</div>';   
            }

            
            else
            {
                $html = '<div class="service-carousel">';
                    while($best_wp->have_posts()): $best_wp->the_post();

                        $post_title= get_the_title($best_wp->ID);
                        $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');

                        if($link_type == ""){
                            $attributes = '';
                            $service_title = $post_title;
                        }
                        if($link_type == "default_link"){
                            $attributes = 'href="' . get_post_permalink($best_wp->ID) . '"';
                            $service_title = '<a '.$attributes.' '.$title_color.'>'.$post_title.'</a>';
                        }
                        if($link_type == "external_link"){
                            $service_title = '<a '.$attributes.' '.$title_color.'>'.$post_title.'</a>';
                        }

                        $title = get_the_title();

                        $excerpt = khelo_custom_excerpt($excerpt_limit);

                        if($link_type != ""){
                            $more_text = ($more_text) ? '<div class="link"><a '.$attributes.'>Read More</a><i class="fa fa-long-arrow-right"></i></div>' : '';
                            if("icon"==$readmore_type){
                                $more_text = '<div class="icon-button"><a '.$attributes.'> <i class="glyph-icon flaticon-right-arrow"></i></a></div>';
                            }
                        }else{
                            $more_text = '';
                        }

                        $service_item_data = array(
                                'col_lg'     => $col_lg,
                                'col_md'     => $col_md,
                                'col_sm'     => $col_sm,
                                'col_mobile' => $col_mobile,
                                'slider_dots'=> $slider_dots,
                            );                            
                            wp_localize_script( 'khelo-main', 'service_slider_data', $service_item_data );

                        $html .= '
                            <div class="service-item slider-services-style1 single-postion'.$css_class.' '.$css_class_custom.'" '.$border_color.'>';

                                if ($post_img_url) {
                                    $html .= '                                   
                                        <img src="'.$post_img_url.'" alt="" />';
                                }

                                $html .= '
                                    <div class="position-details text-center">
                                        <h4 class="htitle '.$title_case.'">'.$service_title.'</h4>
                                        <div class="hover-text">
                                         <h4 class="'.$title_case.'">'.$service_title.'</h4>
                                            <p '.$desc_color.'>'.$excerpt.'</p>
                                            '.$more_text.'
                                        </div>
                                    </div>
                                </div>';
                        endwhile;
                $html .='</div>';   
            }
    return $html; 
}

add_shortcode( 'vc_serviceslider', 'vc_rsservice_slider_html' );