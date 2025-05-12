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
function cmb2_output_gallery_title_check( $file_list_meta_key, $img_size = 'medium', $player_gallery_text) {
    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
    if(!empty( $files )){        
       
        echo '<li class="nav-link"><a data-toggle="tab" href="#gallery"> '.esc_html( $player_gallery_text ).'</a></li>';
    }   
}
?>
<!-- Main content Start -->
<div class="main-content">  
  <div class="rs-porfolios-details">      
        <?php while ( have_posts() ) : the_post();
        //take metafield value
        $full_name       = get_post_meta(  get_the_ID(), 'full_name', true );
        $position        = get_post_meta(  get_the_ID(), 'player_position_meta', true );
        $custom_position = get_post_meta(  get_the_ID(), 'custom_position', true );
        $present_club    = get_post_meta(  get_the_ID(), 'present_club_meta', true );
        $previous_club   = get_post_meta(  get_the_ID(), 'previous_club' , true );        
        $facebook        = get_post_meta( get_the_ID(), 'facebook', true );
        $twitter         = get_post_meta( get_the_ID(), 'twitter', true );
        $google_plus     = get_post_meta( get_the_ID(), 'google_plus', true );
        $linkedin        = get_post_meta( get_the_ID(), 'linkedin', true );
        $vimeo           = get_post_meta( get_the_ID(), 'vimeo', true );
        $instagram       = get_post_meta( get_the_ID(), 'instagram', true );
        $squad_no        = get_post_meta( get_the_ID(), 'squad_number', true );
        $player_birth_date        = get_post_meta( get_the_ID(), 'player_birth_date', true );
        ?>          
        <div class="container">
            <div id="content">  
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="single-player-image">
                         <?php the_post_thumbnail(); ?>
                         <div class="name">
                            <?php if( $full_name ): ?>
                               <h3><?php echo esc_html( $full_name);?></h3>
                            <?php endif;

                            if($custom_position): ?>
                                <span class="player_position"><?php echo esc_html( $custom_position ); ?></span>
                            <?php elseif( $position ): ?>
                                <span class="player_position"><?php echo esc_html( $position ); ?></span>
                                <?php else:
                            endif;
                            
                            if($player_birth_date) { ?>
                                <span class="player_birth_date">Birth date : <?php echo esc_html( $player_birth_date ); ?></span>
                            <?php }
                            
                            if($present_club) { 
                                ?> <span class="clu"><?php echo esc_html( $present_club );?></span> <?php                             
                            }?>                          
                                

                            <div class="ps-informations team-social-icons">
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
                          </div>
                          <div class="clear-fix"></div>
                          <?php if($squad_no): ?>
                            <div class="squad_no">
                                <?php  echo esc_html($squad_no);?>
                            </div>
                            <?php endif; ?>  
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12">                    
                    <div class="palyer-profile">                        
                        <div class="innertrainers">
                            <div class="ps-informations">
                                 <?php $player_exta = get_post_meta( get_the_ID(), 'player_exta', true );
                                    if(!empty($player_exta)){ ?>
                                        <div class="team-info"> 
                                            <?php $player_profile_title = !empty($khelo_option['player_profile_title']) ? $khelo_option['player_profile_title']: esc_html__('Player Profile', 'khelo');
                                            ?>
                                            <h3 class="title-bg"><?php echo esc_html( $player_profile_title );?></h3>
                                            <table>       
                                              <?php foreach ( $player_exta as $value ) { ?>                                    
                                                    <tr>
                                                        <td><span class="pb-label"><?php echo wp_kses_post($value['info_title']); ?></span></td>
                                                        <td><span class="pb-label"><?php echo wp_kses_post($value['info_value']); ?></span></td>
                                                    </tr> 
                                                  
                                              <?php } ?>
                                            </table>        
                                        </div>
                                    <?php
                                    }
                                  ?>            

                              <?php $player_career = get_post_meta( get_the_ID(), 'player_career', true );
                              if(!empty($player_career)){
                              ?>
                              <div class="career-info"> 
                                    <?php $player_career_title = !empty($khelo_option['player_career_title']) ? $khelo_option['player_career_title']: esc_html__('Career Information', 'khelo');
                                    ?>
                                    <h3 class="title-bg"><?php echo esc_html( $player_career_title );?></h3>                   
                                    <table>       
                                      <?php foreach ( $player_career as $value ) { ?>                                    
                                            <tr>
                                                <td><span class="pb-label"><?php echo wp_kses_post($value['info_title']); ?></span></td>
                                                <td><span class="pb-label"><?php echo wp_kses_post($value['info_value']); ?></span></td>
                                            </tr> 
                                          
                                      <?php } ?>
                                      <?php if($previous_club) { ?>
                                      <tr>
                                          <td><?php esc_html_e('Previous Club','khelo');?></td><td><?php 
                                                $args = array(
                                                    'post_type' => 'club',  
                                                    'post__in' => $previous_club       
                                                );

                                                $que = new WP_Query( $args );

                                                if ( $que->have_posts() ) {
                                                while ( $que->have_posts() ) : $que->the_post();?>
                                                    <span class="previous_club"><?php echo  get_the_title($que->ID);?></span>
                                                <?php
                                                endwhile;
                                                wp_reset_query();
                                                }                        
                                               ?>
                                          </td>
                                        </tr>  
                                      <?php } ?>
                                      <?php if($present_club) { ?>
                                      <tr>
                                          <td><?php esc_html_e('Present Club','khelo');?></td>
                                          <td><?php 
                                                    $args = array(
                                                    'post_type' => 'club',  
                                                    'p' => $present_club       
                                                );

                                                $que = new WP_Query( $args );

                                                if ( $que->have_posts() ) {
                                                while ( $que->have_posts() ) : $que->the_post();?>
                                                    <span class="clu"><?php echo  get_the_title($que->ID);?></span>
                                                <?php
                                                endwhile;
                                                wp_reset_query();
                                                }                        
                                               ?>
                                          </td>
                                        </tr>  
                                      <?php } ?>
                                    </table>        
                                  </div>
                              <?php
                              }
                              ?>                         
                                               
                                                  
                            </div>
                            <div class="clear-fix"></div>
                        </div>
                    </div>

                </div>          
                  
              </div>
            <div class="player-details-information club-details_data">
              <?php if(!empty($khelo_option['show_team_tab'])) : ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#club-history">
                        <?php 
                            $overview_text = !empty($khelo_option['overview_text']) ? $khelo_option['overview_text']: esc_html__('Player Overview', 'khelo');
                             echo esc_html( $overview_text );
                        ?>                                
                      </a>
                    </li>
                    <?php 

                        $player_gallery_text = !empty($khelo_option['player_gallery_text']) ? $khelo_option['player_gallery_text']: esc_html__('Player Gallery', 'khelo');
                        
                        cmb2_output_gallery_title_check ( 'gallery_player_images', 'small', $player_gallery_text ); ?>                     

                    <?php $club_videos = get_post_meta( get_the_ID(), 'club_videos', true );

                    if(!empty($club_videos)){?>
                    <li class="nav-link">
                        <a data-toggle="tab" href="#videos_id">
                            <?php 
                            $player_video_text = !empty($khelo_option['player_video_text']) ? $khelo_option['player_video_text']: esc_html__('Player Video', 'khelo');
                             echo esc_html( $player_video_text );
                        ?> 
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <div id="club-history" class="club-content tab-pane active">                   
                        <?php
                            the_content();         
                        ?>
                    </div>

                
                    <div id="gallery" class="tab-pane fade">
                        <?php cmb2_output_file_list( 'gallery_player_images', 'small' ); ?>
                    </div>
                   
                    <!-- End gallery -->
                    <div id="videos_id" class="tab-pane fade">
                        
                        <div class="rs-blog-grid rs-blog">
                          <?php $club_videos = get_post_meta( get_the_ID(), 'club_videos', true );
                              if( !empty($club_videos)){
                          ?>
                          
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
                                                      <img src="<?php echo esc_url( $thumbURL ); ?>" alt="<?php echo esc_url( $thumbURL ); ?>" / >
                                                      <span><i class="fa fa-play" aria-hidden="true"></i></span>
                                                  </a>
                                              </div> 
                                          </div>                                          
                                  
                                 <?php } ?>                                     
                              </div>
                          <?php }?>
                      </div> 
                        
                    </div>
                    <!-- End Jersy -->
                </div>
              <?php else: 
                  the_content();
              endif; ?>  

            </div>  
        </div>     
    </div>     
    <?php  endwhile; ?>
   
  </div>
</div>
<!-- Single Team End -->
<?php
get_footer();