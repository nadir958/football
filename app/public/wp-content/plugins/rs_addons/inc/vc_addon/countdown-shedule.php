<?php

	// Element Mapping
	 function vc_countdown_mapping() {
         
    // Stop all if VC is not enabled
    if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
    }
    $event_id = '';
    $args = array(
        'post_type'           => 'cl_team',
        'posts_per_page'      => -1,
        'suppress_filters'    => false,
        'ignore_sticky_posts' => 1,
    );

    $posts_array = get_posts( $args );

    if( !empty( $posts_array ) ){

        foreach ( $posts_array as $post ) {
            $post_dropdown[$post->post_title] = $post->ID;                  
        }        
        $countdown_id      = $posts_array[0]->ID;
    }
    else {
        $post_dropdown = $countdown_id;
    }

    // Map the block with vc_map()
    vc_map(
  
        array(
            'name'        => __('RS Countdown', 'eventsia'),
            'base'        => 'vc_countdown',
            'description' => __('Rs countdown', 'eventsia'), 
            'category'    => __('by RS Theme', 'eventsia'),   
            'icon'        => get_template_directory_uri().'/framework/assets/img/vc-icon.png',      
            'params'      => array(			

                array(
                    "type"       => "dropdown",
                    "holder"     => "div",
                    "class"      => "",
                    "heading"    => __( "Select An Countdown", 'rsaddon' ),
                    "param_name" => "countdown_title",
                    'value'      => $post_dropdown,
                ),
                
                array(
                    "type" => "dropdown",
                    "heading" => __("Select Countdown Style", 'rsaddon'),
                    "param_name" => "countdown_style",
                    "value" => array(                           
                        'Style 1' => "Style 1",                     
                        'Style 2' => "Style 2", 
                        'Style 3' => "Style 3", 
                        'Style 4' => "Style 4", 
                        'Style 5' => "Style 5", 
                        'Style 6' => "Style 6", 
                    ),                      
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
                'el_class'                      =>'',
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
	$ev_title_color                = ($ev_title_color) ? ' style="color: '.$ev_title_color.'"' : '';
	$ev_meta_color                 = ($ev_meta_color) ? ' style="color: '.$ev_meta_color.'"' : '';
	$ev_meta_text_color            = ($ev_meta_text_color) ? ' style="color: '.$ev_meta_text_color.'"' : '';
	$book_btn_bg_color             = ($book_btn_bg_color) ? $book_btn_bg_color : '#fff';
	$book_btn_bg_hover_color       = ($book_btn_bg_hover_color) ? $book_btn_bg_hover_color : '#d90845';
	$book_btn_text_color22         = ($book_btn_text_color22) ? $book_btn_text_color22 : '#d90845';
	$book_btn_text_hover_color     = ($book_btn_text_hover_color) ? $book_btn_text_hover_color : '#fff';
	
	$book_btn_bg                   = ($book_btn_bg_color) ? ' style="background: '.$book_btn_bg_color.'"' : '';
	$schedule_btn_bg_color         = ($schedule_btn_bg_color) ? $schedule_btn_bg_color : '#fff';
	$schedule_btn_text_color       = ($schedule_btn_bg_color2) ? $schedule_btn_bg_color2 : '';
	$schedule_btn_hover_bg_color   = ($schedule_btn_bg_hover_color) ? $schedule_btn_bg_hover_color : '';
	$schedule_btn_hover_text_color = ($schedule_btn_hover_text_color) ? $schedule_btn_hover_text_color : '';
	
    //custom class added
	$wrapper_classes  = array($el_class) ;			
	$class_to_filter  = implode( ' ', array_filter( $wrapper_classes ) );		
	$css_class_custom = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $atts );

    //query
    $best_wp = new wp_Query(array(
        'post_type' => 'events',
        'post__in' => array($event_title),
    ));


    while($best_wp->have_posts()): $best_wp->the_post();

	$event_title    = get_the_title();
	$event_date     = get_post_meta(get_the_ID(), 'ev_start_date', true);
	$event_end_date = get_post_meta(get_the_ID(), 'ev_end_date', true);
	$evt_location   = get_post_meta(get_the_ID(), 'ev_location', true);
	$event_time     = get_post_meta(get_the_ID(), 'ev_start_time', true);
    //setlocale(LC_ALL, 'pt_BR');   
	$event_schedule = $event_date.' '.$event_time; //"2018-10-31 00:00:00";
	$book_btn_link  = (!empty($book_btn_title)) ? '<a class="readon readon1" href="'.esc_url($book_btn_url).'">'.$book_btn_title.'</a>' : '';
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
        $schedule_btn_url = (!empty($schedule_btn_title)) ? '<a class="readon white readon3" href="'.esc_url($schedule_btn_url).'">'.$schedule_btn_title.'</a>' : '';
        
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
            

        if($event_style == 'Style 1')
        {
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

            $eventinfo = '';
                if( 'on' ==  $on_off_information ){ 
                   
                    $eventinfo = '
                    <div class="'.$colfull1.'">
                        <div class="event_information">
                            <div class="date-meta" '.$ev_meta_text_color.'>
                                <i class="fa fa-calendar"></i>'.$event_date.'
                            </div>
                            <h1 class="slider-title">'.$event_title_main.'</h1>
                            <div class="location-meta" '.$ev_meta_text_color.'>
                                <i class="icofont icofont-social-google-map"></i>'.$evt_location.'
                            </div>
                            <p class="event_button">'.$book_btn_link.' '.$schedule_btn_url.'</p>
                        </div>
                    </div>
                    ';
                }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '
                    <div class="'.$colfull.'">
                        <div class="coming-soon-part1 text-center">
                            <div class="coming-soon-text">    
                                <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer" data-date="'.$event_schedule.'"></div>
                            </div>
                        </div>
                    </div>';
                }

            $html = '<div class="row rs-vertical-middle event_counter1">                        
                        '.$countdownschedule.'                        
                        '.$eventinfo.'                      
                    </div>';

                    $html .='
                        <style>
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }              
                       
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }

                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            .event_counter1 .readon2{
                                color:'.$schedule_btn_text_color.' !important;
                            }
                            .event_counter1 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }

                             .event_counter1 .readon3{
                                color:'.$book_btn_text_color22.' !important;
                            }

                            .event_counter1 .readon3:hover{
                                background:'.$book_btn_bg_hover_color.' !important;
                            }
                            .event_counter1 .readon3:hover{
                                color:'.$book_btn_text_hover_color.' !important;
                            }
                            
                        </style>
                    ';
             
            return $html;
        }

        if($event_style == 'Style 2')
        {    
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;
            $eventinfo = '';
              if( 'on' ==  $on_off_information ){ 
                    $eventinfo = '
                    <div class="banner-content text-'.$text_align.'">
                        <h1 class="slider-title" data-animation-in="fadeInLeft" data-animation-out="animate-out">
                            <span '.$ev_title_color.'>
                                '.$event_title_main.' 
                            </span>
                        </h1>                                              
                        <div data-animation-in="fadeInUp" data-animation-out="animate-out" class="slider-desc">
                            <i class="icofont icofont-social-google-map" '.$ev_meta_color.'></i>
                            <i '.$ev_meta_text_color.'>'.$evt_location.'</i>
                        </div>
                        <div class="date-meta">
                            <span><i class="fa fa-calendar" aria-hidden="true" '.$ev_meta_color.'></i> <i '.$ev_meta_text_color.'>'.$event_date.'</i></span>
                        </div>
                        <p class="buttons">'.$book_btn_link.' '.$schedule_btn_url.'</p>
                    </div>';
              }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '
                    <div class="banner-counter5">
                        <div class="timecounter-inner">
                            <div class="coming-soon-part2">
                                <div class="coming-soon-text">    
                                    <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer3" data-date="'.$event_schedule.'"> </div>
                                </div>                                                        
                            </div>
                        </div>
                    </div>';
                }

            $html = '<div class="slide-content event_counter2">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           '.$countdownschedule.'                                                         
                                           '.$eventinfo.'                                      
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    $html .='
                        <style>
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }       
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter2 .buttons .readon1{
                                background: '.$book_btn_bg_color.' !important;
                                color: '.$book_btn_text_color22.' !important;
                            }
                            .event_counter2 .buttons .readon1:hover{
                                background: '.$book_btn_bg_hover_color.' !important;
                                color: '.$book_btn_text_hover_color.' !important;
                            }
                            .event_counter2 .buttons .readon3{
                                background: '.$schedule_btn_bg_color.' !important;
                                color: '.$schedule_btn_text_color.' !important;
                            }
                            .event_counter2 .buttons .readon3:hover{
                                background: '.$schedule_btn_hover_bg_color.' !important;
                                color: '.$schedule_btn_hover_text_color.' !important;
                            }
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }


                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter2 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            
                            .event_counter2 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }
                            
                        </style>';

             
            return $html;
        }

        if($event_style == 'Style 3')
        {
            if( !empty($book_btn_link) && !empty($schedule_btn_url) ){
                $countdown_btn = '<div class="col-lg-3">
                                       <div class="btncounter3"> <p>'.$book_btn_link.' '.$schedule_btn_url.'</p></div>
                                </div>';
                $col_num = 9;
            }
            else{
                $col_num = 12;
                $countdown_btn = '';
            }

            $html = '<div class="row rs-vertical-middle event_counter3">
                        <div class="col-lg-'.$col_num.'">
                            <div class="coming-soon-part3 text-center">
                                <div class="coming-soon-text">    
                                    <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer4" data-date="'.$event_schedule.'"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    '.$countdown_btn.' ';
                    $html .='
                        <style>
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }       
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }


                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter3 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            .btncounter3 .readon{
                                color:'.$schedule_btn_text_color.' !important;
                            }
                            .btncounter3 .readon:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }
                            
                        </style>
                    ';
             
            return $html;
        }

        if($event_style == 'Style 4')
        {
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

            $eventinfo = '';
                if( 'on' ==  $on_off_information ){ 
                   
                    $eventinfo = '<h1 class="slider-title">'.$event_title_main.'</h1>';
                }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '<div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer4" data-date="'.$event_schedule.'"></div>';
                }

            $html = '<div class="row rs-vertical-middle event_counter4 text-'.$text_align.'">
                        <div class="col-lg-12">
                            <div class="coming-soon-part3 text-center">
                                <div class="coming-soon-text"> 
                                    '.$eventinfo.'  
                                    '.$countdownschedule.'
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="btncounter3"> <p>'.$book_btn_link.' '.$schedule_btn_url.'</p></div>
                        </div>
                    </div>';
                    $html .='
                        <style>
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }       
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }


                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            .btncounter3 .readon2{
                                color:'.$schedule_btn_text_color.' !important;
                            }
                            .btncounter3 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }


                            .event_counter4 .readon3{
                                color:'.$book_btn_text_color22.' !important;
                            }

                            .event_counter4 .readon3:hover{
                                background:'.$book_btn_bg_hover_color.' !important;
                            }
                            .event_counter4 .readon3:hover{
                                color:'.$book_btn_text_hover_color.' !important;
                            }
                            .event_counter4 .time_circles div span{
                                background:'.$ev_bg_num_color.' !important;
                                padding: 21px 17px;
                                display: inline-block;
                                margin-bottom: 16px;
                            }
                            .event_counter4 .time_circles div.textDiv_Days span{
                                background:'.$ev_bg_num_color.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Hours span{
                                background:'.$ev_bg_num_color2.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Minutes span{
                                background:'.$ev_bg_num_color3.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Seconds span{
                                background:'.$ev_bg_num_color4.' !important;
                            }
                            
                        </style>';
             
            return $html;
        }

        if($event_style == 'Style 5')
        {
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

            $eventinfo = '';
                if( 'on' ==  $on_off_information ){ 
                   
                    $eventinfo = '<h1 class="slider-title">'.$event_title_main.'</h1>';
                }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '<div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer4" data-date="'.$event_schedule.'"></div>';
                }

            $html = '<div class="row rs-vertical-middle event_counter4 text-'.$text_align.'">
                        <div class="col-lg-12">
                            <div class="coming-soon-part3 text-center">
                                <div class="coming-soon-text"> 
                                    '.$countdownschedule.'
                                    '.$eventinfo.'  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="btncounter3"> <p>'.$book_btn_link.' '.$schedule_btn_url.'</p></div>
                        </div>
                    </div>';
                    $html .='
                        <style>
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }       
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }


                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter4 .coming-soon-part3 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            .btncounter3 .readon2{
                                color:'.$schedule_btn_text_color.' !important;
                            }
                            .btncounter3 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }


                            .event_counter4 .readon3{
                                color:'.$book_btn_text_color22.' !important;
                            }

                            .event_counter4 .readon3:hover{
                                background:'.$book_btn_bg_hover_color.' !important;
                            }
                            .event_counter4 .readon3:hover{
                                color:'.$book_btn_text_hover_color.' !important;
                            }
                            .event_counter4 .time_circles div span{
                                background:'.$ev_bg_num_color.' !important;
                                padding: 21px 17px;
                                display: inline-block;
                                margin-bottom: 16px;
                            }
                            .event_counter4 .time_circles div.textDiv_Days span{
                                background:'.$ev_bg_num_color.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Hours span{
                                background:'.$ev_bg_num_color2.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Minutes span{
                                background:'.$ev_bg_num_color3.' !important;
                            }
                            .event_counter4 .time_circles div.textDiv_Seconds span{
                                background:'.$ev_bg_num_color4.' !important;
                            }
                            
                        </style>';
             
            return $html;
        }
        if($event_style == 'Style 6')
        {    
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;
            $eventinfo = '';
              if( 'on' ==  $on_off_information ){ 
                    $eventinfo = '
                    <div class="banner-content text-'.$text_align.'">
                        <h1 class="slider-title" data-animation-in="fadeInLeft" data-animation-out="animate-out">
                            <span '.$ev_title_color.'>
                                '.$event_title_main.' 
                            </span>
                        </h1>                                              
                        <div data-animation-in="fadeInUp" data-animation-out="animate-out" class="slider-desc">
                            <i class="icofont icofont-social-google-map" '.$ev_meta_color.'></i>
                            <i '.$ev_meta_text_color.'>'.$evt_location.'</i>
                        </div>
                        <div class="date-meta">
                            <span><i class="fa fa-calendar" aria-hidden="true" '.$ev_meta_color.'></i> <i '.$ev_meta_text_color.'>'.$event_date.'</i></span>
                        </div>
                        <p class="buttons">'.$book_btn_link.' '.$schedule_btn_url.'</p>
                    </div>';
              }

            $countdownschedule = '';
                if( 'on' ==  $on_off_countdown ){ 
                    $countdownschedule = '
                    <div class="banner-counter5">
                        <div class="timecounter-inner">
                            <div class="coming-soon-part2">
                                <div class="coming-soon-text">    
                                    <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer3" data-date="'.$event_schedule.'"> </div>
                                </div>                                                        
                            </div>
                        </div>
                    </div>';
                }

            $html = '<div class="slide-content event_counter6">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           '.$countdownschedule.'                                                         
                                           '.$eventinfo.'                                      
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    $html .='
                        <style>
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }       
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }


                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                            
                            .event_counter6 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }
                            
                        </style>';
             
            return $html;
        }
        else {
            $event_title_main = (!empty($ev_custom_title)) ? $ev_custom_title : $event_title;

            $html = '<div class="row rs-vertical-middle">
                        <div class="col-lg-4">
                            <div class="coming-soon-part1 text-center">
                                <div class="coming-soon-text">    
                                    <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="CountDownTimer" data-date="'.$event_schedule.'"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                             <h1 class="slider-title">'.$event_title_main.'</h1>
                            <p>'.$book_btn_link.' '.$schedule_btn_url.'</p>
                        </div>
                    </div>';
                     $html .='
                        <style>
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Days span{
                                color:'.$ev_days_text_color.' !important;
                            }              
                       
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Hours span{
                                color:'.$ev_hours_text_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Minutes span{
                                color:'.$ev_min_text_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Seconds span{
                                color:'.$ev_sec_text_color.' !important;
                            }

                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Days h4{
                                color:'.$ev_days_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Hours h4{
                                color:'.$ev_hours_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Minutes h4{
                                color:'.$ev_min_num_color.' !important;
                            }
                            .event_counter1 .coming-soon-part1 .coming-soon-text .time_circles div.textDiv_Seconds h4{
                                color:'.$ev_sec_num_color.' !important;
                            }
                             .event_counter1 .readon2{
                                color:'.$schedule_btn_text_color.' !important;
                            }
                            .event_counter1 .readon2:hover{
                                background:'.$schedule_btn_bg_hover_color.' !important;
                                color:'.$schedule_btn_hover_text_color.' !important;
                            }

                            .event_counter1 .readon3{
                                color:'.$book_btn_text_color22.' !important;
                            }

                            .event_counter1 .readon3:hover{
                                background:'.$book_btn_bg_hover_color.' !important;
                            }
                            .event_counter1 .readon3:hover{
                                color:'.$book_btn_text_hover_color.' !important;
                            }
                            
                        </style>
                    ';
             
            return $html;
        }
    endwhile;
     
}
add_shortcode( 'vc_countdown', 'vc_countdown_html' );