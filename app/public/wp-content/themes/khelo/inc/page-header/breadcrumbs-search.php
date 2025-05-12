
<?php 
global $khelo_option;
if(!empty($khelo_option['blog_banner_main']['url'])) { ?>
  <div class="rs-breadcrumbs  porfolio-details">
    <div class="breadcrumbs-single porfolio-details" style="background-image: url('<?php echo esc_url($khelo_option['blog_banner_main']['url']);?>')">
    <div class="rs-breadcrumbs-inner">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="breadcrumbs-inner">
              <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'khelo' ), '<span>' . get_search_query() . '</span>' ); ?></h1>             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else{
  ?>
  <div class="rs-breadcrumbs  porfolio-details">  
  <div class="rs-breadcrumbs-inner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner">
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'khelo' ), '<span>' . get_search_query() . '</span>' ); ?></h1>             
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php
}