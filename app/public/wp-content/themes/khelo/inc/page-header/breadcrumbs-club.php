<?php
    global $khelo_option;  

    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = $khelo_option['header-grid'];
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>
<?php $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true); ?>
<?php $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true); ?>


<div class="rs-breadcrumbs  porfolio-details">
<?php if($post_meta_data !='') { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $post_meta_data );?>')">
        <div class="<?php echo esc_attr($header_width);?>">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                    <h1 class="page-title">
                        <?php the_title();?>
                    </h1>
                    <?php }
                ?>  

                  
              </div>
            </div>             
          </div>
        </div>
    </div>
<?php } else{?>
    <div class="rs-breadcrumbs-inner">
          <div class="<?php echo esc_attr($header_width);?>">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                        <h1 class="page-title">
                            <?php the_title();?>
                        </h1>
                    <?php } 
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if($rs_breadcrumbs != 'hide' && function_exists('bcn_display') ): 
                        ?>
                        <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                    <?php                        
                        endif;
                    ?>    
         
                </div>
              </div>
            </div>
          </div>
    </div>
<?php } ?>
</div>