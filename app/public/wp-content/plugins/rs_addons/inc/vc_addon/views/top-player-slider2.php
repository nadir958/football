<?php
    $css_class     = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 
    $class_special = ( $col_lg== 1 ) ? 'overlay-arrow' : "";
    global $khelo_option;
    $hide_details_palyer = empty($khelo_option['show_player_details']) ? 'hide_details_palyer' : '';
?>

<div class="rs-players-slider players-style2 <?php echo esc_attr($css_class);?> <?php echo esc_attr($class_special); ?> <?php echo esc_attr($hide_details_palyer);?>">
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
                    'meta_key' => 'top_player',
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
            $player_sign     = get_post_meta(get_the_ID(),'player-sign', true);
            $custom_position = get_post_meta(get_the_ID(),'custom_position', true);
            $squad_numbers   = get_post_meta(get_the_ID(),'squad_number', true);
            $present_club    = get_post_meta(get_the_ID(),'present_club', true);
            $previous_club   = get_post_meta(get_the_ID(),'previous_club', true);
            $debut_club      = get_post_meta(get_the_ID(),'debut_club', true);
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
                    
                    <h3 class="player-title">
                        <span class="squad-numbers"><?php echo esc_html($squad_numbers); ?></span> 
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        <span class="player-position"><?php echo esc_html($player_position); ?></span> 
                    </h3>
                </div>
            </div>
        </div>
        <?php endwhile; wp_reset_query(); endif; ?>
    </div>    
</div>
