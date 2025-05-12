<?php
    global $khelo_option;    
    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = $header_width = !empty($khelo_option['header-grid']) ? $khelo_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php $post_menu_type = get_post_meta(get_queried_object_id(), 'menu-type', true); ?>

<div class="rs-breadcrumbs  porfolio-details is-shop-hide">
 <?php
  if(!empty($khelo_option['blog_banner_main']['url'])) { ?>
  <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($khelo_option['blog_banner_main']['url']);?>')">
      <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
              <h1 class="page-title">
                <?php    
                if(!empty($khelo_option['blog_title'])) { ?>
                <?php echo esc_html($khelo_option['blog_title']);?>
                <?php }
                else{
                 esc_html_e('Blog','khelo');
                }
                ?>
              </h1>
              <?php  if(function_exists('bcn_display')){?>
                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
              <?php } ?>       
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }
  else{   
  ?>
  <div class="rs-breadcrumbs-inner">  
    <div class="<?php echo esc_attr($header_width);?>">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
            
            <h1 class="page-title">
                <?php    
                if(!empty($khelo_option['blog_title'])) { ?>
                <?php echo esc_html($khelo_option['blog_title']);?>
                <?php }
                else{
                 esc_html_e('Blog','khelo');
                }
                ?>
              </h1>
              <?php  if(function_exists('bcn_display')){?>
                    <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
              <?php } ?>        
          
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
?>  
</div>