<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $khelo_option;

function cmb2_output_file_list( $file_list_meta_key, $img_size = 'medium' ) {
    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
    echo '<div class="file-list-wrap row rs-galleys ">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
        echo '<div class="col-md-3"><div class="file-list-image galley-img">';
        echo wp_get_attachment_image( $attachment_id, $img_size );
        echo '<a class="image-popup zoom-icon" href="'.$attachment_url.'"><i class="glyph-icon flaticon-add-circular-button"></i></a>';
        echo '</div></div>';
    }
    echo '</div>';
}   
?>
<div class="container">
<?php          
    //featured area  
    $fixture_club = new wp_Query(array(
            'post_type'      => 'fixture-results',
            'posts_per_page' => -1, 
            'orderby' => 'meta_value',
            'meta_key' => 'match_date',
            'order' => 'ASC',               
            'meta_query'     => array(                                                     
                array(
                    'key'            => 'total_goal',
                    'compare'        => 'NOT EXISTS'
                ),
            array(
                'relation' => 'OR',
                array(
                    'key'     => 'team1',
                    'value'   => get_the_ID(),
                    'compare' => '=',
                    
                ),
                array(
                    'key'     => 'team2',
                    'value'   => get_the_ID(),
                    'compare' => '=',
                    
                ),
            )    
        )
    ));                

    if ($fixture_club->have_posts()){   
    ?>
        <div class="match-slider-styles match-list upcoming-carousel owl-carousel">
            <?php                
                while($fixture_club->have_posts()): $fixture_club->the_post();
                $match_title = get_the_title();
                $team1       = get_post_meta( get_the_ID(), 'team1', true );
                $team2       = get_post_meta( get_the_ID(), 'team2', true );
                $date        = get_post_meta( get_the_ID(), 'match_date', true );
                $team_home   = get_post_meta( get_the_ID(), 'team_home', true );
                $match_date  = date('F d Y', $date );
                $match_time  = date('H:i', $date );

                if(!empty($team1)){
                    $team_one_query   = new WP_Query( array(
                        'post_type'   => 'club',
                        'post_status' => 'publish',
                        'p'           => $team1,                        
                    ));

                    if ( $team_one_query->have_posts() ) :
                        while ( $team_one_query->have_posts() ) :
                            $team_one_query->the_post();
                            $team_one =  get_the_title();
                            $team_logo = get_the_post_thumbnail($team_one_query->ID);   
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
                            $team_two   =  get_the_title();
                            $team_logo2 = get_the_post_thumbnail($team_two_query->ID);    
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
                ?>
                <div class="fixture-item">            
                    <div class="mid-sec">
                        <div class="medium-font">
                            <?php echo wp_kses_post($team_logo); ?>
                            <?php echo esc_html($team_one);?>
                        </div>
                        <div class="big-font">
                            <div class="top-date-sec">  
                                <span class="match-date"><?php echo esc_html($match_date); ?></span>
                                <span class="match-time"><?php echo esc_html($match_time); ?></span>
                            </div>
                            <span class="versase"><?php echo esc_html__('VS', 'khelo');?></span>
                        </div>

                        <div class="medium-font">
                           <?php echo wp_kses_post($team_logo2); ?>
                            <?php echo esc_html($team_two);?>
                        </div>
                    </div>

                    <div class="match-venue">
                        <span ><span class="venue-text"><?php echo esc_html__('Venue', 'khelo');?>:</span> <?php echo esc_html($vanue);?></span>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    <?php 
    }             
?>  
<div class="clear-fix"></div>
</div>  

<div class="container"> 
    <div id="content">   
      <!-- Blog Detail Start -->
        <div class="rs-club-details pt-70 pb-70">               
            <?php
                while ( have_posts() ) : the_post();
            ?>     
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="club-sidebar-top">
                                <div class="club-logo">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <div class="club-sidebar">
                                <div class="club-details">
                                    <?php $club_exta = get_post_meta( get_the_ID(), 'club_exta', true );
                                        if(!empty($club_exta)){ ?>
                                            <ul class="spsoccer-team-info-list spsoccer-ul-list">
                                                <?php foreach ( $club_exta as $value ) { ?>    
                                                <li>
                                                    <strong><?php echo wp_kses_post($value['info_title']); ?></strong>
                                                    <span><?php echo wp_kses_post($value['info_value']); ?></span>
                                                </li>
                                               <?php } ?>                                               
                                            </ul>
                                     <?php }?>
                                </div>
                            </div>
                            <div class="rs-count row">
                                <?php $club_exta_statistic = get_post_meta( get_the_ID(), 'club_exta_statistic', true );
                                    if(!empty($club_exta_statistic)){ ?>                                        
                                        <?php foreach ( $club_exta_statistic as $value ) { ?>  
                                            <div class="col-lg-3 col-md-3 col-sm-6">
                                                <!-- COUNTER-LIST START -->  
                                                <div class="rs-counter-list">
                                                    <h2 class="rs-counter percent"><?php echo wp_kses_post($value['info_value']); ?></h2>
                                                    <h3><?php echo wp_kses_post($value['info_title']); ?></h3>
                                                </div>
                                                <!-- COUNTER-LIST END --> 
                                            </div>
                                        <?php } ?>                                      
                                        
                                <?php }?>                                                                

                            </div> 
                                                               
                        </div>
                            
                    </div>
                    <div class="clear-fix"></div>                 
                    <?php 
                        $club_champion = get_post_meta( get_the_ID(), 'club_champion', true ); 
                        $club_jersy = get_post_meta( get_the_ID(), 'club_jersy', true );
                        if(!empty($khelo_option['show_club_tab'])) {
                    ?>

                    <div class="club-details_data">
                        <ul class="nav nav-tabs">
                            <?php if(get_the_content()) { ?>
                                <li class="nav-item">
                                  <a class="nav-link" data-toggle="tab" href="#club-history"><?php 
                                  $club_history = !empty($khelo_option['club_history_text']) ? $khelo_option['club_history_text']: esc_html__('Club History', 'khelo');
                                   echo esc_html($club_history);
                                  ?>
                                 </a>
                                </li>
                            <?php } ?>    


                             <?php 
                                $args = array(
                                'post_type' => 'players',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'present_club',
                                        'value'   => get_the_ID(),
                                        'compare' => 'IN',
                                    ),
                                ),   
                            );

                            $que = new WP_Query( $args );

                            if ( $que->have_posts() ) { ?>
                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#squad-list"><?php 
                                      $players_text = !empty($khelo_option['players_text']) ? $khelo_option['players_text']: esc_html__('Players', 'khelo');
                                       echo esc_html($players_text);
                                      ?>
                                     </a> 
                                 
                                </li>
                            <?php } ?>

                            <?php if( !empty($club_champion)) { ?>

                                <li class="nav-link">
                                    <a data-toggle="tab" href="#champion">
                                        <?php 
                                              $champion_text = !empty($khelo_option['champion_text']) ? $khelo_option['champion_text']: esc_html__('Champion', 'khelo');
                                               echo esc_html( $champion_text );
                                        ?>

                                    </a>
                                </li><?php }?>

                            <?php $gallery_data = get_post_meta(get_the_ID(), 'gallery_club_images', true); 
                            if(!empty($gallery_data)){ ?>

                            <li class="nav-link">
                                <a data-toggle="tab" href="#gallery">
                                <?php 
                                    $gallery_text = !empty($khelo_option['gallery_text']) ? $khelo_option['gallery_text']: esc_html__('Gallery', 'khelo');
                                     echo esc_html( $gallery_text );
                                ?>                                    
                                </a>
                            </li>
                        <?php } ?>

                           <?php if(!empty($club_jersy)){ ?>
                                 <li class="nav-link">
                                    <a data-toggle="tab" href="#jersy">

                                        <?php $jersey_text = !empty($khelo_option['jersey_text']) ? $khelo_option['jersey_text']: esc_html__('Jersey', 'khelo');
                                     echo esc_html( $jersey_text );?>                                     

                                    </a>
                                </li>
                             <?php } ?>


                             <!-- extra custom tab title -->

                              <?php $club_extatab = get_post_meta( get_the_ID(), 'club_extatab', true );

                                    if(!empty($club_extatab)){ $x= 0; ?>                                        
                                        <?php foreach ( $club_extatab as $value ) { 
                                            $x++;
                                        ?> 
                                        <li class="nav-link">
                                            <a data-toggle="tab" href="#custom<?php echo esc_html($x);?>"><?php echo esc_html($value['tab_tile']);?></a>
                                         </li>
                                            
                                        <?php } ?>                                      
                                        
                                <?php }?>  


                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php if(get_the_content()): ?>
                            <div id="club-history" class="club-content tab-pane">                   
                                <?php
                                    the_content();         
                                ?>
                            </div>
                            <?php endif;

                                $args = array(
                                'post_type' => 'players',
                                'posts_per_page' => -1,  
                                'meta_key'   => 'squad_number',
                                'orderby'    => 'meta_value_num',
                                'order'      => 'ASC', 
                                'meta_query' => array(
                                    array(
                                        'key'     => 'present_club',
                                        'value'   => get_the_ID(),
                                        'compare' => 'IN',
                                    ),
                                ),   
                            );

                            $que = new WP_Query( $args );

                            if ( $que->have_posts() ) { ?>
                                <div id="squad-list" class=" tab-pane">                                
                                    <div class="squad-list">
                                        <div class="row">

                                            <?php 

                                                while ( $que->have_posts() ) : $que->the_post();
                                                    $palyer_position = get_post_meta(get_the_ID(), 'player_position', 'true');
                                                    $palyer_jersy = get_post_meta(get_the_ID(), 'squad_number', 'true');
                                                ?>
                                                    <div class="col-md-3 col-sm-6 col-xs-6 mb-30">
                                                        <div class="squad-list-item">
                                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($que->ID);?></a>
                                                            <span class="name"> <a href="<?php the_permalink(); ?>"><?php echo  get_the_title($que->ID);?></a></span>
                                                            <span class="position"><?php echo esc_html($palyer_position);?></span>
                                                            <span class="jersy"><?php echo esc_html($palyer_jersy);?></span>
                                                        </div>
                                                    </div>  
                                                    
                                                <?php
                                                endwhile;
                                                wp_reset_query();                                                                         
                                            ?>          
                                       
                                                                             
                                        </div>
                                        <!--Squad Style End -->
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- End Squad list -->

                            <?php
                            $club_champion = get_post_meta( get_the_ID(), 'club_champion', true );
                            $total_club = !empty($club_champion) ? count($club_champion): '';
                            if($total_club > 0){?>
                                <div id="champion" class="tab-pane fade">
                                    <div class="champion-inner">
                                        <div class="row">                       
                                                                                 
                                            <?php 
                                            $club_champion = get_post_meta( get_the_ID(), 'club_champion', true );
                                            foreach ( $club_champion as $value ) { 
                                            $houner_image =  $value['houner_image']
                                            ?>
                                                <div class="col-md-3 col-sm-6 col-xs-6 mb-30">
                                                    <div class="award-wrap">
                                                        <div class="champion-logo">
                                                            <img src="<?php echo esc_url( $houner_image);?>" alt="<?php the_title_attribute();?>" />
                                                        </div>
                                                        <div class="champion-details">                                              
                                                            <div class="year-details">
                                                                <h3><?php echo wp_kses_post($value['league_title']);  ?></h3>
                                                                <span><?php echo wp_kses_post($value['year_list']);  ?></span>
                                                            </div>
                                                            <div class="champion-no">
                                                               <?php echo wp_kses_post($value['champion_number']);  ?>
                                                            </div>                                                        
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                             <?php } ?>                           
                                                                                  
                                            </div>                                        
                                        </div> 
                                </div>
                            <?php } ?>
                            <!-- End Champion Seciton -->
                            <div id="gallery" class="tab-pane fade">
                                <?php cmb2_output_file_list( 'gallery_club_images', 'small' ); ?>                                
                            </div>                           
                            <!-- End gallery -->
                            <?php if(!empty($club_jersy)){ ?>  
                                <div id="jersy" class="tab-pane fade">                                
                                    <div class="champion-inner">
                                        <div class="row">
                                            <?php                                                                                  
                                            foreach ( $club_jersy as $value ) { 
                                            $jersy_image =  !empty($value['jersy_image']) ? $value['jersy_image'] : '';
                                            ?>
                                                <div class="col-md-4 col-sm-6 col-xs-6 mb-30">
                                                    <?php if($jersy_image):?>
                                                        <div class="champion-logo">
                                                           <img src="<?php echo esc_url( $jersy_image);?>" alt="<?php the_title_attribute();?>" />
                                                        </div>
                                                    <?php endif;?>
                                                    <div class="champion-details">                                                        
                                                        <div class="year-details">
                                                            <h3><?php echo wp_kses_post($value['jersy_type']);  ?></h3>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                             <?php } ?>                                      
                                                                

                                                                                      
                                            </div>
                                            
                                        </div>                               
                                    
                                </div>
                            <?php } ?>

                            <!--custom tab content start here -->
                                <?php if(!empty($club_extatab)){ 
                                    $x = 0; 
                                    foreach ( $club_extatab as $value ) { 
                                        $x++; ?>  
                                        <div id="custom<?php echo esc_html( $x );?>" class="tab-pane fade">                       
                                            <div class="champion-inner">
                                                <div class="row">                                               
                                                    <div class="col-md-12  mb-30">
                                                        <?php echo wp_kses_post($value['tab_content']);?>                                    
                                                    </div>                                                                     
                                                </div>                                               
                                            </div>
                                        </div>
                                    <?php } 
                                } ?>
                            <!-- end custom tab section -->
                            <!-- End Jersy -->
                        </div>
                    </div>  

                    <!--end tab section -->
                <?php } else{
                    echo '<div class="club-details_data">';
                            the_content();
                    echo '</div>';
                } ?>


                    <div class="clear-fix"></div>  
                    <div class="rs-blog-grid rs-blog">
                        <?php $club_videos = get_post_meta( get_the_ID(), 'club_videos', true );
                            if( !empty($club_videos)){
                        ?>
                        <div class="rs-heading style2   ">
                            <div class="title-inner ">
                                            
                                
                                <h2 class="title title-upper"><?php  $club_video_text = !empty($khelo_option['club_video_text']) ? $khelo_option['club_video_text']: esc_html__('Club Videos', 'khelo');
                                     echo esc_html( $club_video_text ); ?></h2> <span class="lines-bg"></span>
                                <div class="title-img bottom-img"></div>
                            </div>
                        </div>
                        
                            <div class="row">
                                <?php   function getYouTubeVideoId($pageVideUrl) {
                                        $link = $pageVideUrl;
                                        $video_id = explode("?v=", $link);
                                        if (!isset($video_id[1])) {
                                            $video_id = explode("youtu.be/", $link);
                                        }
                                        $youtubeID = $video_id[1];
                                        if (empty($video_id[1])) $video_id = explode("/v/", $link);
                                        $video_id = explode("&", $video_id[1]);
                                        $youtubeVideoID = $video_id[0];
                                        if ($youtubeVideoID) {
                                            return $youtubeVideoID;
                                        } else {
                                            return false;
                                        }
                                    }
                                    foreach ( $club_videos as $value ) { 
                                     $youtubeID = getYouTubeVideoId($value['video_link']);
                                     $thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
                                        ?>
                                        <div class="blog-item col-lg-4 col-md-12 style2 ">
                                            <div class="thumimg media-video-icon">
                                                <a class="popup-videos" href="<?php echo esc_url($value['video_link']); ?>">
                                                    <img src="<?php echo esc_url($thumbURL); ?>" alt="<?php echo esc_url($thumbURL); ?>" />
                                                    <span><i class="fa fa-play" aria-hidden="true"></i></span>
                                                </a>
                                            </div> 
                                        </div>                                          
                                
                               <?php } ?>                                     
                            </div>
                        <?php }?>
                    </div>                  
                </article> 
          <?php               
            endwhile;  
            wp_reset_query();           
            ?>  
             <div class="clear-fix"></div>
             <?php
              $best_wp = new wp_Query(array(
                    'post_type' => 'club_news',                    
                    'meta_query' => array(
                        array(
                         'key' => 'category_club',
                         'value' => get_the_ID(),
                         'compare' => 'IN'
                        ),
                    )                 
                ));            

                if ($best_wp->have_posts()){
                    ?>
                    <div class="rs-blog-grid rs-blog ">
                    
                        <div class="rs-heading style2   ">
                            <div class="title-inner ">                                         
                                <h2 class="title title-upper"><?php  $club_news_text = !empty($khelo_option['club_news_text']) ? $khelo_option['club_news_text']: esc_html__('Club News', 'khelo');
                                     echo esc_html( $club_news_text ); ?></h2> <span class="lines-bg"></span>
                                <div class="title-img bottom-img"></div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                while($best_wp->have_posts()): $best_wp->the_post();
                                    ?>
                                    <div class="blog-item col-lg-4 col-md-12 style2 ">
                                        <div class="blog-img image-scale">
                                            <div class="image-wrap">
                                                <a href="<?php the_permalink();?>"> <?php the_post_thumbnail();  ?></a>
                                            </div>
                                            <div class="all-meta">
                                                <div class="meta meta-date">
                                                    <span class="month-day"><?php echo get_the_date( 'd' ) ?></span>
                                                    <span class="month-name"><?php echo get_the_date( 'M' ) ?></span>
                                                </div>
                                                <div class="meta author"><i class="glyph-icon flaticon-user-1"></i>     <span class="author"><?php the_author();?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom-shadow1 blog-meta ">
                                            <h3 class="blog-title"><a href="<?php the_permalink();?>"> <?php the_title() ?></a></h3>
                                            <div class="blog-desc">
                                                <?php                                              
                                                echo khelo_custom_excerpt(18);?>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                <?php }
             ?> 
        </div>
        <div class="clear-fix"></div>            
      <!-- Blog Detail End --> 
    </div>
    
    </div>
</div>
<!-- .container -->
<?php
get_footer();