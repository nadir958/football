<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $khelo_option;

require get_parent_theme_file_path('inc/page-header/breadcrumbs-shop.php');
// Layout class



$khelo_layout_class = 'col-sm-12 col-xs-12';

if(!empty( $khelo_option['shop-layout'])) {
	if ( !empty($khelo_option['shop-layout']) && $khelo_option['shop-layout'] == 'full' ) {
		$khelo_layout_class = 'col-sm-12 col-xs-12';
	}
	elseif( $khelo_option['shop-layout'] == 'left-col' || $khelo_option['shop-layout'] == 'right-col'){
		$khelo_layout_class = 'col-md-8 col-xs-12';
	}
	else{
		$khelo_layout_class = 'col-sm-12 col-xs-12';
	}
}
?>
<div class="container">
	<div id="content" class="site-content">		
		<div class="row">
			<?php
				if(!empty($khelo_option['disable-sidebar']) && is_product()){
					?>
					<div class="col-sm-12 col-xs-12">
					    <?php					
							woocommerce_content();						
						?>
					</div>
					<?php
				}else{				
					if ( !empty($khelo_option['shop-layout']) && $khelo_option['shop-layout'] == 'left-col'  ) {
						get_sidebar('woocommerce');
					}
					?>    			
				    <div class="<?php echo esc_attr($khelo_layout_class);?>">
					    <?php					
							woocommerce_content();						
		   				 ?>
				    </div>
					<?php
					if ( ( !empty($khelo_option['shop-layout']) && $khelo_option['shop-layout'] == 'right-col'  )  ) {
						get_sidebar('woocommerce');
					}	
				}
			?>
		</div>
	</div>
</div>
<?php
get_footer();

