<?php
/* Top Header part for khelo Theme
*/
global $khelo_option;
$rs_top_bar = get_post_meta(get_the_ID(), 'select-top', true);
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = $khelo_option['header-grid'];
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}
if($rs_top_bar != 'hide'){
  if(!empty($khelo_option['show-top']) || ($rs_top_bar=='show')){
     
       if( !empty($khelo_option['welcome-text']) || !empty($khelo_option['show-social'])){?> 
          <div class="toolbar-area">
            <div class="<?php echo esc_attr($header_width);?>">
              <div class="row">
                <div class="col-lg-7">
                  <div class="toolbar-contact">
                    <ul class="rs-contact-info">                   
                       <?php if(!empty($khelo_option['welcome-text'])) { ?>
                            <li>  <i class="fa fa-home"></i><?php echo esc_html($khelo_option['welcome-text']); ?> </li>
                  <?php } ?> 

                  <?php if (!empty($khelo_option['top-opening'])) { ?>
                          <li class="opening">
                              <i class="fa flaticon-clock"></i>
                              <?php echo esc_html($khelo_option['top-opening'])?>                            
                              </li>
                        <?php } ?>
                  </ul>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="toolbar-sl-share">
                    <ul class="clearfix">
                      <?php
                      if(!empty($khelo_option['show-social'])){
                        $top_social = $khelo_option['show-social']; 
                    
                          if($top_social == '1'){              
                            if(!empty($khelo_option['facebook'])) { ?>
                            <li> <a href="<?php echo esc_url($khelo_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($khelo_option['twitter'])) { ?>
                            <li> <a href="<?php echo esc_url($khelo_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($khelo_option['rss'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['pinterest'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['linkedin'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['google'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['instagram'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($khelo_option['vimeo'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['tumblr'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($khelo_option['youtube'])) { ?>
                            <li> <a href="<?php  echo esc_url($khelo_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
                            <?php } ?>
                                    <?php if(is_active_sidebar('language-widget')){?>                                 
                                        <?php dynamic_sidebar('language-widget');?>                             
                                    <?php }?>
                                <?php }
                            }
                         ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php 
    }
  }
} ?>
