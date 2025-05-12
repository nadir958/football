<?php

/*
Header Style 4
*/
global $khelo_option;
$sticky = $khelo_option['off_sticky']; 
$sticky_menu = ($sticky == 1) ? ' menu-sticky' : '';

$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = $khelo_option['header-grid'];
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}

$rs_top_search = get_post_meta(get_the_ID(), 'select-search', true);
$rs_show_cart = get_post_meta(get_the_ID(), 'show-cart-icon', true);
$rs_offcanvas = get_post_meta(get_the_ID(), 'show-off-canvas', true);
$rs_headicons = get_post_meta(get_the_ID(), 'show-head-icons', true);
$rs_show_quote = get_post_meta(get_the_ID(), 'show-quote', true);

?>

<header id="rs-header" class="header-style-3">
    <div class="header-inner<?php echo esc_attr($sticky_menu);?>">
       <!-- Toolbar Start -->
       <?php          
          get_template_part('inc/header/top-head/top-head','one');
        ?>
      <!-- Toolbar End -->

      <!-- Header Menu Start -->  
      <?php
        $menu_bg = '';
        //check individual header 
        if(is_page() || is_single() ){
            $menu_bg = get_post_meta(get_the_ID(), 'menu-type-bg', true);
        } elseif(is_home() && !is_front_page() || is_home() && is_front_page()){
            $menu_bg= get_post_meta(get_queried_object_id(), 'menu-type-bg', true);
        }
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>
      <div class="menu-area" <?php echo wp_kses_post($menu_bg_color);?>>
            <div class="<?php echo esc_attr($header_width);?>">
                <div class="menu_one">
                    <div class="row-table">               
                        <div class="col-cell menu-responsive">  
                            <?php                  
                                get_template_part('inc/header/menu-left');               
                            ?>
                        </div> 
                        <div class="col-cell"> 
                            <?php  get_template_part('inc/header/logo'); ?>
                        </div>

                        <div class="col-cell">                         
                            <?php                  
                                get_template_part('inc/header/menu-right');               
                            ?>  
                        </div> 
                    </div>
                </div>
            </div>    
        </div>
      <!-- Header Menu End --> 
    </div>
  <?php 
      get_template_part( 'inc/breadcrumbs' );
  ?>
    <!-- Slider Start Here -->
    <?php  get_template_part('inc/header/slider/slider'); ?>
</header>