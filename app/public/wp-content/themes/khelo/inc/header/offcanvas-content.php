<?php 

global $khelo_option;
if(!empty($khelo_option['facebook']) || !empty($khelo_option['twitter']) || !empty($khelo_option['rss']) || !empty($khelo_option['pinterest']) || !empty($khelo_option['google']) || !empty($khelo_option['instagram']) || !empty($khelo_option['vimeo']) || !empty($khelo_option['tumblr']) ||  !empty($khelo_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($khelo_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($khelo_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($khelo_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($khelo_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($khelo_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($khelo_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($khelo_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($khelo_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

