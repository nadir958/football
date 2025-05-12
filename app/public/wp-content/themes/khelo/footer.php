<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
     
</div><!-- .main-container -->
<?php
global $khelo_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom2', true);
if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = !empty($khelo_option['header-grid']) ? $khelo_option['header-grid'] : '';
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}

$footer_bg       = get_post_meta(get_the_ID(),'footer_bg', true);
$footer_bg_img   = get_post_meta(get_the_ID(),'footer_bg_img', true);
$copyright_bg    = get_post_meta(get_the_ID(),'copyright_bg', true);
$copyright_trans = get_post_meta(get_the_ID(),'copyright_trans', true);
$bg_pos          = get_post_meta(get_the_ID(),'footer_bg_position', true);
$copy_space      = get_post_meta(get_the_ID(),'copyright_padding', true);
$copy_trans      = ($copyright_trans=="yes") ? 'transparent' : '';
$footer_bg_img   = ($footer_bg_img) ? $footer_bg_img : '';
$footer_bg_pos   = ($bg_pos) ? $bg_pos : 'inherit';
$footer_bg       = ($footer_bg) ? $footer_bg : '';
$footer_select   = get_post_meta(get_the_ID(),'footer_select', true);
$footer_select   = ($footer_select) ? $footer_select : '';


if(!empty( $footer_bg_img)):?>
    <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background-image: url('<?php echo esc_url($footer_bg_img); ?>'); background-position: <?php echo esc_attr($footer_bg_pos); ?>; <?php if (!empty($footer_bg)): ?> background-color: <?php echo esc_attr($footer_bg) ?> <?php endif; ?>">

<?php elseif(!empty( $footer_bg)):?>
    <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background: <?php echo esc_attr($footer_bg);?>; background-position: <?php echo esc_attr($footer_bg_pos); ?>">

<?php elseif( !empty( $khelo_option['footer_bg_image']['url'])):?>
    <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background-image: url('<?php echo esc_url($khelo_option['footer_bg_image']['url']);?>'); background-position: <?php echo esc_attr($footer_bg_pos); ?>">
    <?php else:?>
        <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" >
<?php endif; ?>
  <?php  
    get_template_part( 'inc/footer/footer','top' ); 
?>  


  <div class="footer-bottom" <?php if(!empty( $copyright_bg)): ?> style="background: <?php echo esc_attr($copyright_bg); ?> !important;" <?php elseif(!empty( $copy_trans)): ?> style="background: <?php echo esc_attr($copy_trans); ?> !important;" <?php endif; ?>>
        <div class="<?php echo esc_attr($header_width);?>">
            <div class="row">
              <div class="col-md-6">
                <div class="copyright" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                    <?php if(!empty($khelo_option['copyright'])){?>
                    <p><?php echo wp_kses_post($khelo_option['copyright']); ?></p>
                    <?php }
                     else{
                        ?>
                    <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                    </p>
                    <?php
                     }   
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                 <?php  get_template_part( 'inc/footer/footer','social' ); ?>
            </div>
             
            </div>
        </div>
  </div>
</footer>
</div><!-- #page -->
<?php 
if(!empty($khelo_option['show_top_bottom'])){
?>
 <!-- start scrollUp  -->
<div id="scrollUp">
    <i class="fa fa-angle-up"></i>
</div>   
<?php } ?>   

<?php wp_footer(); ?>
  </body>
</html>