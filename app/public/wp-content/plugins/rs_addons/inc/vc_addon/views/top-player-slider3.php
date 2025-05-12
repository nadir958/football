<?php
    $top_player_data = array(
            'col_lg' => $col_lg,
            'col_md' => $col_md,
            'col_sm' => $col_sm,
            'col_sm' => $col_xs            
        );
        
    wp_localize_script( 'khelo-main', 'player_data', $top_player_data );

    $css_class     = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 
    global $khelo_option;
?>
<div class="rs-swiper-slider">
    <div class="swiper-container">
        <div class="swiper-wrapper">
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
                $player_position = get_post_meta(get_the_ID(), 'player_position', true);
                $squad_numbers   = get_post_meta(get_the_ID(),'squad_number', true);
                
                
            ?>
            <div class="swiper-slide">
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
                    <div class="detail-wrap" <?php echo $content_bg; ?>>
                        <div class="player-title">
                            <h4 class="title"><a href="<?php the_permalink() ?>" <?php echo $title_color; ?>><?php the_title(); ?></a></h4>
                            <span class="player-position" <?php echo $player_color; ?>><?php echo esc_html($player_position); ?></span>
                        </div>
                        <div class="squad-numbers" <?php echo $number_color; ?>><?php echo esc_html($squad_numbers); ?></div>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); endif; ?>
        </div>
        <?php if($slider_dots == 'true'){ ?>
        <div class="swiper-pagination"></div>
        <?php } ?>

        <?php if($slider_nav == 'true'){ ?>
        <div class="slider-nav">
            <div class="prev nav"><i class="flaticon-left-arrow"></i></div>
            <div class="next nav"><i class="flaticon-right-arrow"></i></div>
        </div>
        <?php } ?>
    </div>
</div>
