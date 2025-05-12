<?php

    // Element Mapping
     function vc_countdown_mapping() {
         
    // Stop all if VC is not enabled
    if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
    }
    $event_id = '';
    $args = array(
        'post_type'           => 'cl_countdown',
        'posts_per_page'      => -1,
        'suppress_filters'    => false,
        'ignore_sticky_posts' => 1,
    );

    $posts_array = get_posts( $args );

    if( !empty( $posts_array ) ){

        foreach ( $posts_array as $post ) {
            $post_dropdown[$post->post_title] = $post->ID;                  
        }        
        $event_id      = $posts_array[0]->ID;
    }
    else {
        $post_dropdown = $event_id;
    }


    $fixture_id = '';
    $args2 = array(
        'post_type'           => 'fixture-results',
        'posts_per_page'      => -1,
        'suppress_filters'    => false,
        'ignore_sticky_posts' => 1,
        'meta_query' => array(
            array(
             'key' => 'total_goal',
             'compare' => 'NOT EXISTS'
            ),
        )
    );

    $posts_array2 = get_posts( $args2 );

    if( !empty( $posts_array2 ) ){

        foreach ( $posts_array2 as $post ) {
            $fixture_dropdown[$post->post_title] = $post->ID;                  
        }        
        $fixture_id      = $posts_array2[0]->ID;
    }
    else {
        $fixture_dropdown = $fixture_id;
    }

    // Map the block with vc_map()
    vc_map(
  
        array(
            'name'        => __('Rs Match Countdown', 'rsaddon'),
            'base'        => 'vc_countdown',
            'description' => __('Rs countdown for event', 'rsaddon'), 
            'category'    => __('by RS Theme', 'rsaddon'),   
            'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',      
            'params'      => array( 

                array(
                    "type" => "dropdown",
                    "heading" => __("Select Countdown Type", "rsaddon"),
                    "param_name" => "coundown_style",
                    "value" => array(
                        __("Slider", "rsaddon") => 'slider',                
                        __("Grid", "rsaddon") => 'grid',            
                    ),
                    'std' => 'slider',
                ),

                array(
                    "type" => "dropdown",
                    "heading" => __("Select Style", "rsaddon"),
                    "param_name" => "gird_style",
                    "value" => array(
                        __("Style 1", "rsaddon") => 'Style 1',                
                        __("Style 2", "rsaddon") => 'Style 2',            
                    ),
                    "dependency" => Array('element' => 'coundown_style', 'value' => array('grid')), 
                ),

                array(
                    "type"       => "dropdown_multi",
                    "holder"     => "div",
                    "class"      => "",
                    "heading"    => __( "Select An Event", 'rsaddon' ),
                    "param_name" => "event_title",
                    'value'      => $post_dropdown,
                    "dependency" => Array('element' => 'coundown_style', 'value' => array('slider')),  
                ),

                array(
                    "type"       => "dropdown_multi",
                    "holder"     => "div",
                    "class"      => "",
                    "heading"    => __( "Select An Upcoming Match", 'rsaddon' ),
                    "param_name" => "fixture_title",
                    'value'      => $fixture_dropdown,
                    "dependency" => Array('element' => 'coundown_style', 'value' => array('grid')),  
                ),
                
                array(
                    "type"       => "textfield",
                    "class"      => "",
                    "heading"    => __( "Event Custom Title", 'rsaddon' ),
                    "param_name" => "ev_custom_title",
                    'value'      => "", 
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("VS Text", "rsaddon"),
                    "param_name" => "vs_text",                      
                    'description' => __( 'You can add here VS text', 'rsaddon' ),                   
                ),

                 array(
                    "type" => "dropdown",
                    "heading" => __("Show Date/Time", "rsaddon"),
                    "param_name" => "show_datetime",
                    "value" => array(
                        __("Show", "rsaddon") => 'show',                
                        __("Hide", "rsaddon") => 'hide',            
                    ),
                    'std' => 'show',
                ),

                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Event Title Color", 'rsaddon' ),
                    "param_name"  => "ev_title_color",
                    "value"       => '',
                    "description" => __( "Choose title color", 'rsaddon' ),
                    'group'       => 'Event Styles',
                ),

                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Event Icon Color", 'rsaddon' ),
                    "param_name"  => "ev_meta_color",
                    "value"       => '',
                    "description" => __( "Choose Icon color", 'rsaddon' ),
                    'group'       => 'Event Styles',
                    ),   

                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Event Meta Text Color", 'rsaddon' ),
                    "param_name"  => "ev_meta_text_color",
                    "value"       => '',
                    "description" => __( "Choose Meta Text color", 'rsaddon' ),
                    'group'       => 'Event Styles',
                    ), 

                array(
                    "type"        => "colorpicker",
                    "class"       => "",
                    "heading"     => __( "Event Circle Bg Color", 'rsaddon' ),
                    "param_name"  => "ev_circle_bg_color",
                    "value"       => '',
                    "description" => __( "Choose Circle Bg color", 'rsaddon' ),
                    'group'       => 'Event Styles',  
                    ),

                
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Days Text", 'rsaddon' ),
                    "param_name"  => "days_text",
                    "value"       => 'Days',                   
                    'group'       => 'Days'                    
                ),
                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Hours Text", 'rsaddon' ),
                    "param_name"  => "hours_text",
                    "value"       => 'Hours',                   
                    'group'       => 'Hours'                    
                ),

               

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Minutes Text", 'rsaddon' ),
                    "param_name"  => "minutes_text",
                    "value"       => 'Minutes',                   
                    'group'       => 'Minutes'                    
                ),

                array(
                    "type"        => "textfield",
                    "class"       => "",
                    "heading"     => __( "Seconds Text", 'rsaddon' ),
                    "param_name"  => "seconds_text",
                    "value"       => 'Seconds',                   
                    'group'       => 'Seconds'                    
                ),

                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'rsaddon'),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon'                                                                    ),
                ),        
                     
            )
        )
    );                                
        
}

