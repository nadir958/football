<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
get_header(); ?>

<!-- Main content Start -->
<div class="main-content">  
  <div class="rs-porfolios-details">    

     <?php

    while ( have_posts() ) : the_post(); 
        //take metafield value
        $team1      = get_post_meta(  get_the_ID(), 'team1', true );
        $team2      = get_post_meta(  get_the_ID(), 'team2', true );
        $total_goal = get_post_meta(  get_the_ID(), 'total_goal', true );   
        $formation1 = get_post_meta(  get_the_ID(), 'team1_formation', true ); 
        $formation2 = get_post_meta(  get_the_ID(), 'team2_formation', true ); 

        $match_date = get_post_meta(  get_the_ID(), 'match_date', true );    
        $match_date  = date('F d Y, H:i', $match_date );
        ?>          
        <div class="container">
            <div id="content">  

            <div class="match-statistics">
                <h2><?php 
                $terms = wp_get_object_terms( $post->ID, 'league-category' );

                foreach( $terms as $term )
                $term_names[] = $term->name;
                echo implode( ', ', $term_names );
                ?></h2>
                <h3>
                    <?php echo esc_html($match_date); ?>
                    
                </h3>

                <table>
                    <tr>
                        <th>
                            <?php echo get_the_post_thumbnail($team1);?>
                            <?php echo get_the_title($team1);?>                                
                        </th>
                        <th class="goal">
                            <?php echo esc_attr($total_goal);?>                                
                        </th>
                        <th>
                            <?php echo get_the_post_thumbnail($team2);?>
                            <?php echo get_the_title($team2);?>                            
                        </th>
                    </tr>
                    <?php if($formation1 || $formation2){?>
                    <tr>
                        <td><?php echo esc_html($formation1);?></td>
                        <td><?php esc_html_e('Formation', 'khelo');?></td>
                        <td><?php echo esc_html($formation2);?></td>                        
                    </tr>
                <?php } ?>

                <?php $result_stat = get_post_meta( get_the_ID(), 'result_stat', true );
               
                  if(!empty($result_stat)){
                  ?>                 
                    
                  <?php foreach ( $result_stat as $value ) { ?>                                    
                        <tr>
                            <td><span class="pb-label"><?php echo wp_kses_post($value['team1_data']); ?></span></td>
                            <td><span class="pb-label"><?php echo wp_kses_post($value['team_info_value']); ?></span></td>
                            <td><span class="pb-label"><?php echo wp_kses_post($value['team2_data']); ?></span></td>
                        </tr> 
                      
                  <?php } ?>
                  
                  <?php
                  }
                  ?>            
                </table>
            </div>           
                
            </div>     
        </div> 
        <?php the_content(); ?>    
    <?php  endwhile; ?>
   
  </div>
</div>
<!-- Single Team End -->
<?php
get_footer();