<?php
/*
Element Description: Rs Slider
*/
// Element Mapping
function vc_slider_mapping() {
    // Stop all if VC is not enabled
    if ( !defined( 'WPB_VC_VERSION' ) ) {
        return;
    }

    $category_dropdown = array( __( 'All Categories', 'rs-addon' ) => '0' );	
    $args = array(
                'taxonomy' => array('portfolio-category'),//ur taxonomy
                'hide_empty' => false,                  
        );

	$terms_= new WP_Term_Query( $args );
	foreach ( (array)$terms_->terms as $term ) {
		$category_dropdown[$term->name] = $term->slug;		
	}
    // Map the block with vc_map()
    vc_map( 
        array(
            'name' => __('Porfolio Image Slider', 'rs-option'),
            'base' => 'vc_slider',
            'description' => __('Porfolio Image Slider Addon', 'rs-option'), 
            'category' => __('by RS Theme', 'rs-option'),   
            'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
            'params' => array(
            	array(
            		"type" => "textfield",
            		"heading" => __("Slide Per Page", "rs-option"),
            		"param_name" => "slider_per",
            		'value' =>"6",
            		'description' => __( 'You can write how many slide show. ex(2)', 'rs-option' ),					
            	),
            	array(
					"type" => "dropdown",
					"heading" => __("Container Full Width", "rs-option"),
					"param_name" => "container_fluid",
					"value" => array(
						'Yes' => "Yes", 
						'No' => "No",					
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Full Screen Height", "rs-option"),
					"param_name" => "height_fluid",
					"value" => array(
						'Yes' => "Yes", 
						'No' => "No",					
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Screen Height", "rs-option"),
					"param_name" => "screen_height",
					"value" => array(
						'100%' => "100vh",					
						'95%' => "95vh",					
						'90%' => "90vh",					
						'85%' => "85vh",					
						'80%' => "80vh",					
					),
					"dependency" => Array('element' => 'height_fluid', 'value' => array('Yes')),
				),
            	array(
					"type" => "dropdown_multi",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'rs-addon' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
				),
                array(
					"type" => "dropdown",
					"heading" => __("Show title", "rs-option"),
					"param_name" => "title",
					"value" => array(
						'Yes' => "Yes", 
						'No' => "No",					
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Categories", "rs-option"),
					"param_name" => "show_cats",
					"value" => array(
						'Yes' => "Yes", 
						'No' => "No",					
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Short Description", 'rs-option'),
					"param_name" => "description",
					"value" => array(
						'Yes' => "Yes", 
						'No' => "No",										
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Button Text', 'rs-addon' ),
					'param_name'  => 'btn_text',
					'value'       => __( 'View Portfolio', 'rs-option' ),
					'description' => __( 'Button', 'rs-addon' ),
					'admin_label' => false,
					'weight'      => 0,
					"dependency"  => Array('element' => 'button_type', 'value' => array('text_btn')), 				   
				),
				array(
				    "type" => "dropdown",
				    "heading" => __("Content Align", "rs-addon"),
				    "param_name" => "slide_align",
				    "value" => array(
				        __( 'Left', 'rs-addon')   => 'left',
				        __( 'Center', 'rs-addon') => 'center',
				        __( 'Right', 'rs-addon')  => 'right',
				    ),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Background Position", "rs-option"),
					"param_name" => "background_position",
					"value" => array(
						'Left Top'      => 'left top',
						'Left Center'   => 'left center',
						'Left Bottom'   => 'left bottom',
						'Right Top'     => 'right top',
						'Right Center'  => 'right center',
						'Right Bottom'  => 'right bottom',
						'Center Top'    => 'center top',
						'Center Center' => 'center center',
						'Center Bottom' => 'center bottom'
					),
					'description' => __( 'Set background image position here', 'rs-option' )
				),
				array(
					"type" => "dropdown",
					"heading" => __("Background Position In Small Device", "rs-option"),
					"param_name" => "bg_position_mobile",
					"value" => array(
						'Left Top'      => 'left top',
						'Left Center'   => 'left center',
						'Left Bottom'   => 'left bottom',
						'Right Top'     => 'right top',
						'Right Center'  => 'right center',
						'Right Bottom'  => 'right bottom',
						'Center Top'    => 'center top',
						'Center Center' => 'center center',
						'Center Bottom' => 'center bottom'
					),
					'description' => __( 'Set background image position here', 'rs-option' )
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "rs-addon" ),
					"param_name" => "title_color",
					"value" => '',
					"description" => __( "Choose title color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Category color", "rs-addon" ),
					"param_name" => "cats_color",
					"value" => '',
					"description" => __( "Choose category color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Category Hover color", "rs-addon" ),
					"param_name" => "cats_hover_color",
					"value" => '',
					"description" => __( "Choose category hover color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content color", "rs-addon" ),
					"param_name" => "content_color",
					"value" => '',
					"description" => __( "Choose content color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Button color", "rs-addon" ),
					"param_name" => "btn_color",
					"value" => '',
					"description" => __( "Choose button color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Button Hover color", "rs-addon" ),
					"param_name" => "btn_hover_color",
					"value" => '',
					"description" => __( "Choose button color", "rs-addon" ),
	                'group' => 'Styles',
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'CSS box', 'rs-option' ),
					'param_name' => 'css',
					'group' => __( 'Design Options', 'rs-option' ),
				),
            ),		
				
        )
    );                                   
}
 
add_action( 'vc_before_init', 'vc_slider_mapping' );
     
// Element HTML
function vc_slider_html( $atts,$content ) {
    $attributes = array();
    // Params extraction
    extract(
        shortcode_atts(
            array(
				'title'               => '',
				'description'         => '',
				'show_cats'           => '',
				'cat'                 => '',
				'btn_text'            => __( 'View Portfolio', 'rs-option' ),
				'slider_per'          => '6',
				'slide_align'         => '6',
				'background_position' => 'bottom right',
				'bg_position_mobile'  => 'bottom center',
				'title_color'         => '',
				'content_color'       => '',
				'container_fluid'     => '',
				'height_fluid'        => '',
				'screen_height'       => '',
				'btn_color'           => '',
				'cats_color'          => '',
				'cats_hover_color'    => '',
				'btn_hover_color'     => '',
				'css'                 => ''
            ), 
            $atts,'vc_slider'
       )
    );

	//extract css edit box
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts );

	$html='<div class="rs-slider">
		<div class="rs-slider-carousel">';		
		$post_title_show='';
		$description_team='';
		$slider_per = ( $slider_per != "" ) ? $slider_per : -1;
			
        // Query Post
		$arr_cats=array();
        $arr= explode(',', $cat);
		for ($i=0; $i < count($arr) ; $i++) { 
           	$arr_cats[]= $arr[$i];
        }	  

        if(empty($cat)){
        	$best_wp = new wp_Query(array(
					'post_type' => 'portfolios',
					'posts_per_page' => $slider_per,
					
			));	  
        }
        else{          
		   $best_wp = new wp_Query(array(
				'post_type' => 'portfolios',
				'posts_per_page' => $slider_per,
				'tax_query' => array(
			        array(
			            'taxonomy' => 'portfolio-category',
			            'field' => 'slug', //can be set to ID
			            'terms' => $arr_cats//if field is ID you can reference by cat/term number
			        ),
			    )
			));	
		}

		//Color Css
	    $title_color = ($title_color) ? ' style="color: '.$title_color.'"' : '';
	    $content_color = ($content_color) ? ' style="color: '.$content_color.'"' : '';
	    $btn_color = ($btn_color) ? ' style="color: '.$btn_color.'"' : '';
	    $screen_height = ($screen_height) ? $screen_height : '100vh';
		
		while($best_wp->have_posts()): $best_wp->the_post();
		   
		   $post_title  = "";
		   if($post_title !="No"){
		   		$post_title = get_the_title($best_wp->ID);
		   }
		   $post_content = "";
		   if($description !="No"){
		   		$post_content = get_the_excerpt();
		   }
		   $slide_content = "";
		   if($container_fluid !="No"){
		   		$slide_content = "content-full";
		   }
		   
		    if($title != 'No') {
		   		$post_title_show = get_the_title($best_wp->ID);
			}		
					
		    $post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
		    $post_url = get_post_permalink($best_wp->ID);

		    $btn_text = !empty($btn_text) ? $btn_text : "";
		    $slide_align = !empty($slide_align) ? $slide_align : "";

		    $taxonomy = "portfolio-category";
		    $cats_show = get_the_term_list( $best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
		    $portfolio_cats = "";
		    if($show_cats !="No"){
		   		$portfolio_cats = '<span class="category" data-color="'.$cats_color.'" data-hovercolor="'.$cats_hover_color.'" >'.$cats_show.'</span>';
		   	}
		   	if($height_fluid =="No"){
				$html .='<div class="slider-item" style="background-image: url('.$post_img_url.'); background-position:'.$background_position.';" data-height="'.$screen_height.'" data-mbgposition="'.$bg_position_mobile.'">					    
				    <div class="slide-content '.$slide_content.' '.$slide_align.' '.$css_class.'">
				    	'.$portfolio_cats.'
				        <h2 class="slide-title" '.$title_color.'>'.$post_title_show.'</h2>

				        <div class="slide-description">
				            <p '.$content_color.'>'.$post_content.'</p>
				        </div>';

				        if ( $post_url ) {
				    	    $html .='<div class="slider-button">
		    					        <ul>';

		    					        	$html .='<li><a href="'.$post_url.'" data-hover="'.$btn_hover_color.'" title="'.$btn_text.'" '.$btn_color.' class="portfolio-btn smoothPortfolio">'.$btn_text.'<i class="glyph-icon flaticon-right-arrow"></i></a></li>';

		    					        $html .='</ul>
		    					    </div>';
		        		}

				    $html .='</div>
				</div>';
			}else{
				$html .='<div class="slider-item" style="background-image: url('.$post_img_url.');background-position:'.$background_position.';" data-height="'.$screen_height.'" data-mbgposition="'.$bg_position_mobile.'">					    
				    <div class="slide-content full-screen '.$slide_content.' '.$slide_align.' '.$css_class.'">
				    	<div class="vertical-middle">
				    		<div class="vertical-middle-cell">
						    	'.$portfolio_cats.'
						        <h2 class="slide-title" '.$title_color.'>'.$post_title_show.'</h2>

						        <div class="slide-description">
						            <p '.$content_color.'>'.$post_content.'</p>
						        </div>';

						        if ( $post_url ) {
						    	    $html .='<div class="slider-button">
				    					        <ul>';

				    					        	$html .='<li><a href="'.$post_url.'" data-hover="'.$btn_hover_color.'" title="'.$btn_text.'" '.$btn_color.' class="portfolio-btn smoothPortfolio">'.$btn_text.'<i class="glyph-icon flaticon-right-arrow"></i></a></li>';

				    					        $html .='</ul>
				    					    </div>';
				        		}

				    $html .='</div></div></div>
				</div>';
			}
		
		endwhile; 
       	wp_reset_query();
		$html .='</div>
	</div>';
	return $html;
}
add_shortcode( 'vc_slider', 'vc_slider_html' );