add_action( 'vc_before_init', 'vc_countdown_mapping' );

 
// Element HTML
function vc_countdown_html( $atts, $content ) {
     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'event_title'                   => '',
                'fixture_title'                 => '',
                'gird_style'                    => 'Style 1',
                'coundown_style'                => 'slider',
                'ev_custom_title'               => '',
                'ev_title_color'                => '',
                'ev_meta_color'                 => '',
                'ev_bg_num_color'               => '#fff',
                'ev_bg_num_color2'              => '#fff',
                'ev_bg_num_color3'              => '#fff',
                'ev_bg_num_color4'              => '#fff',
                'ev_days_text_color'            => '#fff',
                'ev_hours_text_color'           => '#fff',
                'ev_min_text_color'             => '#fff',
                'ev_sec_text_color'             => '#fff',
                'ev_days_num_color'             => '#fff',
                'ev_hours_num_color'            => '#fff',
                'ev_min_num_color'              => '#fff',
                'ev_sec_num_color'              => '#fff',
                'ev_meta_text_color'            => '',
                'ev_days_color'                 => '#fff',
                'ev_hours_color'                => '#fff',
                'ev_min_color'                  => '#fff',
                'ev_sec_color'                  => '#fff',
                'ev_circle_bg_color'            => '#fff',
                'book_btn_bg_color'             => '#fff',
                'book_btn_bg_hover_color'       => '#fff',
                'book_btn_text_color22'          => '#fff',
                'book_btn_text_hover_color'     => '#fff',
                'text_align'                    => 'center',
                'on_off_information'            => 'on',
                'on_off_countdown'              => 'on',
                'days_text'                     => 'Days',
                'hours_text'                    => 'Hours',
                'minutes_text'                  => 'Minutes',
                'seconds_text'                  => 'Seconds',
                'el_class'                      =>'',
                'vs_text'                       => 'VS',
                'show_datetime'                 => 'show',
            ), 
            $atts,'vc_counter'
        )
    );

    $event_localize_data = array(
        'ev_days_color'      => $ev_days_color, 
        'ev_hours_color'     => $ev_hours_color,
        'ev_min_color'       => $ev_min_color, 
        'ev_sec_color'       => $ev_sec_color, 
        'ev_circle_bg_color' => $ev_circle_bg_color, 
        'days_text'          => $days_text,
        'hours_text'         => $hours_text,
        'minutes_text'       => $minutes_text,
        'seconds_text'       => $seconds_text,
    );
    wp_localize_script( 'khelo-main', 'events_data', $event_localize_data );   

    //custom color added
    $title_color                   = ($ev_title_color) ? ' style="color: '.$ev_title_color.'"' : '';
    $ev_meta_color                 = ($ev_meta_color) ? ' style="color: '.$ev_meta_color.'"' : '';
    $ev_meta_text_color            = ($ev_meta_text_color) ? ' style="color: '.$ev_meta_text_color.'"' : '';
    $book_btn_bg_color             = ($book_btn_bg_color) ? $book_btn_bg_color : '#fff';
    $book_btn_bg_hover_color       = ($book_btn_bg_hover_color) ? $book_btn_bg_hover_color : '#fff';
    $book_btn_text_color22         = ($book_btn_text_color22) ? $book_btn_text_color22 : '#fff';
    $book_btn_text_hover_color     = ($book_btn_text_hover_color) ? $book_btn_text_hover_color : '#fff';
    
    $book_btn_bg                   = ($book_btn_bg_color) ? ' style="background: '.$book_btn_bg_color.'"' : '';
    
    //custom class added
    $wrapper_classes  = array($el_class) ;          
    $class_to_filter  = implode( ' ', array_filter( $wrapper_classes ) );       
    $css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );


