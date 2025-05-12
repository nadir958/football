<?php 
global $khelo_option;
$post_meta_header = '';
$header_style = '';
$logo_height = !empty($khelo_option['logo-height']) ? 'style = "max-height: '.$khelo_option['logo-height'].'"' : '';
$sticky_logo_height =!empty($khelo_option['sticky_logo_height']) ? 'style = "max-height: '.$khelo_option['sticky_logo_height'].'"' : '';

if(!empty($khelo_option['header_layout'])){ 
  $header_style = $khelo_option['header_layout'];
}  
if(is_page() || is_single()){
  $post_meta_header = get_post_meta(get_the_ID(), 'select-logo', true); 
}elseif(is_home() && !is_front_page() || is_home() && is_front_page()){
  $post_meta_header = get_post_meta(get_queried_object_id(), 'select-logo', true);  
}

if($post_meta_header == 'dark' || $post_meta_header == '' ) {?>

  <div class="logo-area">
    <?php
       if (!empty( $khelo_option['logo']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses_post($logo_height);?> src="<?php echo esc_url( $khelo_option['logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>         
       <?php  } 
    ?>
  </div>
<?php 
}
 elseif($post_meta_header == 'light' || $header_style == 'style2' ){ ?>
  <div class="logo-area">
    <?php
       if (!empty( $khelo_option['logo_light']['url'] ) ) { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses_post($logo_height);?> src="<?php echo esc_url( $khelo_option['logo_light']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <?php } else{?>
        
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>   
       
       <?php  } 
    ?>     
  </div>
<?php }else{
  ?>
  <div class="logo-area">
      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>  
   </div>
  <?php
}

 if (!empty( $khelo_option['rswplogo_sticky']['url'] ) ) { ?>
    <div class="logo-area sticky-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses_post($sticky_logo_height);?> src="<?php echo esc_url( $khelo_option['rswplogo_sticky']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
       </div>
    <?php } 

     else{?>
      <div class="logo-area sticky-logo">
     <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
         
    </div>
<?php }

