<?php
    global $khelo_option;    
    $header_width_meta = get_query_var(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = !empty($khelo_option['header-grid']) ? $khelo_option['header-grid'] : '';
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>

<?php
  $header_trans = '';
    if(!empty($khelo_option['header_layout'])){                 
        $header_style = $khelo_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }
?>

<?php $post_menu_type = get_query_var(get_the_ID(), 'menu-type', true); ?>

<div class="rs-breadcrumbs  porfolio-details <?php echo esc_attr($header_trans);?>">
    <?php   
      if(!empty($khelo_option['shop_banner']['url'])){ 
         $shop_banner = $khelo_option['shop_banner']['url'];?>
        <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $shop_banner );?>')">   
            <div class="<?php echo esc_attr($header_width);?>">
              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">            
                    <h1 class="page-title"><?php woocommerce_page_title();?></h1>
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
                    <?php woocommerce_page_title();?>
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