if( $coundown_style == 'slider' ){

    //query
    $str_arr = explode (",", $event_title);

    $best_wp = new wp_Query(array(
        'post_type'      => 'cl_countdown',
        'post__in'       => $str_arr,
        'posts_per_page' =>-1,
    ));

    $html ='<div class="rs-countdown">
            <div class="sports-carousel">';
 
    while($best_wp->have_posts()): $best_wp->the_post();

    $event_title    = get_the_title();
    $event_date     = get_post_meta(get_the_ID(), 'ev_start_date', true);
    $event_end_date = get_post_meta(get_the_ID(), 'ev_end_date', true);
    $evt_location   = get_post_meta(get_the_ID(), 'ev_location', true);
    $event_time     = get_post_meta(get_the_ID(), 'ev_start_time', true);
    $select_date = get_post_meta(get_the_ID(),'match_start_date' ,true);
    $timeformat = date('Y-m-d H:i:s', $select_date );



    $item_img = get_the_post_thumbnail_url(get_the_ID(),'full');
    $item_bg = '';
    if(!empty($item_img)){
        $item_bg =  'style="background-image: url('.$item_img.')"';
    }
    //setlocale(LC_ALL, 'pt_BR');   
    $event_schedule = $event_date.' '.$event_time; //"2018-10-31 00:00:00";
        if(!empty($event_date) && !empty($event_end_date)){
            if($event_date!==$event_end_date){
                $day        = date("d",strtotime($event_date));
                //$end_day  = date("d F Y",strtotime($event_end_date));
                $day1       = date("d",strtotime($event_end_date));
                $month     = date("m",strtotime($event_end_date));
                $year      = date("Y",strtotime($event_end_date));
                $end_day    = strftime("%d %B %Y", mktime(0, 0, 0, $month, $day1, $year));
                $event_date = $day ."-". $end_day;
              
            }
        }
        
          if( 'on' !=  $on_off_information){
               $colfull = 'col-lg-12'; 
            } else{
               $colfull = 'col-lg-4 col-sm-12'; 
            }

             if( 'on' !=  $on_off_countdown ){            
               $colfull1 = 'col-lg-12'; 
            } else{
               $colfull1 = 'col-lg-8 col-sm-12'; 
            }
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

            $slider_btn = get_post_meta( get_the_ID(), 'slider_btn', true );
            $buttons = '';
            if(!empty($slider_btn)){
                foreach ( $slider_btn as $value ) { 
                    $btn_title = wp_kses_post($value['btn_title']);
                    $btn_link = wp_kses_post($value['btn_url']);
                    $buttons .= '<a href="'.$btn_link.'" class="btn1" data-animation="bounceIn" data-delay="1.5s" tabindex="0" style="animation-delay: 1.5s;">'.$btn_title.'</a>';
                }
            }


            $eventinfo = '';
              if( 'on' ==  $on_off_information ){ 
                    $eventinfo = '
                    <div class="banner-content text-'.$text_align.'">
                        <h1 class="slider-title" data-animation="bounceInDown" data-delay="0.5s">
                            <span '.$title_color.'>
                                '.$event_title_main.' 
                            </span>
                        </h1>                                              
                    </div>';
              }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '
                    <div class="banner-counter5">
                        <div class="timecounter-inner">
                            <div class="coming-soon-part2">
                                <div class="coming-soon-text">    
                                    <div data-animation="bounceInUp" data-delay="0.5s" style="animation-delay: 0.5s;" class="CountDownTimer3" data-date="'.$timeformat.'"> </div>
                                </div>                                                        
                            </div>
                        </div>
                    </div>';
                }

            $html .= '<div class="slide-content hero-slide event_counter6" '.$item_bg.'>
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           '.$eventinfo.'                                      
                                           '.$countdownschedule.'
                                           <div class="btn-slider">'.$buttons.'</div>                                                     
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
    endwhile;
    wp_reset_query();
    $html .='</div>
       </div>';
}else{

    //query
    $str_arr = explode (",", $fixture_title);

    $best_wp = new wp_Query(array(
        'post_type'      => 'fixture-results',
        'post__in'       => $str_arr,
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
             'key' => 'total_goal',
             'compare' => 'NOT EXISTS'
            ),
        )
    ));

    $versase = $vs_text;

    $html ='<div class="rs-countdown">
            <div class="sports-grid">';
 
    while($best_wp->have_posts()): $best_wp->the_post();

        $match_title       = get_the_title();
        $match_logo        = get_the_post_thumbnail($best_wp->ID);
        $team1             = get_post_meta( get_the_ID(), 'team1', true );
        $team2             = get_post_meta( get_the_ID(), 'team2', true );
        $date              = get_post_meta( get_the_ID(), 'match_date', true );
        $team_home         = get_post_meta( get_the_ID(), 'team_home', true );
        $match_date_normal = date('F d Y, H:i:s', $date );
        $match_date        = date_i18n('F d Y, H:i:s', $date );
        $fix_date          = date_i18n('F d, Y', $date );
        $fix_time          = date_i18n('H:i:s', $date );

        $match_date_test = date('F d Y', $date);

        $match_date_test = strtotime($match_date_test);

        $today_date = date('F d Y');

        $today_date = strtotime($today_date);

        
        if(!empty($team1)){
            $team_one_query = new WP_Query( array(
                'post_type' => 'club',
                'post_status' => 'publish',
                'p' => $team1,
            ));

            if ( $team_one_query->have_posts() ) :
                while ( $team_one_query->have_posts() ) :
                    $team_one_query->the_post();
                    $team_one  =  get_the_title();
                    $team_logo = get_the_post_thumbnail($best_wp->ID);   
                endwhile;
                wp_reset_query();
            endif;
        }

        if(!empty($team2)){
            $team_two_query = new WP_Query( array(
                'post_type' => 'club',
                'post_status' => 'publish',
                'p' => $team2,
            ));

            if ( $team_two_query->have_posts() ) :
                while ( $team_two_query->have_posts() ) :
                    $team_two_query->the_post();
                        $team_two =  get_the_title();
                        $team_logo2 = get_the_post_thumbnail($best_wp->ID);    
                endwhile;
                wp_reset_query();
            endif;
        }
        if(!empty($team_home)){
            $team_home_query = new WP_Query( array(
                'post_type' => 'club',
                'post_status' => 'publish',
                'p' => $team_home,
            ));

            if ( $team_home_query->have_posts() ) :
                while ( $team_home_query->have_posts() ) :
                    $team_home_query->the_post();                           
                        $vanue = get_post_meta( get_the_ID(), 'club_stadium', true );   
                endwhile;
                wp_reset_query();
            endif;
        }

        $item_img = get_the_post_thumbnail_url(get_the_ID(),'full');
        $item_bg = '';
        if(!empty($item_img)){
            $item_bg = 'style="background-image: url('.$item_img.')"';
        }
            
        if( 'on' !=  $on_off_information){
           $colfull = 'col-lg-12'; 
        } else{
           $colfull = 'col-lg-4 col-sm-12'; 
        }

         if( 'on' !=  $on_off_countdown ){            
           $colfull1 = 'col-lg-12'; 
        } else{
           $colfull1 = 'col-lg-8 col-sm-12'; 
        }
        $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

        $border = ($show_datetime == 'hide') ? 'no-border' : ''; 

        $slider_btn = get_post_meta( get_the_ID(), 'slider_btn', true );
        $buttons = '';
        if(!empty($slider_btn)){
            foreach ( $slider_btn as $value ) { 
                $btn_title = wp_kses_post($value['btn_title']);
                $btn_link = wp_kses_post($value['btn_url']);
                $buttons .= '<a href="'.$btn_link.'" class="btn1" data-animation="bounceIn" data-delay="1.5s" tabindex="0" style="animation-delay: 1.5s;">'.$btn_title.'</a>';
                }
            }


                $eventinfo = '';
                if( 'on' ==  $on_off_information ){ 
                    if(!empty($event_title_main)){
                        $eventinfo = '
                            <div class="banner-content text-'.$text_align.'">
                                <h3 class="slider-title" data-animation="bounceInDown" data-delay="0.5s">
                                    <span '.$title_color.'>
                                        '.$event_title_main.' 
                                    </span>
                                    <span class="lines-bg"></span>
                                </h3>                                              
                            </div>';
                    }  
                }

                 if ($today_date > $match_date_test) {
                    $countdownschedule = '<div class="row rs-vertical-middle event_counter3">
                                <div class="col-lg-12">
                                    <div class="coming-soon-part3 text-center">
                                        <div class="coming-soon-text" style="color:#fff; font-size:18px; padding-top:10px;">    
                                            Match Already Finished
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }else{
                      
                        if( 'on' ==  $on_off_countdown ){ 
                            $countdownschedule = '
                            <div class="row rs-vertical-middle event_counter3">
                                <div class="col-lg-12">
                                    <div class="coming-soon-part3 text-center">
                                        <div class="coming-soon-text">    
                                            <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer4" data-date="'.$match_date_normal.'"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    } 
                
                
                if( $gird_style == 'Style 2' ){

                $html .= '<div class="slide-content hero-slide event_counter6 event_counter6_grig2" '.$item_bg.'>
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 date-vanue">
                                    <span class="vanue '. $border.'" '.$ev_meta_text_color.'>'.$vanue.'</span>'
                                        ;

                                        if($show_datetime == 'show'){ 
                                            $html .= '
                                            <span class="date" '.$ev_meta_text_color.'>'.$fix_date.'</span>
                                            <span class="time" '.$ev_meta_text_color.'>'.$fix_time.'</span>';
                                       }

                                       
                                    $html .= '</div>
                                </div>
                                <div class="row teams-wrap">
                                    <div class="col-lg-4 col-sm-4 col-xs-12 team1">
                                        '.$team_logo.'
                                        <h4 class="team-title" '.$ev_meta_text_color.'>'.$team_one.'</h4>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12 versase">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <span class="vs">'.$versase.'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12 team2">
                                        '.$team_logo2.'
                                        <h4 class="team-title" '.$ev_meta_text_color.'>'.$team_two.'</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                       '.$eventinfo.'

                                       '.$countdownschedule.'                                                   
                                   </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>';

                }else{

                $html .= '<div class="slide-content hero-slide event_counter6" '.$item_bg.'>
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                       '.$eventinfo.'

                                       '.$countdownschedule.'                                                   
                                   </div>
                                </div>
                                <div class="row teams-wrap">
                                    <div class="col-lg-4 col-sm-4 col-xs-12 team1">
                                        '.$team_logo.'
                                        <h4 class="team-title" '.$ev_meta_text_color.'>'.$team_one.'</h4>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12 versase">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <span class="vs">'.$versase.'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12 team2">
                                        '.$team_logo2.'
                                        <h4 class="team-title" '.$ev_meta_text_color.'>'.$team_two.'</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 date-vanue">
                                    <span class="vanue '. $border.'" '.$ev_meta_text_color.'>'.$vanue.'</span>'
                                        ;

                                        if($show_datetime == 'show'){ 
                                            $html .= '
                                            <span class="date" '.$ev_meta_text_color.'>'.$fix_date.'</span>
                                            <span class="time" '.$ev_meta_text_color.'>'.$fix_time.'</span>';
                                       }

                                       
                                    $html .= '</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

                }
        endwhile;
        wp_reset_query();
        $html .='</div>
           </div>';
    }
return $html;
}
add_shortcode( 'vc_countdown', 'vc_countdown_html' );