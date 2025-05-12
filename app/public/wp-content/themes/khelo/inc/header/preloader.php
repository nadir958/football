<?php 
global $khelo_option;
$preloader_img = "";

if(!empty($khelo_option['show_preloader']))
  {
    $loading = $khelo_option['show_preloader'];
    if(!empty($khelo_option['preloader_img'])){
      $preloader_img = $khelo_option['preloader_img'];
    }
    if($loading == 1){
      if(empty($preloader_img['url'])):
      ?>  
        <div id="loading" class="loading">
          <div class="rs-box">
            <div class="rs-shadow"></div>
            <div class="rs-gravity">
              <div class="rs-ball"></div>
            </div>
          </div>
        </div>
      <?php else: ?>

      <div class="loading image-preloader">
          <div class="loading-text">
              <img src="<?php echo esc_url($preloader_img['url']);?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
          </div> 
      </div> 

      <?php endif; ?>
  <?php }
}?>

 <?php if(!empty($khelo_option['off_sticky'])):   
        $sticky = $khelo_option['off_sticky'];         
        if($sticky == 1):
         $sticky_menu ='menu-sticky';        
        endif;
       else:
       $sticky_menu ='';
      endif;


if( is_page() ){
 $post_meta_header = get_post_meta($post->ID, 'trans_header', true);  

     if($post_meta_header == 'Default Header'){       
        $header_style = 'default_header';             
     }
     else{
        $header_style = 'transparent_header';
    }
 }
 else{
    $header_style = 'transparent_header';
 }

 ?>   