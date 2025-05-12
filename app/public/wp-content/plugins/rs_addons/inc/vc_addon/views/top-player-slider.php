<?php
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 
    global $khelo_option;
     $hide_details_palyer = empty($khelo_option['show_player_details']) ? 'hide_details_palyer' : '';
?>

<div class="rs-players-slider <?php echo esc_attr($css_class);?> <?php echo esc_attr($hide_details_palyer); ?>">
    <div class="team-carousel owl-carousel owl-navigation-yes" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">

        <?php
            $team_arr_cats = array();
            $team_arr= explode(',', $team_cat);      

            for ($i=0; $i < count($team_arr) ; $i++) { 
                //$cats = get_term_by('slug', $arr[$i], $taxonomy);
                // if(is_object($cats)):
                $team_arr_cats[]= $team_arr[$i];
                //endif;
            } 
            if(empty($team_cat)) {
                $latest_player = new WP_Query( array(
                    'post_type' => 'players',
                    'posts_per_page' => $player_per,
                    'meta_key' => 'top_player'
                ));
            } else{
                 $latest_player = new WP_Query( array(
                    'post_type' => 'players',
                    'posts_per_page' => $player_per,
                    'meta_key' => 'top_player',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'player-category',
                            'field' => 'slug', //can be set to ID
                            'terms' => $team_arr_cats//if field is ID you can reference by cat/term number
                        ),
                    )
                ));
            }
               
        if ( $latest_player->have_posts() ) :
        while ( $latest_player->have_posts() ) :
            $latest_player->the_post();
            global $player;
           
            $player_position = get_post_meta( get_the_ID(), 'player_position', true);
            $custom_position = get_post_meta( get_the_ID(), 'custom_position', true);
            $player_sign     = get_post_meta( get_the_ID(),'player-sign', true);
            $present_club    = get_post_meta( get_the_ID(),'present_club', true);
            $previous_club   = get_post_meta( get_the_ID(),'previous_club', true);
            $debut_club      = get_post_meta( get_the_ID(),'debut_club', true);
            $player_career   = get_post_meta( get_the_ID(), 'player_career', true );
            $facebook        = get_post_meta( get_the_ID(), 'facebook', true );
            $twitter         = get_post_meta( get_the_ID(), 'twitter', true );
            $google_plus     = get_post_meta( get_the_ID(), 'google_plus', true );
            $linkedin        = get_post_meta( get_the_ID(), 'linkedin', true );
            $vimeo           = get_post_meta( get_the_ID(), 'vimeo', true );
            $instagram       = get_post_meta( get_the_ID(), 'instagram', true );

            $player_position = ( !empty( $custom_position )) ? $custom_position : $player_position;

            ?>

            <div class="player-item">
                <div class="player-img">
                    <?php if(empty($hide_details_palyer)){ ?>
                        <a href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                                echo get_the_post_thumbnail( get_the_ID());
                            }?>
                        </a>
                    <?php } else {
                        if ( has_post_thumbnail( get_the_ID() ) ) {
                            echo get_the_post_thumbnail( get_the_ID());
                        }
                    }?>
                </div>
                <div class="detail-wrap">
                    <div class="person-details">
                        <h3 class="player-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                        <div class="person-info">

                            <?php if(!empty($player_position)): ?>
                                <div class="info-inner">
                                    <span class="info-title"><?php echo esc_html_e('Player Position', 'khelo'); ?></span>
                                    <span class="info-value"><?php echo esc_html($player_position); ?></span>
                                    <div class="clear-both"></div>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($present_club)): 
                                $new_club = new WP_Query( array(
                                    'post_type' => 'club',
                                    'post_status' => 'publish',
                                    'p' => $present_club,
                                ));

                                if ( $new_club->have_posts() ) :
                                    while ( $new_club->have_posts() ) :
                                        $new_club->the_post(); 
                                        ?>
                                        <div class="info-inner">
                                            <span class="info-title"><?php echo esc_html_e('Present Club', 'khelo'); ?></span>
                                            <span class="info-value"><?php the_title(); ?></span>
                                            <div class="clear-both"></div>
                                        </div>
                                    <?php        
                                    endwhile;
                                    wp_reset_query();
                                endif;
                                ?>
                            <?php endif; ?>

                            <?php if(!empty($previous_club)):
                                $new_deb_club = new WP_Query( array(
                                    'post_type' => 'club',
                                    'post__in' => $previous_club,
                                ));
                            ?>

                                <div class="info-inner">
                                    <span class="info-title"><?php echo esc_html_e('Previous Club', 'khelo'); ?></span>
                                    <span class="info-value">
                                        <?php 
                                            if ( $new_deb_club->have_posts() ) :
                                                while ( $new_deb_club->have_posts() ) :
                                                    $new_deb_club->the_post(); ?>
                                                        <?php the_title();
                                                endwhile;
                                                wp_reset_query();
                                            endif;
                                        ?>                                           
                                    </span>
                                    <div class="clear-both"></div>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($debut_club)): 
                                $new_deb_club = new WP_Query( array(
                                    'post_type' => 'club',
                                    'post_status' => 'publish',
                                    'p' => $debut_club,
                                ));

                                if ( $new_deb_club->have_posts() ) :
                                    while ( $new_deb_club->have_posts() ) :
                                        $new_deb_club->the_post(); ?>
                                        <div class="info-inner">
                                            <span class="info-title"><?php echo esc_html_e('Debut Club', 'khelo'); ?></span>
                                            <span class="info-value"><?php the_title(); ?></span>
                                            <div class="clear-both"></div>
                                        </div>
                                    <?php        
                                    endwhile;
                                    wp_reset_query();
                                endif;
                                ?>
                            <?php endif; ?>

                            <?php if( !empty($facebook) || !empty($twitter) || !empty($google_plus) || !empty($instagram) || !empty($vimeo) || !empty($linkedin) ) { ?>
                                <div class="info-inner">
                                    <span class="info-title"><?php echo esc_html_e('Follow On', 'khelo'); ?></span>
                                    <span class="info-value social-share">
                                        <ul>
                                            <?php if($facebook):?>
                                                <li class="social-icon">
                                                    <a href="<?php  echo esc_url( $facebook ); ?>" target="_blank"> 
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                            <?php endif;?>

                                              <?php if($twitter):?>
                                                  <li class="social-icon">
                                                    <a href="<?php  echo esc_url( $twitter ); ?>" target="_blank"> 
                                                      <i class="fa fa-twitter" aria-hidden="true"></i>
                                                    </a>
                                                  </li>
                                                <?php endif;?>
                                              <?php if($google_plus):?>
                                              <li class="social-icon">
                                                  <a href="<?php  echo esc_url( $google_plus ); ?>" target="_blank">
                                                      <i class="fa fa-google-plus"></i>
                                                  </a>
                                              </li>
                                              <?php endif; ?>
                                               <?php if($instagram):?>
                                              <li class="social-icon">
                                                  <a href="<?php  echo esc_url( $instagram ); ?>" target="_blank">
                                                      <i class="fa fa-instagram"></i>
                                                  </a>
                                              </li>
                                              <?php endif; ?>
                                               <?php if($vimeo):?>
                                              <li class="social-icon">
                                                  <a href="<?php  echo esc_url( $vimeo ); ?>" target="_blank">
                                                      <i class="fa fa-vimeo"></i>
                                                  </a>
                                              </li>
                                              <?php endif; ?>
                                              <?php if($linkedin):?>
                                                  <li class="social-icon"><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"> <i class="fa fa-linkedin"></i></a></li>
                                              <?php endif; ?>
                                        </ul>
                                    </span>
                                    <div class="clear-both"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; 
        wp_reset_query();
        endif; ?>
    </div>    
</div>
