<?php 
global $khelo_option;
$rs_offcanvas = get_post_meta(get_the_ID(), 'show-off-canvas', true);
if(!empty($khelo_option['off_canvas']) || ($rs_offcanvas == 'show') ){
            $off = $khelo_option['off_canvas'];
            if( ($off == 1) || ($rs_offcanvas == 'show') ){
       ?>
        <ul class="offcanvas-icon">
          <li class="nav-link-container"> 
            <a href='#' class="nav-menu-link">
              <span class="hamburger1"></span>
              <span class="hamburger2"></span>
              <span class="hamburger3"></span>
            </a> 
          </li>
        </ul>
        <?php } 
      }

     //off convas here
    if(!empty( $khelo_option['off_canvas'] ) || ($rs_offcanvas == 'show') ){
        $off = $khelo_option['off_canvas'];
        if( ($off == 1) || ($rs_offcanvas == 'show')){
    ?>
    <nav class="nav-container nav">
        <ul class="sidenav offcanvas-icon">
           <li class="nav-link-container"> 
            <a href='#' class="nav-menu-link">              
              <span class="hamburger1"></span>
              <span class="hamburger3"></span>
            </a> 
          </li>
          <?php dynamic_sidebar('sidebarcanvas-1');?>
          <li><?php get_template_part( 'inc/header/offcanvas-content' ); ?></li>
        </ul>
    </nav>
    <?php }
}?>