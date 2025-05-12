<?php

/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php global $khelo_option; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
    if ( ! function_exists( 'wp_body_open' ) ) {
            function wp_body_open() {
                    do_action( 'wp_body_open' );
            }
    }?>
 <!--Preloader start here-->
   <?php get_template_part( 'inc/header/preloader' ); ?>
 <!--Preloader area end here-->
 <?php
    if(is_page()):
       $page_bg = get_post_meta( $post->ID, 'page_bg', true ); 
       $page_bg_back = ( $page_bg == 'Dark' ) ? 'dark' : '';
       else:
       $page_bg_back = '';
    endif;
    ?>
  <div id="page" class="site <?php echo esc_attr($page_bg_back);?>">
  <?php
   get_template_part('inc/header/header');

   if ( ! is_active_sidebar( 'newsletter')){
        $newsleller_bottom = "";
   }else{
        $newsleller_bottom = "main-space";
   }
  ?>
 
  <!-- End Header Menu End -->
  <div class="main-contain <?php echo esc_attr($newsleller_bottom); ?>">
