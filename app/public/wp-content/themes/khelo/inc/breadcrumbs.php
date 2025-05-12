<?php
	if(is_page()){
		 get_template_part( 'inc/page-header/breadcrumbs' );
	}
	if(is_singular('club')){
		get_template_part( 'inc/page-header/breadcrumbs-club' );
	}
	
	if(is_singular('players')){
		get_template_part( 'inc/page-header/breadcrumbs-team');
	}
	if(is_singular('fixture-results')){
		get_template_part( 'inc/page-header/breadcrumbs-single-result');
	}
	if(is_singular('post')){
		get_template_part( 'inc/page-header/breadcrumbs-single' );
	}
	if(is_home() && !is_front_page() || is_home() && is_front_page()){
		get_template_part( 'inc/page-header/breadcrumbs-blog' );
	}
	if(is_archive()){	
		if ( class_exists( 'WooCommerce' ) ) {	
			if(is_shop() || is_product_category() || is_product_tag()){	
						
			}
			else{
				get_template_part( 'inc/page-header/breadcrumbs-archive');
			}	
		}else{
			get_template_part( 'inc/page-header/breadcrumbs-archive');
		}	
	}	
	if( is_singular('club_news')){
		get_template_part( 'inc/page-header/breadcrumbs-club-new' );
	}

?>