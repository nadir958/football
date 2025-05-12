<?php
/*
Element Description: Department Grid
*/
     
    // Element Mapping
    function vc_rs_department_grid_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        
        $category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );  
        $args = array(
            'taxonomy' => array('event_category'),//ur taxonomy
            'hide_empty' => false,                  
        );

        $terms_= new WP_Term_Query( $args );
        foreach ( (array)$terms_->terms as $term ) {
            $category_dropdown[$term->name] = $term->slug;      
        } 
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Rs Department Grid', 'rsaddon'),
                'base' => 'vc_departmentgrid',
                'description' => __('Rs Department Grid Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                    array(
                        "type" => "dropdown",
                        "heading" => __("Show Excerpt", "rsaddon"),
                        "param_name" => "show_desc",
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
                        "type" => "textfield",
                        "heading" => __("Read More Text", 'rsaddon'),
                        "param_name" => "more_text",
                        'description' => __( 'Type your read more text here', 'rsaddon' ),
                        "dependency" => Array('element' => 'read_more', 'value' => array('yes')),
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
                        "heading" => __( "Number of items per row", 'rsaddon' ),
                        "param_name" => "per_row",
                        "value" => array(                           
                                    '1' => "1", 
                                    '2' => "2",
                                    '3' => "3", 
                                    '4' => "4",
                                    '6' => "6",                                                                                     
                                ),
                        "std" => "3",
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
     
   add_action( 'vc_before_init', 'vc_rs_department_grid_mapping' );
     
    // Element HTML
    function vc_department_grid_html( $atts,$content ) {
         $attributes = array();
        // Params extraction
        extract(
            shortcode_atts(
                array(                      
                    'show_desc'            => 'Yes',                      
                    'title_case'           => '',                      
                    'team_per'             => '6',                                          
                    'css_class_custom'     => '',                                                                         
                    'css'                  => '' ,
                    'cat'                  => '',           
                    'read_more'            => '',                     
                    'more_text'            => '',           
                    'link_type'            => '',           
                    'service_link'         => '',           
                    'title_color'          => '',           
                    'border_color'         => '',           
                    'desc_color'           => '',           
                    'desc_bg'              => '',
                    'per_row'               => '3',        
                ), 
                $atts,'vc_departmentgrid'
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

        $col_grid ="";
        if($per_row == 1){
           $col_grid = 12;
        }
        else if($per_row == 2){
           $col_grid = 6;
        }  
        else if($per_row == 3){
            $col_grid = 4;
        }    
        else if($per_row == 4){
            $col_grid = 3;
        }    
        else if($per_row == 6){
            $col_grid = 2;
        }    
        else{
            $col_grid = 4;
        }      
        
        //extract content

        if(!empty($content)) {
            $atts['content'] = $content;
		} else {
			$atts['content'] = ''; 
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


        $html='<div class="rs-departments-grid-wrap">
        <div class="rs-departments-grid">';       
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
                    'post_type' => 'mp-event',
                    'posts_per_page' =>$team_per,
                    
            ));   
        }   
        else{
            $best_wp = new wp_Query(array(
                    'post_type' => 'mp-event',
                    'posts_per_page' =>$team_per,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'event_category',
                            'field' => 'slug', //can be set to ID
                            'terms' => $arr_cats//if field is ID you can reference by cat/term number
                        ),
                    )
            ));   
        }  
            

        $html = '<div class="department-grid row">';

            while($best_wp->have_posts()): $best_wp->the_post();

                $post_title= get_the_title($best_wp->ID);
                $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
                $department_icon = get_post_meta( get_the_ID(), 'icon-thumb', true );

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

                $excerpt = get_post_meta( get_the_ID(), 'content_dept', true );
                $desc_text = "";
                if($show_desc == "Yes"){
                    $desc_text = '<p '.$desc_color.'>'.$excerpt.'</p>';
                }              


                if($link_type != ""){
                    $more_text = ($more_text) ? '<a class="service-readon" '.$attributes.'>Read More</a>' : '';
                }else{
                    $more_text = '';
                }

                $html .= '
                    <div class="department-item col-md-'.$col_grid.' '.$css_class.' '.$css_class_custom.'" '.$desc_bg.'>';
                        if ($department_icon) {
                            $html .= '<div class="department-img">
                                <img src="'.$department_icon.'" alt="" />                                
                            </div>';

                        }
                        $html .= '
                            <div class="department-desc" '.$desc_bg.'>
                                <h4 class="services-title '.$title_case.'">'.$service_title.'</h4> 
                                '. $desc_text.'                               
                                '.$more_text.'
                            </div>
                        </div>';
                endwhile;
        $html .='</div>';   
    return $html; 
}

add_shortcode( 'vc_departmentgrid', 'vc_department_grid_html' );