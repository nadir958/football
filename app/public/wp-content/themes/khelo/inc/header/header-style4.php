<?php

/*
Header Style 1
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
$rs_show_quote = get_post_meta(get_the_ID(), 'show-quote', true);

?>

<header id="rs-header" class="single-header header-style4">
    <div class="header-inner <?php echo esc_attr($sticky_menu);?>">   
    <?php
               
        get_template_part('inc/header/top-head/top-head','three');    
      
        $menu_bg = '';
        //check individual header 
        if(is_page() || is_single()){
            $menu_bg = get_post_meta(get_the_ID(), 'menu-type-bg', true);
        } elseif(is_home() && !is_front_page() || is_home() && is_front_page()){
            $menu_bg= get_post_meta(get_queried_object_id(), 'menu-type-bg', true);
        }
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>

        
            <div class="<?php echo esc_attr($header_width);?>">
                <div class="menu-area" <?php echo wp_kses_post($menu_bg_color);?>>
                    <div class="row-table">
                        
                        <div class="col-cell menu-responsive">  
                            <?php 
                            $offborder ="";
                            if(!empty($khelo_option['off_canvas']) && !empty($khelo_option['off_search'])):
                                 $offborder="off-border-left"; 
                            endif;
                                if($rs_show_quote != 'hide'){
                                    if(!empty($khelo_option['quote'])){ ?>
                                    <div class="btn_quote"><a href="<?php echo esc_url($khelo_option['quote_link']); ?>" class="quote-button"><?php  echo esc_html($khelo_option['quote']); ?></a></div>
                            <?php } }
                            if(!empty($khelo_option['off_canvas']) || ($rs_offcanvas == 'show') ): ?>
                            <div class="sidebarmenu-area text-right <?php echo esc_attr($offborder); ?>">
                              <?php 
                                //off convas here
                                get_template_part('inc/header/off-canvas');
                              ?> 
                            </div>
                            <?php endif; 


                            //include Cart here
                            
                            if(!empty($khelo_option['wc_cart_icon'])) { ?>
                                <?php  get_template_part('inc/header/cart'); ?>
                            <?php  } 

                            if(!empty($khelo_option['off_search']) || ($rs_top_search == 'show')): ?>
                            <div class="sidebarmenu-search text-right">
                                <?php 
                                    //include sticky search here
                                    get_template_part('inc/header/search');
                                ?> 
                            </div>                        
                            <?php endif;                  


                            if(!empty($khelo_option['off_canvas']) || !empty($khelo_option['off_search'])):
                              $menu_right='nav-right-bar';
                            else:
                              $menu_right=''; 
                            endif;
                            get_template_part('inc/header/menu');    
                            ?>                
                        </div>
                    </div>                
                </div>
            </div> 
       
        <!-- Header Menu End -->
    </div>
     <!-- End Slider area  -->
   <?php 
    get_template_part( 'inc/breadcrumbs' );
  ?>
</header>

<?php  
    get_template_part('inc/header/slider/slider');
?>
