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
        
        $categories        = get_categories();
        $category_dropdown = array( 'All Categories' => '0' );
        
        foreach ( $categories as $category ) {
            $category_dropdown[$category->name] = $category->slug;
        }
        // Map the block with vc_map()
        vc_map( 
            array(
                'name'        => __('Rs Posts Slider', 'rsaddon'),
                'base'        => 'vc_postsslider',
                'description' => __('Rs Posts Slider Information', 'rsaddon'), 
                'category'    => __('by RS Theme', 'rsaddon'),   
                'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params'      => array(   
                    
                    array(
                        "type"       => "dropdown",
                        "heading"    => __("Slider Style", "rsaddon"),
                        "param_name" => "posts_slider_style",
                        "value"      => array(                                                       
                        'Style 1'    => "Style 1", 
                        'Style 2'    => "Style 2",                                                                                                                                               
                        ),                        
                    ),

                    array(
                        "type"       => "dropdown_multi",
                        "holder"     => "div",
                        "class"      => "",
                        "heading"    => __( "Categories", 'rsaddon' ),
                        "param_name" => "cat",
                        'value'      => $category_dropdown,
                    ),

                    array(
                        "type"        => "textfield",
                        "heading"     => __("Post Per Pgae", "rsaddon"),
                        "param_name"  => "post_per",
                        'value'       =>"6",
                        'description' => __( 'You can write how many team member show. ex(2)', 'rsaddon' ),                  
                    ),

                   
                    array(
                        "type"       => "dropdown",
                        "heading"    => __("Show Post Title", "rsaddon"),
                        "param_name" => "posts_title",
                        "value" => array(                                                       
                            'No'  => "", 
                            'Yes' => "yes",                                                                                                                                                                       
                        ),                  
                    ), 

                    array(
                        "type"       => "textfield",
                        "heading"    => __("Title Font Size", 'rsaddon'),
                        "param_name" => "title_font",
                        'value'      => "60px", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ), 

                    array(
                        "type"       => "colorpicker",
                        "heading"    => __("Text Color", 'rsaddon'),
                        "param_name" => "text_color",
                        'value'      => "#fff", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ),

                     array(
                        "type"       => "dropdown",
                        "heading"    => __("Text Alignment", "rsaddon"),
                        "param_name" => "text_alignment",
                        "value"      => array(                                                       
                        'Left'    => "left", 
                        'Right'    => "right", 
                        'Center'    => "center",                                                                                                                                                                        
                        ),   
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                        
                    ),

                    array(
                        "type"       => "colorpicker",
                        "heading"    => __("Thumbnail Boxes Bg", 'rsaddon'),
                        "param_name" => "box_bg",
                        'value'      => "#222934", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ),

                     array(
                        "type"       => "colorpicker",
                        "heading"    => __("Thumbnail Active Boxes Bg", 'rsaddon'),
                        "param_name" => "box_bg",
                        'value'      => "#313a47", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ),


                     array(
                        "type"       => "colorpicker",
                        "heading"    => __("Thumbnail Text Color", 'rsaddon'),
                        "param_name" => "text_color_thumb",
                        'value'      => "#fff", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ),

                      array(
                        "type"       => "colorpicker",
                        "heading"    => __("Thumbnail Meta Text Color", 'rsaddon'),
                        "param_name" => "text_color_meta",
                        'value'      => "#ccc", 
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                       
                    ),

                      array(
                        "type"       => "dropdown",
                        "heading"    => __("Thumbboxes Text Alignment", "rsaddon"),
                        "param_name" => "text_alignment_thumb",
                        "value"      => array(                                                       
                        'left'    => "Left", 
                        'right'    => "Right", 
                        'center'    => "Center",                                                                                                                                                                        
                        ),   
                        "dependency" => Array('element' => 'posts_slider_style ', 'value' => array('Style 2')),                        
                    ),
                  

                    array(
                        "type"       => "dropdown",
                        "heading"    => __("Show Excerpt", 'rsaddon'),
                        "param_name" => "show_excerpt",
                        "value"      => array(                                                
                            'No' => "",
                            'Yes' => "yes",                                                                           
                        ),                      
                    ),   
                    array(
                        "type"       => "textfield",
                        "heading"    => __("Excerpt Limit", 'rsaddon'),
                        "param_name" => "excerpt_limit",
                        'value'      => "22", 
                        "dependency" => Array('element' => 'show_excerpt', 'value' => array('yes')),                       
                    ), 
                    array(
                        'type'       => 'css_editor',
                        'heading'    => __( 'CSS box', 'rsaddon' ),
                        'param_name' => 'css',
                        'group'      => __( 'Design Options', 'rsaddon' ),
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
                    'post_per'             => '6',                                     
                    'posts_title'          => 'no',                                     
                    'show_excerpt'         => 'no',                                     
                    'excerpt_limit'        => '22',                                     
                    'align'                => '',                                     
                    'css_class_custom'     => '',                                     
                    'posts_slider_style'   => '',                                     
                    'css'                  => '' ,
                    'cat'                  => '',           
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
                    'text_alignment'       => 'center',
                    'title_font'           => '', 
                    'text_color'           => '',         
                ), 
                $atts,'vc_postsslider'
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
                $a_href   = $service_link['url'];
                $a_title  = $service_link['title'];
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
        $imgSrc = !empty($img) ? $img[0] : '';

        $imgSrc = '';
		if(isset($img[0])) {
			$imgSrc = $img[0];
		}
        
        //extract content
      //  $atts['content'] = $content;

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

        $html='<div class="rs-team">
        <div class="team-carousel owl-carousel owl-navigation-yes">';       
        $post_title_show  ='';
        $degination       ='';
        $description_team ='';
            
        //******************//
        // query post
        //******************//
        $cat;
        $arr_cats = array();
        $arr      = explode(',', $cat);  

            for ($i=0; $i < count($arr) ; $i++) { 
            //$cats = get_term_by('slug', $arr[$i], $taxonomy);
            // if(is_object($cats)):
            $arr_cats[]= $arr[$i];
            //endif;
        }  
        if( empty($cat) ){
            $best_wp = new wp_Query(array(
                'posts_per_page'    =>$post_per,
                'order'             => 'DESC',                                              
            )); 
        }
        else{
            $best_wp = new wp_Query(array(
                'posts_per_page'    =>$post_per,
                'order'             => 'DESC',
                'category_name'     => $cat,    
            )); 
        } 

        if("Style 2" == $posts_slider_style ){
          $text_align =  !empty($text_alignment) ? 'style ="text-align: '.$text_alignment.' "' : '';
            $html = '<section id="rs-blog-tab-slider" class="rs-services style2">  
                <div>                   
                    <div class="clfeatures">
                        <div class="thumbnail-full-slider clearfix">                            

                            <div class="thumbnail-full-2">
                                <div id="feature-left" class="menu-carousel owl-carousel image-carousel feature-left custom-js owl-loaded">';
                                   $text_color =  !empty($text_color) ? 'style ="color: '.$text_color.' "' : '';
                                    while($best_wp->have_posts()): $best_wp->the_post();

                                        $post_title          = get_the_title($best_wp->ID);                                        
                                        $description_title   ='';
                                        $description_excerpt ='';
                                        $post_date           = get_the_date();
                                        $post_admin          = get_the_author();
                                        $post_img_url        = get_the_post_thumbnail_url($best_wp->ID,'khelo_blog_extra_large');
                                        $post_url            = get_post_permalink($best_wp->ID); 
                                        $title               = get_the_title();  
                                        $excerpt = '';
                                        if(function_exists('khelo_custom_excerpt')) {
                                            $excerpt             = khelo_custom_excerpt($excerpt_limit);
                                        }
                                       
                                        $categories          = get_the_category();

                                        if($show_excerpt == 'yes'){
                                            $description_excerpt= '<p>'.$excerpt.'</p>';
                                        }
                                        if($posts_title == 'yes'){
                                            $text_font =  !empty($title_font) ? 'style ="font-size: '.$title_font.' "' : '';
                                           
                                            $description_title= '<h4 class="feature-title" '.$text_font.'><a '.$text_color.' href="'.$post_url.'">'.$title.'</a></h4>';
                                        }
                                       

                                        if($link_type == ""){
                                            $attributes    = '';
                                            $service_title = $post_title;
                                            $service_image = '<img src="'. $post_img_url.'" alt="" >';
                                        }
                                        if($link_type == "default_link"){
                                            $attributes    = 'href="' . get_post_permalink($best_wp->ID) . '"';
                                            $service_title = '<a '.$attributes.'>'.$post_title.'</a>';
                                            $service_image = '<a '.$attributes.'><img src="'. $post_img_url.'" alt="" ></a>';
                                        }
                                        if($link_type == "external_link"){
                                            $service_title = '<a '.$attributes.'>'.$post_title.'</a>';
                                            $service_image = '<a '.$attributes.'><img src="'. $post_img_url.'" alt="" ></a>';
                                        }

                                        $html .='<div class="cl-ft-item">
                                          
                                            <div class="feature-content clearfix" '.$text_align.'>
                                                <div class="bl-meta" '.$text_color.'>';
                                                    foreach ( $categories as $category ){ 
                                                        $cat_link = get_category_link( $category->term_id );
                                                        $html .= '<span class="cat"><a href="'.$cat_link.'">'.$category->cat_name.' </a></span>';
                                                    }
                                                    $html .=' <span><i class="fa fa-calendar-check-o"></i> '.$post_date.'</span>
                                                    <span><i class="fa fa-user"></i> '.$post_admin.'</span>
                                                </div>
                                                <div class="heading-block">
                                                    '.$description_title.'
                                                    '.$description_excerpt.'
                                                </div>
                                            </div>
                                        </div>';                      
                                        endwhile;  
                                        wp_reset_query();          
                                $html .='</div>

                                <div class="col-padding-right clearfix">
                                    <div id="item-thumb" class="item-thumb">';

                                        while($best_wp->have_posts()): $best_wp->the_post();
                                            $post_title= get_the_title($best_wp->ID);            
                                            $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
                                            $ttile = get_the_title();
       
                                        $html .= '<div class="owl-dot">                                          
                                                <h5 class="overlay-feature-title">
                                                    <a href="#">
                                                        <div class="bl-meta">
                                                            <span><i class="fa fa-calendar-check-o"></i> '.$post_date.'</span>
                                                            <span><i class="fa fa-user"></i> '.$post_admin.'</span>
                                                        </div> 
                                                        '.$ttile.'
                                                                                                       
                                                    </a>
                                                </h5>

                                        </div>';

                                        endwhile; 
                                        wp_reset_query(); 

                                    $html .= '</div>
                                </div>
                            </div>                           

                        </div>
                    </div>
                </div>
            </section>' ; 
        }
        else
        {
            $html = '<section id="rs-blog-tab-slider" class="rs-services">  
                <div>                   
                    <div class="clfeatures">
                        <div class="thumbnail-full-slider clearfix">                            

                            <div class="thumbnail-full">
                                <div id="feature-left" class="menu-carousel owl-carousel image-carousel feature-left custom-js owl-loaded">';
                                    while($best_wp->have_posts()): $best_wp->the_post();
                                        $post_title= get_the_title($best_wp->ID);
            
                                        $description_title ='';
                                        $description_excerpt ='';
                                        $post_date = get_the_date();
                                        $post_admin = get_the_author();
                                        $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'khelo_blog_extra_large');
                                        $post_url = get_post_permalink($best_wp->ID); 
                                        $title = get_the_title();



                                        $excerpt = '';
                                        if(function_exists('khelo_custom_excerpt')) {
                                            $excerpt             = khelo_custom_excerpt($excerpt_limit);
                                        }

                                        if($show_excerpt == 'yes'){
                                            $description_excerpt= '<p>'.$excerpt.'</p>';
                                        }
                                        if($posts_title == 'yes'){
                                            $description_title= '<h4 class="feature-title"><a href="'.$post_url.'">'.$title.'</a></h4>';
                                        }
                                       

                                        if($link_type == ""){
                                            $attributes = '';
                                            $service_title = $post_title;
                                            $service_image = '<img src="'. $post_img_url.'" alt="" >';
                                        }
                                        if($link_type == "default_link"){
                                            $attributes = 'href="' . get_post_permalink($best_wp->ID) . '"';
                                            $service_title = '<a '.$attributes.'>'.$post_title.'</a>';
                                            $service_image = '<a '.$attributes.'><img src="'. $post_img_url.'" alt="" ></a>';
                                        }
                                        if($link_type == "external_link"){
                                            $service_title = '<a '.$attributes.'>'.$post_title.'</a>';
                                            $service_image = '<a '.$attributes.'><img src="'. $post_img_url.'" alt="" ></a>';
                                        }



                                        $html .='<div class="cl-ft-item">
                                            <a href="'.$post_url.'">'.$service_image.'</a>
                                            <div class="feature-content clearfix">
                                                <div class="bl-meta">
                                                    <span><i class="fa fa-calendar-check-o"></i> '.$post_date.'</span>
                                                    <span><i class="fa fa-user"></i> '.$post_admin.'</span>
                                                </div>
                                                <div class="heading-block">
                                                    '.$description_title.'
                                                    '.$description_excerpt.'
                                                </div>
                                            </div>
                                        </div>';                      
                                        endwhile;  
                                        wp_reset_query();           
                                $html .='</div>

                                <div class="col-padding-right clearfix">
                                    <div id="item-thumb" class="item-thumb">';

                                        while($best_wp->have_posts()): $best_wp->the_post();
                                            $post_title= get_the_title($best_wp->ID);            
                                            $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
                                            $ttile = get_the_title();
       
                                        $html .= '<div class="owl-dot">
                                            <img src="'.$post_img_url.'" alt="" />
                                                <h5 class="overlay-feature-title">
                                                    <a href="#">
                                                        '.$ttile.'
                                                        <div class="bl-meta">
                                                            <span><i class="fa fa-calendar-check-o"></i> '.$post_date.'</span>
                                                            <span><i class="fa fa-user"></i> '.$post_admin.'</span>
                                                        </div>

                                                
                                                    </a>
                                                </h5>

                                        </div>';

                                        endwhile; 
                                        wp_reset_query(); 

                                    $html .= '</div>
                                </div>
                            </div>                           

                        </div>
                    </div>
                </div>
            </section>' ;
    }
    return $html; 
}
add_shortcode( 'vc_postsslider', 'vc_rsservice_slider_html' );