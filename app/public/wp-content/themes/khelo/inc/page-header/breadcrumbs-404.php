<?php
  global $khelo_option;
  $header_trans = '';
    if(!empty($khelo_option['header_layout'])){  
               
        $header_style = $khelo_option['header_layout'];               
        if($header_style == 'style2'){       
            $header_trans = 'heads_trans';    
        }
    }

?>

<div class="rs-breadcrumbs  porfolio-details <?php echo esc_attr($header_trans);?>">
  <?php
  if(!empty($khelo_option['blog_banner_main']['url'])) { ?>
  <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($khelo_option['blog_banner_main']['url']);?>')">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner">
               <h1 class="page-title">
                <?php                       
                  esc_html_e( 'Error 404', 'khelo' );
                ?>                  
                </h1>
                 <?php  if(function_exists('bcn_display'))
                    {?>
                      <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                  <?php }
                ?>   
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php }
  else{   
  ?>
  <div class="rs-breadcrumbs-inner">  
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
            <h1 class="page-title">
              <?php esc_html_e( 'Error 404', 'khelo' );?>                  
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