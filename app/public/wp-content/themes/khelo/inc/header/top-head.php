<?php
/* Top Header part for grassy template
*/
global $khelo_option;
?>
<?php if(!empty($khelo_option['show-top'])){ 
  if(is_page()){
     $rs_top_bar = get_post_meta($post->ID, 'top_bar', true);
     if($rs_top_bar == 'Show' || $rs_top_bar == ''){
     ?> 
    <div class="toolbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-7 col-xs-12">
            <div class="toolbar-contact">
              <ul>
                <?php if(!empty($khelo_option['welcome-text'])) { ?>
                <li> <i class="fa fa-handshake-o"></i> <?php echo esc_html($khelo_option['welcome-text']); ?> </li>
                <?php } ?>
                <?php if(!empty($khelo_option['top-email'])) { ?>
                <li> <i class="fa fa-envelope-o"></i><a href="mailto:<?php echo esc_attr($khelo_option['top-email'])?>"><?php echo esc_html($khelo_option['top-email'])?></a> </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-sm-5 col-xs-12">
            <div class="toolbar-sl-share">
              <ul>
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
                      <?php } 
                      }
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
 else{
  ?>
  <div class="toolbar-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-sm-7 col-xs-12">
            <div class="toolbar-contact">
              <ul>
                <?php if(!empty($khelo_option['welcome-text'])) { ?>
                <li> <i class="fa fa-handshake-o"></i> <?php echo esc_html($khelo_option['welcome-text']); ?> </li>
                <?php } ?>                
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-sm-5 col-xs-12">
            <div class="toolbar-sl-share">
              <ul>
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
                      <?php } 
                      }
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
} ?>
