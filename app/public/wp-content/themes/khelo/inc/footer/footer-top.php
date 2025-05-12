
<?php
    global $khelo_option; 
    $header_grid2 = "";
    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom2', true);
    $footer_type       = get_post_meta(get_the_ID(), 'footer_select', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($khelo_option['header-grid2']) ? $khelo_option['header-grid2'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }

if ( !is_active_sidebar( 'newsletter'  )){

}
else{
  if(is_active_sidebar('newsletter')){

  $newsletter_bg_img = get_post_meta(get_the_ID(), 'newsletter_bg_img', true);

  $newsletter_bg = get_post_meta(get_the_ID(), 'newsletter_bg', true);

  if(!empty($newsletter_bg_img) || !empty($newsletter_bg)){   
    $bg_subscribe = 'style="background-image: url('.esc_url($newsletter_bg_img).'); background:'.$newsletter_bg.'"';

  }else{
  $bg_subscribe = !empty($khelo_option['newsletter_bg_image']['url']) ? 'style="background: url('.esc_url($khelo_option['newsletter_bg_image']['url']).')"' : '';
}

?>
  <div class="newsletter-footer">
    <div class="container">
      <div class="row"> 
          <div class="col-lg-12">
              <div class="newsletter-inner" <?php echo wp_kses_post($bg_subscribe);?>><?php dynamic_sidebar('newsletter'); ?></div>
          </div>
      </div>
    </div> 
  </div><?php
  }
}
   

/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'footer1'  )
    && ! is_active_sidebar( 'footer2' )
    && ! is_active_sidebar( 'footer3'  )
    && ! is_active_sidebar( 'footer4' )
){
  
} 

else{
 if(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-3">

                <?php
                  if($footer_type == 'footerlight'){
                    if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                          <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                      </a>
                <?php }} ?>

                <?php if($footer_type != 'footerlight'){
                    if(!empty($khelo_option['footer_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
                <?php }} ?>            
              <?php dynamic_sidebar('footer1');?>      
                              
          </div>              
          <div class="col-lg-3">
            <?php dynamic_sidebar('footer2'); 
            
            ?>                             
          </div>
          <div class="col-lg-3">
              <?php dynamic_sidebar('footer3'); ?>
             
          </div>
          <div class="col-lg-3">
             <?php dynamic_sidebar('footer4'); ?>   
          </div>
      </div>
    </div>
  </div>
  <?php }
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  {?>
  <div class="footer-top">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-4">                                          
              <div class="about-widget widget">
                <?php
                  if($footer_type == 'footerlight'){
                    if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                          <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                      </a>
                <?php }} ?>

                <?php if($footer_type != 'footerlight'){
                    if(!empty($khelo_option['footer_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
                <?php }} ?>

                <?php dynamic_sidebar('footer1');?>                  
                  
              </div>                       
          </div>              
          <div class="col-lg-4">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>
          <div class="col-lg-4">
              <?php dynamic_sidebar('footer3'); 
             ?> 
          </div>         
      </div>
    </div>
  </div>
<?php } 
 elseif(is_active_sidebar('footer1') && is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php
                if($footer_type == 'footerlight'){
                  if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
              <?php }} ?>

              <?php if($footer_type != 'footerlight'){
                  if(!empty($khelo_option['footer_logo']['url'])) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                      <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                  </a>
              <?php }} ?>
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer2'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
  }

elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php
                if($footer_type == 'footerlight'){
                  if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
              <?php }} ?>

              <?php if($footer_type != 'footerlight'){
                  if(!empty($khelo_option['footer_logo']['url'])) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                      <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                  </a>
              <?php }} ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer4'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}

elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php
                if($footer_type == 'footerlight'){
                  if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
              <?php }} ?>

              <?php if($footer_type != 'footerlight'){
                  if(!empty($khelo_option['footer_logo']['url'])) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                      <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                  </a>
              <?php }} ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer3'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}


elseif(!is_active_sidebar('footer1') && is_active_sidebar('footer2') && is_active_sidebar('footer3') && !is_active_sidebar('footer4'))
  { ?>
  <div class="footer-top"> 
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">   
          <div class="col-lg-6">
            <?php
                  if($footer_type == 'footerlight'){
                    if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                          <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                      </a>
                <?php }} ?>

                <?php if($footer_type != 'footerlight'){
                    if(!empty($khelo_option['footer_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
                <?php }} ?> 
            <?php dynamic_sidebar('footer1'); ?>                            
          </div>                 
          <div class="col-lg-6">
            <?php dynamic_sidebar('footer3'); ?>                            
          </div>          
      </div>
    </div>
  </div>
  <?php
}

 elseif(is_active_sidebar('footer1') && !is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')) {
?>
<div class="footer-top"> 
<div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-lg-12">                                          
              <div class="about-widget widget">
                 <?php
                    if($footer_type == 'footerlight'){
                      if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                            <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                        </a>
                  <?php }} ?>

                  <?php if($footer_type != 'footerlight'){
                      if(!empty($khelo_option['footer_logo']['url'])) { ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                          <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                      </a>
                  <?php }} ?>

                  <?php dynamic_sidebar('footer1'); ?>
              </div>                  
          </div>                  
      </div>
  </div>
</div>
<?php } 

 elseif(!is_active_sidebar('footer1') && is_active_sidebar('footer2') && !is_active_sidebar('footer3') && !is_active_sidebar('footer4')) {
?>
<div class="footer-top"> 
<div class="<?php echo esc_attr($header_width);?>">
        <div class="row">                   
          <div class="col-md-12">
            <?php
                if($footer_type == 'footerlight'){
                  if(!empty($khelo_option['footer_dark_logo']['url'])) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                        <img src="<?php  echo esc_url($khelo_option['footer_dark_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                    </a>
              <?php }} ?>

              <?php if($footer_type != 'footerlight'){
                  if(!empty($khelo_option['footer_logo']['url'])) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                      <img src="<?php  echo esc_url($khelo_option['footer_logo']['url'])?>" alt="<?php echo esc_attr( get_bloginfo( 'name' )); ?>">
                  </a>
              <?php }} ?>

                <?php dynamic_sidebar('footer2'); ?>       
          </div>                  
      </div>
  </div>
</div>

<?php } } 

 if (   ! is_active_sidebar( 'sponsor'  )){

    }
    else{
        if(is_active_sidebar('sponsor')){
?>
        <div class="footer-sponsor">
          <div class="<?php echo esc_attr($header_width);?>">
            <div class="row"> 
                <div class="col-lg-8 offset-md-2">
                 <?php dynamic_sidebar('sponsor'); ?>
                </div>
            </div>
          </div> 
        </div>                 



<?php

        }
    }