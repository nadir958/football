<?php
/*
Dynamic css file. please don't edit it. it's update automatically when settins changed
*/
add_action('wp_head', 'khelo_custom_colors', 160);

function khelo_custom_colors() { 
global $khelo_option;	

/***styling options
------------------*/
	if(!empty($khelo_option['body_bg_color']))
	{
	 $body_bg         = $khelo_option['body_bg_color'];
		
	$body_color       = $khelo_option['body_text_color'];	
	$site_color       = $khelo_option['primary_color'];
	$secondary_color  = $khelo_option['secondary_color'];
	$link_color       = $khelo_option['link_text_color'];	
	$link_hover_color = $khelo_option['link_hover_text_color'];	
	$footer_bgcolor   = $khelo_option['footer_bg_color'];

	if(!empty($khelo_option['menu_text_color'])){		
		$menu_text_color         = $khelo_option['menu_text_color'];
	}
	if(!empty($khelo_option['menu_text_hover_color'])){		
		$menu_text_hover_color   = $khelo_option['menu_text_hover_color'];
	}
	if(!empty($khelo_option['menu_text_active_color'])){		
		$menu_active_color       = $khelo_option['menu_text_active_color'];
	}
	
	if(!empty($khelo_option['menu_text_hover_bg'])){		
		$menu_text_hover_bg      = $khelo_option['menu_text_hover_bg'];
	}
	if(!empty($khelo_option['menu_text_active_bg'])){		
		$menu_text_active_bg     = $khelo_option['menu_text_active_bg'];
	}
	
	if(!empty($khelo_option['drop_text_color'])){		
		$dropdown_text_color     = $khelo_option['drop_text_color'];
	}
	
	if(!empty($khelo_option['drop_text_hover_color'])){		
		$drop_text_hover_color   = $khelo_option['drop_text_hover_color'];
	}			
	
	if(!empty($khelo_option['drop_text_hoverbg_color'])){		
		$drop_text_hoverbg_color = $khelo_option['drop_text_hoverbg_color'];
	}
	
	if(!empty($khelo_option['drop_down_bg_color'])){		
		$drop_down_bg_color = $khelo_option['drop_down_bg_color'];
	}	
	
	$rs_top_style = get_post_meta(get_the_ID(), 'topbar-color', true);
    if($rs_top_style =='toplight' || $rs_top_style==''){
		$toolbar_bg    = $khelo_option['toolbar_bg_color'];
		$toolbar_text  = $khelo_option['toolbar_text_color'];
		$toolbar_link  = $khelo_option['toolbar_link_color'];
		$toolbar_hover = $khelo_option['toolbar_link_hover_color'];
	} else{
		$toolbar_bg    = $khelo_option['toolbar_bg_color2'];
		$toolbar_text  = $khelo_option['toolbar_text_color2'];
		$toolbar_link  = $khelo_option['toolbar_link_color2'];
		$toolbar_hover = $khelo_option['toolbar_link_hover_color2'];
    }

	//typography extract for body
	
	if(!empty($khelo_option['opt-typography-body']['color']))
	{
		$body_typography_color=$khelo_option['opt-typography-body']['color'];
	}
	if(!empty($khelo_option['opt-typography-body']['line-height']))
	{
		$body_typography_lineheight=$khelo_option['opt-typography-body']['line-height'];
	}
		
	$body_typography_font      =$khelo_option['opt-typography-body']['font-family'];
	$body_typography_font_size =$khelo_option['opt-typography-body']['font-size'];

	//typography extract for menu
	$menu_typography_color       =$khelo_option['opt-typography-menu']['color'];	
	$menu_typography_weight      =$khelo_option['opt-typography-menu']['font-weight'];	
	$menu_typography_font_family =$khelo_option['opt-typography-menu']['font-family'];
	$menu_typography_font_fsize  =$khelo_option['opt-typography-menu']['font-size'];
		
	if(!empty($khelo_option['opt-typography-menu']['line-height']))
	{
		$menu_typography_line_height=$khelo_option['opt-typography-menu']['line-height'];
	}
	
	//typography extract for heading
	
	$h1_typography_color=$khelo_option['opt-typography-h1']['color'];		
	if(!empty($khelo_option['opt-typography-h1']['font-weight']))
	{
		$h1_typography_weight=$khelo_option['opt-typography-h1']['font-weight'];
	}
		
	$h1_typography_font_family=$khelo_option['opt-typography-h1']['font-family'];
	$h1_typography_font_fsize=$khelo_option['opt-typography-h1']['font-size'];	
	if(!empty($khelo_option['opt-typography-h1']['line-height']))
	{
		$h1_typography_line_height=$khelo_option['opt-typography-h1']['line-height'];
	}
	
	$h2_typography_color=$khelo_option['opt-typography-h2']['color'];	

	$h2_typography_font_fsize=$khelo_option['opt-typography-h2']['font-size'];	
	if(!empty($khelo_option['opt-typography-h2']['font-weight']))
	{
		$h2_typography_font_weight =$khelo_option['opt-typography-h2']['font-weight'];
	}	
	$h2_typography_font_family =$khelo_option['opt-typography-h2']['font-family'];
	$h2_typography_font_fsize  =$khelo_option['opt-typography-h2']['font-size'];	
	if(!empty($khelo_option['opt-typography-h2']['line-height']))
	{
		$h2_typography_line_height=$khelo_option['opt-typography-h2']['line-height'];
	}
	
	$h3_typography_color=$khelo_option['opt-typography-h3']['color'];	
	if(!empty($khelo_option['opt-typography-h3']['font-weight']))
	{
		$h3_typography_font_weight=$khelo_option['opt-typography-h3']['font-weight'];
	}	
	$h3_typography_font_family =$khelo_option['opt-typography-h3']['font-family'];
	$h3_typography_font_fsize  =$khelo_option['opt-typography-h3']['font-size'];	
	if(!empty($khelo_option['opt-typography-h3']['line-height']))
	{
		$h3_typography_line_height=$khelo_option['opt-typography-h3']['line-height'];
	}

	$h4_typography_color=$khelo_option['opt-typography-h4']['color'];	
	if(!empty($khelo_option['opt-typography-h4']['font-weight']))
	{
		$h4_typography_font_weight=$khelo_option['opt-typography-h4']['font-weight'];
	}	
	$h4_typography_font_family=$khelo_option['opt-typography-h4']['font-family'];
	$h4_typography_font_fsize=$khelo_option['opt-typography-h4']['font-size'];	
	if(!empty($khelo_option['opt-typography-h4']['line-height']))
	{
		$h4_typography_line_height=$khelo_option['opt-typography-h4']['line-height'];
	}
	
	$h5_typography_color=$khelo_option['opt-typography-h5']['color'];	
	if(!empty($khelo_option['opt-typography-h5']['font-weight']))
	{
		$h5_typography_font_weight=$khelo_option['opt-typography-h5']['font-weight'];
	}	
	$h5_typography_font_family=$khelo_option['opt-typography-h5']['font-family'];
	$h5_typography_font_fsize=$khelo_option['opt-typography-h5']['font-size'];	
	if(!empty($khelo_option['opt-typography-h5']['line-height']))
	{
		$h5_typography_line_height=$khelo_option['opt-typography-h5']['line-height'];
	}
	
	$h6_typography_color=$khelo_option['opt-typography-6']['color'];	
	if(!empty($khelo_option['opt-typography-6']['font-weight']))
	{
		$h6_typography_font_weight=$khelo_option['opt-typography-6']['font-weight'];
	}
	$h6_typography_font_family=$khelo_option['opt-typography-6']['font-family'];
	$h6_typography_font_fsize=$khelo_option['opt-typography-6']['font-size'];	
	if(!empty($khelo_option['opt-typography-6']['line-height']))
	{
		$h6_typography_line_height=$khelo_option['opt-typography-6']['line-height'];
	}
	
?>

<!-- Typography -->
<?php if(!empty($body_color)){
	global $khelo_option;
	$hex             = $site_color;
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$site_color_rgb  = "$r, $g, $b";

	$hex1            = $secondary_color;
	list($r, $g, $b) = sscanf($hex1, "#%02x%02x%02x");
	$site_color_rgb1  = "$r, $g, $b";
?>


<style>

	.rs-latest-news .latest-news-grid .featured-news-grid .news-info:after,
	.rs-latest-news .news-list-item .news-info-list:after{
		background-image: linear-gradient(to top, rgba(<?php echo wp_kses_post($site_color_rgb1); ?>, 0.85) 30%, rgba(255, 255, 255, 0) 70%);
	    background-image: -webkit-linear-gradient(to top, rgba(<?php echo wp_kses_post($site_color_rgb1); ?>, 0.85) 30%, rgba(255, 255, 255, 0) 70%);
	    background-image: -moz-linear-gradient(to top, rgba(<?php echo wp_kses_post($site_color_rgb1); ?>, 0.85) 30%, rgba(255, 255, 255, 0) 70%);
	    background-image: -ms-linear-gradient(to top, rgba(<?php echo wp_kses_post($site_color_rgb1); ?>, 0.85) 30%, rgba(255, 255, 255, 0) 70%);
	    background-image: -o-linear-gradient(to top, rgba(<?php echo wp_kses_post($site_color_rgb1); ?>, 0.85) 30%, rgba(255, 255, 255, 0) 70%);
	}


	<?php 

		$rspage_subscribe_style = get_post_meta(get_the_ID(), 'subscribe_bg_img', true);

		if(!empty($rspage_subscribe_style)){ ?>
			.rs-footer .newsletter-footer .newsletter-inner{
				background: url(<?php echo esc_url($rspage_subscribe_style);?>) no-repeat center top;

			}
	<?php }

	 if(!empty($khelo_option['copyright_bg']))
	{	
	?>
		.footer-bottom{
				background:<?php echo esc_attr($khelo_option['copyright_bg']); ?> !important;
		}
	<?php } ?>
	
	body{
		background:<?php echo esc_attr($body_bg); ?> !important;
		color:<?php echo esc_attr($body_color); ?> !important;
		font-family: <?php echo esc_attr($body_typography_font);?> !important;    
	    font-size: <?php echo esc_attr($body_typography_font_size);?> !important;	
	}
	.services-style-5 .services-item{
		box-shadow: 0 0 0 20px rgba(<?php echo esc_attr($site_color_rgb);?>, 0.4), inset 0 0 3px rgba(255, 255, 255, 0.2);
	}		
	h1{
		color:<?php echo esc_attr($h1_typography_color);?> !important;
		font-family:<?php echo esc_attr($h1_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h1_typography_font_fsize);?>!important;
		<?php if(!empty($h1_typography_weight)){
		?>
		font-weight:<?php echo esc_attr($h1_typography_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h1_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h1_typography_line_height);?>!important;
		<?php }?>		
	}
	h2{
		color:<?php echo esc_attr($h2_typography_color);?>; 
		font-family:<?php echo esc_attr($h2_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h2_typography_font_fsize);?>;
		<?php if(!empty($h2_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h2_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h2_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h2_typography_line_height);?>
		<?php }?>
	}
	h3{
		color:<?php echo esc_attr($h3_typography_color);?> ;
		font-family:<?php echo esc_attr($h3_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h3_typography_font_fsize);?>;
		<?php if(!empty($h3_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h3_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h3_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h3_typography_line_height);?>!important;
		<?php }?>
	}
	h4{
		color:<?php echo esc_attr($h4_typography_color);?>;
		font-family:<?php echo esc_attr($h4_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h4_typography_font_fsize);?>;
		<?php if(!empty($h4_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h4_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h4_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h4_typography_line_height);?>!important;
		<?php }?>
		
	}
	h5{
		color:<?php echo esc_attr($h5_typography_color);?>;
		font-family:<?php echo esc_attr($h5_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h5_typography_font_fsize);?>;
		<?php if(!empty($h5_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h5_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h5_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h5_typography_line_height);?>!important;
		<?php }?>
	}
	h6{
		color:<?php echo esc_attr($h6_typography_color);?> ;
		font-family:<?php echo esc_attr($h6_typography_font_family);?>!important;
		font-size:<?php echo esc_attr($h6_typography_font_fsize);?>;
		<?php if(!empty($h6_typography_font_weight)){
		?>
		font-weight:<?php echo esc_attr($h6_typography_font_weight);?>!important;
		<?php }?>
		
		<?php if(!empty($h6_typography_line_height)){
		?>
			line-height:<?php echo esc_attr($h6_typography_line_height);?>!important;
		<?php }?>
	}


	.menu-area .navbar ul li > a{
		font-weight:<?php echo esc_attr($menu_typography_weight); ?>;
		font-family:<?php echo esc_attr($menu_typography_font_family); ?>;
		font-size: <?php echo esc_attr($menu_typography_font_fsize);?> !important;	
	}

	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li,
	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li i,
	#rs-header .toolbar-area .toolbar-contact ul li, #rs-header .toolbar-area{
		color:<?php echo esc_attr($toolbar_text); ?>;
	}


	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li a,
	#rs-header .toolbar-area .toolbar-contact ul li a,
	.menu-cart-area i,
	#rs-header .toolbar-area .toolbar-sl-share ul li a i{
		color:<?php echo esc_attr($toolbar_link); ?>;
	}

	#rs-header .toolbar-area .toolbar-contact ul.rs-contact-info li a:hover,
	#rs-header .toolbar-area .toolbar-contact ul li a:hover, 
	#rs-header .toolbar-area .toolbar-sl-share ul li a i:hover{
		color:<?php echo esc_attr($toolbar_hover); ?>;
	}
	#rs-header .toolbar-area,  .header-style4 .menu-sticky{
		background:<?php echo esc_attr($toolbar_bg); ?>;
	}

	
	.mobile-menu-container div ul > li.current_page_parent > a,
	#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor a, 
	#rs-header.header-transparent .menu-area .navbar ul li.current_page_item a,
	.menu-area .navbar ul.menu > li.current_page_item > a,
	#rs-header.single-header.single-headers .menu-area .navbar ul > li.active a,
	#rs-header.header-style5 .header-inner .menu-area .navbar ul > li.current-menu-ancestor > a,
	#rs-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
	#rs-header.header-style-4 .menu-area .menu > li.current-menu-ancestor > a
	{
		color: <?php echo esc_attr( $menu_active_color ); ?> !important;
	}

	
	.menu-area .navbar ul li:hover > a,	
	.mobile-menu-container div ul li a:hover,	
	#rs-header.header-style5 .menu-cart-area i:hover,
	#rs-header.header-style4 .menu-cart-area i:hover,
	#rs-header.header-style4 .menu-responsive .sidebarmenu-search .sticky_search:hover,
	#rs-header.header-style5 .menu-responsive .sidebarmenu-search .sticky_search:hover,
	#rs-header.header-style5 .header-inner .menu-area .navbar ul li:hover > a,
	#rs-header.header-style5 .header-inner.menu-sticky.sticky .menu-area .navbar ul li:hover > a,
	#rs-header.header-style-4 .menu-area .menu li:hover > a
	{
		color: <?php echo esc_attr( $menu_text_hover_color ); ?>;
	}
	
	#rs-header.header-style5 .nav-link-container .nav-menu-link:hover span,
	#rs-header.header-style4 .nav-link-container .nav-menu-link:hover span{
		background: <?php echo esc_attr( $menu_text_hover_color ); ?> !important;
	}

	.menu-area .navbar ul li a,
	#rs-header .menu-responsive .sidebarmenu-search .sticky_search,
	#rs-header.header-transparent .menu-area.dark .menu-cart-area i

	{
		color: <?php echo esc_attr( $menu_text_color ); ?>; 
	}

	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li.current_page_item > a::before, 
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a::before,
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a::after,
	#rs-header.header-transparent .menu-area.dark .navbar ul.menu > li > a,	
	#rs-header.header-transparent .menu-area.dark .menu-responsive .sidebarmenu-search .sticky_search .fa
	{
		color: <?php echo esc_attr( $menu_text_color ); ?> !important;
	}

	
	#rs-header.header-transparent .menu-area.dark ul.offcanvas-icon .nav-link-container .nav-menu-link span{
		background: <?php echo esc_attr( $menu_text_color ); ?> !important;
	}



	<?php if(!empty($khelo_option['transparent_menu_text_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul li a,
		#rs-header .menu-cart-area span.icon-num,
		#rs-header .menu-cart-area i,
		#rs-header.header-transparent .menu-responsive .sidebarmenu-search .sticky_search,
		#rs-header.header-transparent .menu-responsive .sidebarmenu-search .sticky_search .fa,
		#rs-header.header-transparent .menu-area.dark .navbar ul > li > a,
		#rs-header.header-style5 .header-inner .menu-area .navbar ul li a,
		#rs-header.header-transparent .menu-area .navbar ul li:hover > a,
		#rs-header.header-style5 .menu-responsive .sidebarmenu-search .sticky_search,
		#rs-header.header-style5 .menu-cart-area i{
			color:<?php echo esc_attr($khelo_option['transparent_menu_text_color']); ?> 
	}
	<?php endif; ?>


	<?php if(!empty($khelo_option['menu_area_bg_color'])) : ?>
		#rs-header.header-style5 .header-inner .menu-area, 
		.menu-area{
		background:<?php echo esc_attr($khelo_option['menu_area_bg_color']); ?> 
	}
	<?php endif; ?>	





	<?php if(!empty($khelo_option['drop_bg_hover_color'])) : ?>
		.menu-area .navbar ul li .sub-menu li a:hover,
		.menu-area .navbar ul li ul.sub-menu li.current_page_item > a{
			background:<?php echo esc_attr($khelo_option['drop_bg_hover_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['drop_border_color'])) : ?>
		.menu-area .navbar ul li ul.sub-menu li a,
		#rs-header .menu-area .navbar ul > li.mega > ul li ul li a{
			border-color:<?php echo esc_attr($khelo_option['drop_border_color']); ?> 
		}
	<?php endif; ?>

		
	<?php if(!empty($khelo_option['preloader_text_color'])) : ?>
		.cssload-loader .cssload-dot, .cssload-loader .cssload-dotb{
			background: <?php echo esc_attr($khelo_option['preloader_text_color']); ?> !important; 
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['preloader_bg_color'])) : ?>
		.loading{
			background: <?php echo esc_attr($khelo_option['preloader_bg_color']); ?> !important;  
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['transparent_menu_text_color'])) : ?>
		#rs-header.header-transparent .menu-area.dark ul.offcanvas-icon .nav-link-container .nav-menu-link span{
			background:<?php echo esc_attr($khelo_option['transparent_menu_text_color']); ?> 
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['transparent_menu_hover_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul > li > a:hover,
		#rs-header.header-transparent .menu-area .navbar ul li:hover > a,
		#rs-header.header-transparent .menu-area.dark .navbar ul > li:hover > a{
			color:<?php echo esc_attr($khelo_option['transparent_menu_hover_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['transparent_menu_hover_color'])) : ?>
		#rs-header .menu-sticky.sticky .menu-area .navbar ul li a:hover{
			color:<?php echo esc_attr($khelo_option['transparent_menu_hover_color']); ?>  !important;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['transparent_menu_active_color'])) : ?>
		#rs-header.header-transparent .menu-area .navbar ul > li.current_page_item > a,
		#rs-header.header-transparent .menu-area .navbar ul > li.current-menu-ancestor > a,
		#rs-header.header-style-4 .menu-area .menu > li.current_page_item > a{
			color:<?php echo esc_attr($khelo_option['transparent_menu_active_color']); ?> !important; 
		}
	<?php endif; ?>

	#rs-header.header-transparent .menu-area .navbar ul.menu > li.current_page_item > a::before,	
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li.current_page_item > a::before, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.menu > li > a::after,
	#rs-header.header-transparent .menu-area .navbar ul.menu > li.current_page_item > a::after, 
	#rs-header.header-transparent .menu-area .navbar ul.menu > li > a::after{
		color:<?php echo esc_attr($khelo_option['transparent_menu_active_color']); ?> !important; 
	}
	#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul:not(.sub-menu) > li.current-menu-ancestor > a{
		color:<?php echo esc_attr($khelo_option['transparent_menu_active_color']); ?> !important;
	}

	<?php if(!empty($khelo_option['transparent_menu_text_color'])) : ?>		
		#rs-header.header-transparent ul.offcanvas-icon .nav-link-container .nav-menu-link span,
		#rs-header.header-style5 .menu-responsive ul.offcanvas-icon .nav-link-container .nav-menu-link span{
			background:<?php echo esc_attr($khelo_option['transparent_menu_text_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['drop_text_color'])) : ?>
		.menu-area .navbar ul li .sub-menu li a,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li a,
		#rs-header .menu-area .navbar ul li.mega ul li a,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a,
		#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a{
			color:<?php echo esc_attr($khelo_option['drop_text_color']); ?> !important;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['drop_text_hover_color'])) : ?>
		.menu-area .navbar ul li ul.sub-menu li.current_page_item > a,
		.menu-area .navbar ul li .sub-menu li a:hover,
		#rs-header .menu-area .navbar ul li.mega ul li a:hover,
		.menu-area .navbar ul li ul.sub-menu li:hover > a,
		#rs-header.header-style5 .header-inner .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header.header-style-4 .menu-area .menu .sub-menu li:hover > a,
		#rs-header.header-style3 .menu-area .navbar ul li .sub-menu li:hover > a,
		#rs-header .menu-area .navbar ul li.mega ul li.current-menu-item a,
		.menu-sticky.sticky .menu-area .navbar ul li ul li a:hover,
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, 
		#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current_page_item > a,
		#rs-header.header-transparent .menu-area .navbar ul li.current-menu-ancestor li a:hover{
			color:<?php echo esc_attr($khelo_option['drop_text_hover_color']); ?> !important;
		}
	<?php endif; ?>



	<?php if(!empty($khelo_option['drop_down_bg_color'])) : ?>
		.menu-area .navbar ul li .sub-menu{
			background:<?php echo esc_attr($khelo_option['drop_down_bg_color']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['toolbar_text_size'])) : ?>
		#rs-header .toolbar-area .toolbar-contact ul li,
		#rs-header .toolbar-area .toolbar-sl-share ul li a i:before{
			font-size:<?php echo esc_attr($khelo_option['toolbar_text_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['menu_text_trasform'])) : ?>
		.menu-area .navbar ul > li > a,
		#rs-header .menu-area .navbar ul > li.mega > ul > li > a{
			text-transform:uppercase;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['mobile_menu_icon_color'])){ ?>
		.nav-link-container.mobile-menu-link .nav-menu-link span{			
			background: <?php echo esc_attr($khelo_option['mobile_menu_icon_color']) ;?>;
		}
	<?php } ?>

	<?php if(!empty($khelo_option['mobile_menu_container_bg'])){ ?>
		.sidenav{	
			background: <?php echo esc_attr($khelo_option['mobile_menu_container_bg']) ;?> !important;
		}
	<?php } ?>

	<?php if(!empty($khelo_option['mobile_menu_text_color'])){ ?>
		.mobile-menu-container ul li a{	
			color: <?php echo esc_attr($khelo_option['mobile_menu_text_color']) ;?>;
		}
	<?php } ?>

	<?php if(!empty($khelo_option['mobile_menu_text_hover_color'])){ ?>
		.mobile-menu-container ul li a:hover{	
			color: <?php echo esc_attr($khelo_option['mobile_menu_text_hover_color']) ;?>;
		}
		.sidenav .nav-close-menu-li button,
		.sidenav .nav-close-menu-li button:after,
		.sidenav .nav-close-menu-li button:before{
			border-color: <?php echo esc_attr($khelo_option['mobile_menu_text_hover_color']) ;?> !important;
		}

		.sidenav .nav-close-menu-li button:after,
		.sidenav .nav-close-menu-li button:before{
			background-color: <?php echo esc_attr($khelo_option['mobile_menu_text_hover_color']) ;?> !important;
		}

		.sidenav .nav-close-menu-li button:hover:after, 
		.sidenav .nav-close-menu-li button:hover:before{
			background-color: <?php echo esc_attr($khelo_option['mobile_menu_text_hover_color']) ;?> !important;
		}

		.sidenav .nav-close-menu-li button:hover{
			border-color:<?php echo esc_attr($khelo_option['mobile_menu_text_hover_color']) ;?> !important;
		}
	<?php } ?>

	<?php if(!empty($khelo_option['mobile_menu_text_active_color'])){ ?>
		.sidenav .menu-main-menu-container .menu li.current-menu-parent > a, 
		.sidenav .menu-main-menu-container .menu li.current-menu-item > a, 
		.sidenav .menu-main-menu-container .menu li.current-menu-parent > ul .current-menu-item > a,
		.sidenav .menu-main-menu-container .menu li.current-menu-ancestor > a{	
			color: <?php echo esc_attr($khelo_option['mobile_menu_text_active_color']) ;?> !important;
		}
	<?php } ?>
	<?php if(!empty($khelo_option['mobile_drop_text_border_color'])){ ?>
		.mobile-menu-container div ul li a{
			border-bottom-color: <?php echo esc_attr($khelo_option['mobile_drop_text_border_color']) ;?> !important;
		}
	<?php } ?>


	
	<?php if(!empty($khelo_option['news_subtitle'])) : ?>
		.rs-footer .newsletter-footer .newsletter-inner .widget_mc4wp_form_widget .mc4wp-form-fields p{
			font-size:<?php echo esc_attr($khelo_option['news_subtitle']); ?>;
		}
	<?php endif; ?>

<?php if(!empty($khelo_option['news_title'])) : ?>
		.rs-footer .newsletter-footer .newsletter-inner .widget_mc4wp_form_widget span{
			font-size:<?php echo esc_attr($khelo_option['news_title']); ?>;
		}
	<?php endif; ?>



	<?php if(!empty($khelo_option['copyright_bg_border'])) : ?>
		.footer-bottom .container{
			border-color:<?php echo esc_attr($khelo_option['copyright_bg_border']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['copyright_text_color'])) : ?>
		.footer-bottom .copyright p{
			color:<?php echo esc_attr($khelo_option['copyright_text_color']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['footer_text_size'])) : ?>
		.rs-footer, .rs-footer h3, .rs-footer a, 
		.rs-footer .fa-ul li a, 
		.rs-footer .widget.widget_nav_menu ul li a,
		.rs-footer .widget ul li .fa{
			font-size:<?php echo esc_attr($khelo_option['footer_text_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['footer_h3_size'])) : ?>
		.rs-footer h3, .rs-footer .footer-top h3.footer-title{
			font-size:<?php echo esc_attr($khelo_option['footer_h3_size']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['footer_link_size'])) : ?>
		.rs-footer a{
			font-size:<?php echo esc_attr($khelo_option['footer_link_size']); ?>;
		}
	<?php endif; ?>	

	<?php if(!empty($khelo_option['footer_text_color'])) : ?>
		.rs-footer, .rs-footer h3, .rs-footer a, .rs-footer .fa-ul li a, .rs-footer .widget ul li .fa{
			color:<?php echo esc_attr($khelo_option['footer_text_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['footer_link_color'])) : ?>
		.rs-footer a:hover, .rs-footer .widget.widget_nav_menu ul li a:hover,
		.rs-footer .fa-ul li a:hover{
			color:<?php echo esc_attr($khelo_option['footer_link_color']); ?>;
		}
	<?php endif; ?>



	<?php if(!empty($khelo_option['footer_input_bg_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]{
			background:<?php echo esc_attr($khelo_option['footer_input_bg_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['footer_input_hover_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]:hover{
			background:<?php echo esc_attr($khelo_option['footer_input_hover_color']); ?>;
		}
	<?php endif; ?>
	
	<?php if(!empty($khelo_option['footer_input_border_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="email"],
		ul.footer_social li a{
			border-color:<?php echo esc_attr($khelo_option['footer_input_border_color']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['footer_input_text_color'])) : ?>
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]
		{
			color:<?php echo esc_attr($khelo_option['footer_input_text_color']); ?>;
		}
	<?php endif; ?>


	.rs-heading .title-inner .sub-text,
	.team-grid-style1 .team-item .team-content1 h3.team-name a:hover, .team-slider-style1 .team-item .team-content1 h3.team-name a:hover,
	.rs-services-default .services-wrap .services-item .services-icon i,	
	.rs-blog .blog-item .blog-slidermeta span.category a:hover,
	.btm-cate li a:hover,	
	.ps-navigation ul a:hover span,
	.rs-blog .blog-item .blog-meta .categories a:hover,
	.bs-sidebar ul a:hover,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a:hover,
	.rs-contact .contact-address .address-item .address-text a:hover,
	.rs-portfolio-style5 .portfolio-item .portfolio-content a,
	.rs-portfolio-style5 .portfolio-item .portfolio-content h4 a:hover,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.rs-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.rs-portfolio.style2 .portfolio-slider .portfolio-item:hover .portfolio-content h3.p-title a,
	.rs-portfolio.style2 .portfolio-slider .portfolio-item .portfolio-img .portfolio-content .categories a:hover,
	.portfolio-filter button:hover, .portfolio-filter button.active,
	.rs-galleys .galley-img .zoom-icon:hover,
	.sidenav .fa-ul li a:hover,
	#about-history-tabs ul.tabs-list_content li:before,
	#rs-header.header-style-3 .header-inner .logo-section .toolbar-contact-style4 ul li i,
	.rs-service-grid.rs-service-stylestyle4 .service-item-four .service-content h3,
	.rs-team-grid.team-style5 .team-item .normal-text a:hover,
	#sidebar-services .widget.widget_nav_menu ul li.current-menu-item a,
	#sidebar-services .widget.widget_nav_menu ul li a:hover,
	.single-teams .team-inner ul li i,
	.primaryColor,
	#rs-blog-tab-slider .item-thumb .owl-dot.active h5.overlay-feature-title, 
	#rs-blog-tab-slider .item-thumb .owl-dot:hover h5.overlay-feature-title,
	.club-details_data .squad-list-item .jersy,
	.club-details_data .squad-list-item .name a:hover,
	.club-details_data .champion-inner .award-wrap .champion-details .champion-no,
	.rs-team-grid.team-style5 .team-item .normal-text .squad-numbers{
		color:<?php echo esc_attr($site_color); ?>;
	}
	.rs-result-style-2 .sidebar-result .list-result span.total-goal,
	#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current-menu-ancestor > a, 
	#rs-header.header-transparent .menu-area .navbar ul li .sub-menu li.current_page_item > a,
	.match-list .match-table tr td:nth-child(2n){
		color:<?php echo esc_attr($site_color); ?>;
	}

	#cl-testimonial .testimonial-slide7 .single-testimonial:after, #cl-testimonial .testimonial-slide7 .single-testimonial:before{
		border-right-color: <?php echo esc_attr($secondary_color); ?>;
		border-right: 30px solid <?php echo esc_attr($secondary_color); ?>;
	}
	#cl-testimonial .testimonial-slide7 .single-testimonial{
		border-left-color: <?php echo esc_attr($secondary_color); ?>;
	}
	.team-grid-style2 .appointment-bottom-area .app_details a:hover, 
	.team-slider-style2 .appointment-bottom-area .app_details a:hover, 
	.team-grid-style2 .appointment-bottom-area .app_btn a:hover, 
	.team-slider-style2 .appointment-bottom-area .app_btn a:hover,
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec .team-social a:hover i,
	.club-sidebar strong{
		color:<?php echo esc_attr($secondary_color); ?>;
	}

	.ps-navigation ul a:hover span,
	.home-appointment > .vc_column-inner input[type="submit"], 
	.home-appointment > .vc_column-inner i,	
	ul.chevron-right-icon li:before,
	.rs-filter-posts .portfolio-filter button.active, 
	.rs-filter-posts .portfolio-filter button:hover, 
	.rs-filter-posts .portfolio-filters button.active, 
	.rs-filter-posts .portfolio-filters button:hover,
	.home3-upcome .umatch-matches div span.date2, 
	.home3-upcome .umatch-matches div span.vs,
	.woocommerce-message::before, .woocommerce-info::before{
		color:<?php echo esc_attr($site_color); ?> !important;
	}
	
	ul.footer_social li a:hover,	
	#cl-testimonial .testimonial-slide7 ul.slick-dots li.slick-active button,
	html input[type="button"]:hover, input[type="reset"]:hover,
	.rs-video-2 .popup-videos:before,
	.sidenav .widget-title:before,
	.rs-team-grid.team-style5 .team-item .team-content,
	.rs-team-grid.team-style4 .team-wrapper .team_desc::before,
	.rs-team .team-item .team-social .social-icon,	
	.team-grid-style1 .team-item .social-icons1 a:hover i,
	.loader__bar,
	.rs-blog-grid .blog-img a.float-cat,
	#sidebar-services .download-btn ul li,
	.transparent-btn:hover,
	.rs-filter-posts .portfolio-filter .default-title, 
	.rs-filter-posts .portfolio-filters .default-title,
	.rs-filter-posts .portfolio-filter .default-title::before, 
	.rs-filter-posts .portfolio-filters .default-title::before,
	rs-filter-posts .portfolio-filter .default-title::after, 
	.rs-filter-posts .portfolio-filters .default-title::after,
	#rs-header.header-style-4 .menu-area,
	.rs-heading.style6 .title-inner .title:after,
	.rs-countdown .sports-grid .event_counter6_grig2 .display-table .time_circles div:before,
	.rs-blog-grid.rs-blog .rsb-style4.style4 .blog-img .blog-dates a.float-cats,
	#rs-filter-post .grid-item .galley-img .inner-content .c-txt .category,
	.team-grid-style2 .team-item-wrap .team-img .normal-text, 
	.team-slider-style2 .team-item-wrap .team-img .normal-text,
	.rs-portfolio-style2 .portfolio-item .portfolio-img .read_more:hover,
	.rs-galleys .galley-img .p-title{
		background:<?php echo esc_attr($site_color); ?> !important;
	}

	.match-list.sidebar-style a,
	.rs-club-list.style2 .link a,
	.link-border a{
		border-color:<?php echo esc_attr($site_color); ?> !important;
	}
	.match-list.sidebar-style a:hover,
	.link-border a:hover{
		background:<?php echo esc_attr($site_color); ?>;
	}

	.match-list.sidebar-style a,
	.rs-club-list.style2 .link a,
	.link-border a{
		color:<?php echo esc_attr($site_color); ?>;
	}
	
	.heading_icon .title:before{
		border-left-color:<?php echo esc_attr($site_color); ?> !important;
	}

	.rs-services-style3 .bg-img a,
	.rs-services-style3 .bg-img a:hover{
		background:<?php echo esc_attr($secondary_color); ?>;
		border-color: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-service-grid .service-item .service-content .service-button .readon.rs_button:hover{
		border-color: <?php echo esc_attr($secondary_color); ?>;;
		color: <?php echo esc_attr($secondary_color); ?>;
	}


	.rs-service-grid .service-item .service-content .service-button .readon.rs_button:hover:before,
	.rs-heading.style6 .title-inner .sub-text,		
	.rs-heading.style7 .title-inner .sub-text{
		color: <?php echo esc_attr($secondary_color); ?>;
	}

	.woocommerce div.product p.price ins, 
	.woocommerce div.product span.price ins,
	.woocommerce ul.products li.product .price ins,
	.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price,.pagination-area .nav-links a.prev.page-numbers:hover,
	.today-match-teams.style3 .owl-nav .owl-prev:hover i:before,
	.today-match-teams.style3 .owl-nav .owl-next:hover i:before{
	color: <?php echo esc_attr($site_color); ?>!important;
}



	.rs-video-2 .popup-videos,
	.rs-calculate-valu .fitness-chart h3,
	.rs-calculate-valu .fitness-chart ul li,
	.home-appointment > .vc_column-inner,
	.footer-top-section .footer-share ul li a,
	.owl-dots .owl-dot.active,
	.rs-blog-details .blog-item.style2 .meta-date, .rs-blog .blog-item.style2 .meta-date, .blog .blog-item.style2 .meta-date,
	#cl-testimonial.owl-carousel .owl-dots button.active,
	.blog .rs-blog .blog-item .blog-img .blog-img-content .meta-date,
	.bs-sidebar ul.footer_social li a,
	.rs-blog-details #reply-title:before,
	.rs-calculate-valu .input-form .form-btn input,
	.rs-services-style4:hover .services-icon i,
	.team-slider-style4 .team-item .team-item-wrap .team-img .team-content-style4 .subtitle, .team-slider-style4 .team-item .team-item-wrap .team-img .team-content-style4 .team-name,
	.team-slider-style4 .team-item .team-item-wrap .team-img .team-content-style4 .designation,
	.team-slider-style4 .team-item .team-item-wrap .team-img .team-content-style4 .team-social-4 a:hover i,
	.rs-breadcrumbs .breadcrumbs, .team-slider-style2 .team-item-wrap .team-details,
	.rs-blog-details .blog-item.style2 .category a, .rs-blog .blog-item.style2 .category a, .blog .blog-item.style2 .category a,
	.rs-blog-details .blog-item.style1 .category a, .rs-blog .blog-item.style1 .category a, .blog .blog-item.style1 .category a{
		background:<?php echo esc_attr($site_color); ?>;
	}

	.rs-calculate-valu .input-form input, .rs-calculate-valu .input-form select,
	.staff-section li.rs-staff-area .staff-item .service-img img,
	.team-slider-style2 .team-item-wrap .team-item{
		border-color:<?php echo esc_attr($site_color); ?>;
	}

	.rs-breadcrumbs .breadcrumbs::before, .rs-breadcrumbs .breadcrumbs-title:before{
		border-left-color:<?php echo esc_attr($site_color); ?>;
	}

	.rs-popular-classes .single-classes .classes-content .title-bar a:hover,
	.single-post .single-content-full .bs-info .meta .category-name a:hover,
	.bs-sidebar .recent-post-widget .post-desc a:hover,
	.team-slider-style4 .team-item .team-item-wrap .team-img .team-content-style4 .team-social-4 a i,
	#rs-contact .contact-address .address-item .address-text a:hover,
	.single-club .match-slider-styles .fixture-item .top-date-sec .match-time,
	.footer-top-section #footer-menu li a:hover,
	.blog .rs-blog .blog-item .blog-img .blog-img-content .meta .category-name a:hover{
		color:<?php echo esc_attr($site_color); ?>;
	}

	.owl-carousel .owl-nav [class*="owl-"]:hover,
	.team-grid-style3 .team-img .team-img-sec:before,
	.sidenav .offcanvas_social li a i,
	#sidebar-services .bs-search button:hover, 
	.team-slider-style3 .team-img .team-img-sec:before,
	.rs-blog-details .blog-item.style2 .category a:hover, 
	.rs-blog .blog-item.style2 .category a:hover, 
	.blog .blog-item.style2 .category a:hover,
	.icon-button a:hover,
	.rs-blog-details .blog-item.style1 .category a:hover, 
	.rs-blog .blog-item.style1 .category a:hover, 
	.blog .blog-item.style1 .category a:hover,
	.icon-button a:hover,
	.rs-team-grid.team-style5 .team-item .normal-text:after,
	.team-grid-style2 .team-item-wrap .team-details, .team-slider-style2 .team-item-wrap .team-details,
	.page-error
	{
		background: <?php echo esc_attr($secondary_color); ?>;
	}

	.icon-button a,
	.team-grid-style1 .team-item .image-wrap .social-icons1, .team-slider-style1 .team-item .image-wrap .social-icons1,	
	.rs-heading.style8 .title-inner:after,
	.rs-heading.style8 .description:after,
	.rs-service-grid.rs-service-stylestyle4 .service-item-four:hover:before,
	#slider-form-area .form-area input[type="submit"],
	.services-style-5 .services-item:hover .services-title,
	#rs-skills .vc_progress_bar .vc_single_bar .vc_bar,
	#sidebar-services .rs-heading .title-inner h3:before,
	.woocommerce span.onsale,
	.course-image .course-cat a,
	#loading,
	.rs-popular-classes .single-classes .time-duration,
	.single-teams .ps-informations ul li.social-icon i:hover,
	#rs-contact .contact-address .address-item .address-icon::after,
	#rs-contact .contact-address .address-item .address-icon::before,
	#rs-contact .contact-address .address-item .address-icon,
	.bs-sidebar .widget-title:before{
		background:<?php echo esc_attr($site_color); ?>;
	}

	.team-grid-style2 .appointment-bottom-area .app_details, 
	.team-slider-style2 .appointment-bottom-area .app_details, 
	.team-grid-style2 .appointment-bottom-area .app_btn, 
	.team-slider-style2 .appointment-bottom-area .app_btn,
	ul.footer_social li a:hover,
	.transparent-btn:hover,	
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:after,
	#cl-testimonial .testimonial-slide7 ul.slick-dots li.slick-active button,
	.rs-portfolio-style2 .portfolio-item .portfolio-img .read_more:hover,
	.service-carousel .owl-dots .owl-dot.active,
	.service-carousel .owl-dots .owl-dot,
	.rs-popular-classes .single-classes .time-duration,
	.rs-footer.footerlight .footer-top .mc4wp-form-fields input[type="email"]{
		border-color:<?php echo esc_attr($site_color); ?> !important;
	}
	.round-shape:before{
		border-top-color: <?php echo esc_attr($site_color); ?>;
		border-left-color: <?php echo esc_attr($site_color); ?>;
	}
	.round-shape:after{
		border-bottom-color: <?php echo esc_attr($site_color); ?>;
		border-right-color: <?php echo esc_attr($site_color); ?>;
	}
	#cl-testimonial .testimonial-slide7 .testimonial-left img,
	#sidebar-services .wpb_widgetised_column{
		border-color:<?php echo esc_attr($secondary_color); ?>;
	}
	#sidebar-services .download-btn,
	.rs-video-2 .overly-border,	
	.single-teams .ps-informations ul li.social-icon i,
	.woocommerce-error, .woocommerce-info, .woocommerce-message{
		border-color:<?php echo esc_attr($site_color); ?> !important;
	}

	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:before,	
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial:after{
		border-right-color: <?php echo esc_attr($site_color); ?> !important;
		border-top-color: transparent !important;
	}

	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial{
		border-left-color:<?php echo esc_attr($site_color); ?> !important;
	}
	.rs-team-grid.team-style5 .team-item .normal-text .person-name a:hover,
	.full-blog-content .blog-title a:hover,
	.pagination-area .nav-links a:hover,
	.woocommerce ul.products li .woocommerce-loop-product__title a:hover,
	.rs-blog .blog-meta .blog-title a:hover,
	.team-grid-style2 .team-item-wrap .team-img .normal-text .team-name a:hover,	
	.rs-team-grid.team-style4 .team-wrapper .team_desc .name a,
	ul.stylelisting li:before, body .vc_tta-container .tab-style-left .vc_tta-tabs-container .vc_tta-tabs-list li a i,
	.rs-team-grid.team-style5 .team-item .normal-text .social-icons a:hover i,
	.today-match-teams.style3 .today-score .today-final-score .date i,
	.rs-porfolios-details .single-player-image .name .squad_no,
	.rs-porfolios-details .team-social-icons ul li a,
	.rs-porfolios-details .ps-informations ul li i:before,
	.rs-breadcrumbs .breadcrumbs span, .rs-breadcrumbs .breadcrumbs-title span,
	.footer-bottom .copyright a{
		color: <?php echo esc_attr($site_color); ?>;
	}


	#cl-testimonial .testimonial-slide7 .right-content i,
	.testimonial-light #cl-testimonial .testimonial-slide7 .single-testimonial .cl-author-info li:first-child,
	.rs-blog-details .bs-img .blog-date span.date, .rs-blog .bs-img .blog-date span.date, .blog .bs-img .blog-date span.date, .rs-blog-details .blog-img .blog-date span.date, .rs-blog .blog-img .blog-date span.date, .blog .blog-img .blog-date span.date,
	.rs-video-2 .popup-videos i,
	.rs-portfolio-style5 .portfolio-item .portfolio-content a,
	#cl-testimonial.cl-testimonial9 .single-testimonial .cl-author-info li,
	#cl-testimonial.cl-testimonial9 .single-testimonial .image-testimonial p i,
	.rs-video-2 .popup-videos i:before,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.rs-services1.services-right .services-wrap .services-item .services-icon i,
	#rs-skills .vc_progress_bar h2,
	.bs-sidebar .bs-search button:hover,
	ul.footer_social li a:hover,
	.single-club .match-slider-styles .fixture-item .top-date-sec .match-date,
	#rs-services-slider .menu-carousel .heading-block h4 a:hover,
	.rs-team-grid.team-style5 .team-item .normal-text .person-name a,
	.comments-area .comment-list li.comment .reply a:hover,
	body .vc_tta-container .tab-style-left .vc_tta-panel-body h3,
	.rs-contact .contact-address .address-item .address-text h3.contact-title,
	#rs-header.header-style-4 .header-inner .logo-section .toolbar-contact-style4 ul li i,
	.rs-porfolios-details .team-social-icons ul li a:hover i:before
	{
		color: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-team-grid.team-style4 .team-wrapper .team_desc:before,
	.rs-team-grid.team-style5 .team-item .normal-text .team-text:before{
		background: <?php echo esc_attr($site_color); ?> !important;
	}
	.rs-services3 .slick-arrow,
	.single-teams .ps-image .ps-informations{
		background: <?php echo esc_attr($secondary_color); ?>;
	}
	.rs-blog-details .bs-img .blog-date:before, .rs-blog .bs-img .blog-date:before, .blog .bs-img .blog-date:before, .rs-blog-details .blog-img .blog-date:before, .rs-blog .blog-img .blog-date:before, .blog .blog-img .blog-date:before{		
		border-bottom: 0 solid;
    	border-bottom-color: <?php echo esc_attr($secondary_color); ?>;
    	border-top: 80px solid transparent;
    	border-right-color: <?php echo esc_attr($secondary_color); ?>;
    }
    .border-image.small-border .vc_single_image-wrapper:before{
	    border-bottom: 250px solid <?php echo esc_attr($secondary_color); ?>;
	}
	.border-image.small-border .vc_single_image-wrapper:after{
		border-top: 250px solid <?php echo esc_attr($secondary_color); ?>;
	}




	.border-image .vc_single_image-wrapper:before,
	.team-grid-style3 .team-img:before, .team-slider-style3 .team-img:before,
	.team-grid-style2 .team-item-wrap .team-item, .team-slider-style2 .team-item-wrap .team-item{
		border-bottom-color: <?php echo esc_attr($secondary_color); ?>;   			
	}
	.border-image .vc_single_image-wrapper:after,
	.team-grid-style3 .team-img:after, .team-slider-style3 .team-img:after{
		border-top-color: <?php echo esc_attr($secondary_color); ?>;   	
	}

	.rs-counter-list h2,
	.rs-porfolios-details .team-info, .rs-porfolios-details .career-info,
	.rs-porfolios-details .single-player-image .name{
		border-top-color: <?php echo esc_attr($site_color); ?>;
	}

	.woocommerce-info,
	body.single-services blockquote,
	.rs-porfolio-details.project-gallery .file-list-image .p-zoom{
		border-color: <?php echo esc_attr($secondary_color); ?>;  
	}
	.slidervideo .slider-videos,
	.slidervideo .slider-videos:before,
	.rs-services .services-style-9 .services-wrap .services-item .services-icon,
	.service-readon,
	.rs-heading.style2::after,
	.rs-heading.style6 .title-inner .sub-text:after,
	.rs-heading.style3 .description:after, 
	.rs-services .services-style-9 .services-wrap:after,
	.service-carousel .owl-dots .owl-dot.active,
	.bs-search button:hover,
	.woocommerce-MyAccount-navigation ul li:hover,
	.woocommerce-MyAccount-navigation ul li.is-active,		
	.rs-team-grid.team-style4 .team-wrapper:hover .team_desc,
	.rs-blog-details .bs-img .categories .category-name a, .rs-blog .bs-img .categories .category-name a, .blog .bs-img .categories .category-name a, .rs-blog-details .blog-img .categories .category-name a, .rs-blog .blog-img .categories .category-name a, .blog .blog-img .categories .category-name a,
	.club-details_data .rs-galleys .galley-img:before,
	::selection{
		background: <?php echo esc_attr($site_color); ?>;
	}

	
	.slidervideo .slider-videos i,
	.list-style li::before,
	.slidervideo .slider-videos i:before,
	#team-list-style .team-name a,
	.rs-contact .contact-address .address-item .address-text a, a
	{
		color: <?php echo esc_attr($link_color); ?>;
	}

	.time_circles div span,
	.event_counter6 .coming-soon-part2 .coming-soon-text .time_circles div span,
	.rs-latest-news .latest-news-grid .featured-news-grid .news-info .news-date,
	.rs-latest-news .latest-news-grid .featured-news-grid .news-info .news-title a:hover,
	.rs-latest-news .news-list-item .news-info-list .news-date,
	.rs-portfolio-style table th,
	.rs-players-slider.players-style2 .person-details .squad-numbers,
	.rs-products-slider .product-item .product-price,
	.rs-products-slider .product-item .product-title a:hover,
	.rs-players-slider.players-style2 .person-details .player-title a:hover,
	.rs-latest-news .news-list-item .news-info-list .news-title a:hover, 
	.rs-latest-news .news-list-item .news-info-list .news-date a:hover, 
	.rs-latest-news .news-list-item .news-info-list .news-desc a:hover,
	.rs-latest-news .latest-news-grid .featured-news-grid .news-info .news-date a:hover, 
	.rs-latest-news .latest-news-grid .featured-news-grid .news-info .news-desc a:hover,
	.home2-top-player .rs-players-slider.players-style2 .player-item .person-details .player-title a:hover,
	.sports-grid .event_counter6 .versase,
	.event_counter6 h1.slider-title span span{
		color: <?php echo esc_attr($site_color); ?>;
	}
	.today-match-teams .owl-nav .owl-prev i:before,
	.today-match-teams .owl-nav .owl-next i:before,
	.rs-players-slider .owl-nav .owl-prev i:before, 
	.rs-players-slider .owl-nav .owl-next i:before,
	.award-carourel .champion-details .champion-no,
	.home2-top-player .rs-players-slider.players-style2 .owl-carousel .owl-nav .owl-prev:hover i:before, 
	.home2-top-player .rs-players-slider.players-style2 .owl-carousel .owl-nav .owl-next:hover i:before
	{
		color: <?php echo esc_attr($site_color); ?> !important;
	}
	.today-match-teams .owl-nav .owl-next:hover i:before, 
	.today-match-teams .owl-nav .owl-prev:hover i:before,
	.rs-players-slider .owl-nav .owl-next:hover i:before,
	.rs-players-slider .owl-nav .owl-prev:hover i:before,
	.footer-bottom .footer-share ul li a:hover,
	.footer-bottom .footer-share ul li a{
		color: <?php echo esc_attr($secondary_color); ?> !important;
	}
	.owl-carousel .owl-nav [class*="owl-"],
	.sports-grid .event_counter6 .slider-title span.lines-bg:before,
	.rs-heading.style2 .title-inner span.lines-bg:before,
	.footer-bottom .footer-share ul li a:hover{
		background: <?php echo esc_attr($site_color); ?>;
	}
	.rs-heading.style2 .title-inner span.lines-bg:after{
		background: <?php echo esc_attr($secondary_color); ?>;
	}

	.about-award a:hover, a:hover,
	#team-list-style .team-name a:hover,
	#team-list-style .team-social i:hover,
	#team-list-style .social-info .phone a:hover,
	.rs-contact .contact-address .address-item .address-text a:hover
	{
		color: <?php echo esc_attr($link_hover_color); ?>;
	}

	.about-award a:hover{
		border-color: <?php echo esc_attr($link_hover_color); ?>;
	}

	.rs-blog-details .bs-img .categories .category-name a:hover, .rs-blog .bs-img .categories .category-name a:hover, .blog .bs-img .categories .category-name a:hover, .rs-blog-details .blog-img .categories .category-name a:hover, .rs-blog .blog-img .categories .category-name a:hover, .blog .blog-img .categories .category-name a:hover,
	ul.mptt-navigation-tabs li.active,
	ul.mptt-navigation-tabs li:hover{
		background: <?php echo esc_attr($secondary_color); ?>;
	}
	.team-grid-style1 .team-item .social-icons1 a i, .team-slider-style1 .team-item .social-icons1 a i,
	button, html input[type="button"], input[type="reset"],
	.rs-service-grid .service-item .service-img:before,
	.rs-service-grid .service-item .service-img:after,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i:hover,
	.rs-services1.services-right .services-wrap .services-item .services-icon i:hover,
	.rs-service-grid .service-item .service-content::before,
	.sidenav li.nav-link-container,
	#rs-services-slider .img_wrap:before,
	#rs-services-slider .img_wrap:after,
	.rs-galleys .galley-img:before,
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec::before,
	#about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab .vc_active a, #about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab.vc_active a,
	.services-style-5 .services-item .icon_bg,
	#rs-skills .vc_progress_bar .vc_single_bar,
	#rs-header.header-style5 .header-inner .menu-area,
	#cl-testimonial.cl-testimonial10 .slick-arrow,
	.contact-sec .contact:before, .contact-sec .contact:after,
	.contact-sec .contact2:before,
	.team-grid-style2 .team-item-wrap .team-img .team-img-sec:before,
	.rs-porfolio-details.project-gallery .file-list-image:hover .p-zoom:hover,
	.team-slider-style2 .team-item-wrap .team-img .team-img-sec:before
	{
		background: <?php echo esc_attr($secondary_color); ?>;
	}

	#about-history-tabs .vc_tta-tabs-container ul.vc_tta-tabs-list .vc_tta-tab a:hover,
	body .vc_tta-container .tab-style-left .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a
	{
		background: <?php echo esc_attr($secondary_color); ?> !important;
	}

	.full-video .rs-services1.services-left .services-wrap .services-item .services-icon i,
	#cl-testimonial.cl-testimonial9 .single-testimonial .testimonial-image img,
	.rs-services1.services-left.border_style .services-wrap .services-item .services-icon i,
	.rs-services1.services-right .services-wrap .services-item .services-icon i,
	#cl-testimonial.cl-testimonial10 .slick-arrow,
	.team-grid-style2 .team-item-wrap .team-img img, .team-slider-style2 .team-item-wrap .team-img img,
	.contact-sec .wpcf7-form .wpcf7-text, .contact-sec .wpcf7-form .wpcf7-textarea{
		border-color: <?php echo esc_attr($secondary_color); ?> !important;
	}


	<?php 
		if(!empty($khelo_option['link_hover_text_color'])){
			?>
			#rs-services-slider .item-thumb .owl-dot.service_icon_style.active .tile-content a, 
			#rs-services-slider .item-thumb .owl-dot.service_icon_style:hover .tile-content a,
			.team-grid-style2 .appointment-bottom-area .app_details:hover a, .team-slider-style2 .appointment-bottom-area .app_details:hover a, .team-grid-style2 .appointment-bottom-area .app_btn:hover a, .team-slider-style2 .appointment-bottom-area .app_btn:hover a{
				color: <?php echo esc_attr($khelo_option['link_hover_text_color']); ?> !important;	
			}
		<?php
		}
	?>
	
	<?php 
		if(!empty($khelo_option['link_hover_text_color'])){
			?>			
			.team-grid-style2 .appointment-bottom-area .app_details:hover a, .team-slider-style2 .appointment-bottom-area .app_details:hover a,
			.team-grid-style2 .appointment-bottom-area .app_btn:hover a, .team-slider-style2 .appointment-bottom-area .app_btn:hover a{
				border-color: <?php echo esc_attr($khelo_option['link_hover_text_color']); ?> !important;	
			}
		<?php
		}
	?>


	<?php 
		if(!empty($khelo_option['stiky_menu_area_bg_color'])){
			?>
			#rs-header .menu-sticky.sticky .menu-area{
				background: <?php echo esc_attr($khelo_option['stiky_menu_area_bg_color']); ?> !important;	
			}
		<?php
		}
	?>

	<?php if(!empty($khelo_option['blog_bg_color'])) : ?>
		body.archive, body.blog, body.single{
			background:<?php echo sanitize_hex_color($khelo_option['blog_bg_color']); ?> !important;						
		}
	<?php endif; ?>

	<?php 
		if(!empty($khelo_option['stikcy_menu_text_color'])){
			?>
			#rs-header .menu-sticky.sticky .menu-area .navbar ul li a{
				color: <?php echo esc_attr($khelo_option['stikcy_menu_text_color']); ?> !important;	
			}
		<?php
		}
	?>	

	<?php 
		if(!empty($khelo_option['stikcy_menu_text_active_color'])){
			?>

			#rs-header .menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
			#rs-header .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
			#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul:not(.sub-menu) > li.current_page_item > a,
			#rs-header.header-style-4 .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
			#rs-header.header-style-4 .menu-sticky.sticky .menu-area .menu > li.current-menu-ancestor > a{
				color: <?php echo esc_attr($khelo_option['stikcy_menu_text_active_color']); ?> !important;	
			}
		<?php
		}
	?>

	<?php if(!empty($khelo_option['sticky_drop_down_bg_color'])) : ?>
		.menu-sticky.sticky .menu-area .navbar ul li .sub-menu{
			background:<?php echo esc_attr($khelo_option['sticky_drop_down_bg_color']); ?>;
		}
	<?php endif; ?>


		
	<?php 
		if(!empty($khelo_option['sticky_menu_text_hover_color'])){
			?>
			#rs-header .menu-sticky.sticky .menu-area .navbar ul li:hover > a,
			#rs-header.header-style1 .menu-sticky.sticky .menu-area .navbar ul li:hover > a{
				color: <?php echo esc_attr($khelo_option['sticky_menu_text_hover_color']); ?>;	
			}
		<?php
		}
	?>

	<?php 
		if(!empty($khelo_option['stikcy_drop_text_color'])){
			?>
			#rs-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li a{
				color: <?php echo esc_attr($khelo_option['stikcy_drop_text_color']); ?> !important;	
			}
		<?php
		}
	?>

	<?php 
		if(!empty($khelo_option['sticky_drop_text_hover_color'])){
			?>
			#rs-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li a:hover,			
			#rs-header.header-transparent .menu-sticky.sticky .menu-area .navbar ul.sub-menu>li.current_page_item>a,
			body #rs-header .menu-sticky.sticky .menu-area .navbar ul.sub-menu>li.current-menu-item>a,
			#rs-header .menu-sticky.sticky .menu-area .navbar ul li .sub-menu li.current-menu-item page_item a{
				color: <?php echo esc_attr($khelo_option['sticky_drop_text_hover_color']); ?> !important;	
			}
		<?php
		}
	?>	
	<?php 
		if(!empty($khelo_option['stikcy_menu_text_active_color'])){
			?>
			.menu-sticky.sticky .menu-area .navbar ul > li.current-menu-ancestor > a,
			.menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
			#rs-header.header-style-4 .menu-sticky.sticky .menu-area .navbar ul > li.current_page_item > a,
			#rs-header.header-style-4 .menu-sticky.sticky .menu-area .menu > li.current-menu-ancestor > a{
				color: <?php echo esc_attr($khelo_option['stikcy_menu_text_active_color']); ?> !important;	
			}
		<?php
		}
	?>

		<?php 
			if(!empty($khelo_option['footer_bg_color'])){
				?>
				.rs-footer{
				background: <?php echo esc_attr($khelo_option['footer_bg_color']); ?>;
				background-size: cover;				
			}
			<?php
			}
		?>
	


	<?php if(!empty($khelo_option['btn_bg_color'])) : ?>		
		#rs-header.header-style1 .btn_quote a,
		#rs-header.header-transparent .btn_quote a,
		.menu-sticky.sticky .quote-button,
		.single-post .single-content-full .bs-tags a,
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"],
		#rs-header.header-style-3 .btn_quote .quote-button,
		#scrollUp i,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover
		{
			background:<?php echo esc_attr($khelo_option['btn_bg_color']); ?>;			
		}

		.main-contain .Total_Soft_Poll_Main_Div .Total_Soft_Poll_1_But_MDiv_1 button,
		.club-details_data ul.nav li a.active,
		.club-details_data ul.nav li a:after,
		.club-details_data ul.nav li a:hover{
			background:<?php echo esc_attr($khelo_option['btn_bg_color']); ?> !important;		
		}
	<?php endif; ?>

	<?php if( !empty($khelo_option['btn_bg_color']) && !empty($khelo_option['btn_bg_hover_color']) ) : ?>		
		.readon, .readon:hover,
		.readon-slider, .readon-slider:hover,
		.rs-footer .newsletter-footer .newsletter-inner .widget_mc4wp_form_widget .mc4wp-form-fields input[type="submit"],
		.rs-footer .newsletter-footer .newsletter-inner .widget_mc4wp_form_widget .mc4wp-form-fields input[type="submit"]:hover,
		.comments-area .comment-list li.comment .reply a,
		.comments-area .comment-list li.comment .reply a:hover,
		.event_counter6 .btn-slider a, .event_counter6 .btn-slider a:hover,
		.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce .wc-forward, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
		.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce .wc-forward:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.rs-result-style-1 table td a.view-result, .rs-result-style-1 table td a.view-result:hover,
		.comment-respond .form-submit #submit,
		.comment-respond .form-submit #submit:hover,
		button, html input[type="button"], input[type="reset"], input[type="submit"],
		button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover,
		.breaking-news .breaking-title{
			background-image: linear-gradient(to right, <?php echo esc_attr($khelo_option['btn_bg_color']); ?> 0%, <?php echo esc_attr($khelo_option['btn_bg_hover_color']); ?> 51%, <?php echo esc_attr($khelo_option['btn_bg_color']); ?> 100%);			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['btn_text_color'])) : ?>
		.readon,
		.woocommerce button.button,
		.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce .wc-forward, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
		.woocommerce a.button,
		.woocommerce .wc-forward,
		.comments-area .comment-list li.comment .reply a,
		.woocommerce button.button.alt,   
		.woocommerce ul.products li a.button,
		 #rs-header.header-style1 .btn_quote a,
		 .menu-sticky.sticky .quote-button:hover,
		 #rs-header.header-transparent .btn_quote a:hover,
		 #rs-header.header-style-3 .btn_quote .quote-button,
		 #scrollUp i,
		 .event_counter6 .btn-slider a,
		 .rs-footer .newsletter-footer .newsletter-inner .widget_mc4wp_form_widget .mc4wp-form-fields input[type="submit"],
		 .rs-result-style-1 table td a.view-result{
			color:<?php echo esc_attr($khelo_option['btn_text_color']); ?>;
		}
		.main-contain .Total_Soft_Poll_Main_Div .Total_Soft_Poll_1_But_MDiv_1 button,
		.club-details_data ul.nav li a.active,
		.club-details_data ul.nav li a:hover,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
		.woocommerce-MyAccount-navigation ul li.is-active a,
		.blog .rs-blog .blog-item .blog-img .blog-img-content .meta-date,
		.comment-respond .form-submit #submit,
		.rs-blog-details .blog-item.style2 .meta-date, .rs-blog .blog-item.style2 .meta-date, .blog .blog-item.style2 .meta-date,
		#rs-contact .contact-address.style2 .address-item .address-icon i,
		button, html input[type="button"], input[type="reset"], input[type="submit"]{
			color:<?php echo esc_attr($khelo_option['btn_text_color']); ?> !important;		
		}
		
	<?php endif; ?>

	<?php if(!empty($khelo_option['btn_txt_hover_color'])) : ?>		
		#rs-header.header-style1 .btn_quote a:hover,
		.comments-area .comment-list li.comment .reply a:hover,
		.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce .wc-forward:hover, .woocommerce button.button:hover, .woocommerce input.button, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
		.woocommerce .wc-forward:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button.alt:hover,  
		.woocommerce button.button:hover,  
		.woocommerce ul.products li:hover a.button,
		.woocommerce button.button:hover, 
		.submit-btn i,
		.comment-respond .form-submit #submit:hover,
		.submit-btn .wpcf7-submit:hover,
		.submit-btn:hover .wpcf7-submit,
		.submit-btn:hover .wpcf7-submit,
		.menu-sticky.sticky .quote-button,
		#rs-header.header-transparent .btn_quote a:hover,
		#rs-header.header-style-3 .btn_quote .quote-button:hover,
		.event_counter6 .btn-slider a:hover,
		.rs-result-style-1 table td a.view-result:hover,
		.comment-respond .form-submit #submit,
		button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover{
			color:<?php echo esc_attr($khelo_option['btn_txt_hover_color']); ?> !important;
		}
		.readon:hover{
			color:<?php echo esc_attr($khelo_option['btn_txt_hover_color']); ?> 
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['btn_bg_hover_color'])) : ?>
		.rs-products-slider .product-item .product-btn a:hover,
		.single-post .single-content-full .bs-tags a:hover,
		.rs-footer .footer-top .mc4wp-form-fields input[type="submit"]:hover,
		 #rs-header.header-style1 .btn_quote a:hover,
		 .menu-sticky.sticky .quote-button:hover,
		 .rs-blog-details .bs-img .categories .category-name a:hover, .rs-blog .bs-img .categories .category-name a:hover, .blog .bs-img .categories .category-name a:hover, .rs-blog-details .blog-img .categories .category-name a:hover, .rs-blog .blog-img .categories .category-name a:hover, .blog .blog-img .categories .category-name a:hover,
		 #rs-header.header-transparent .btn_quote a:hover,
		 #rs-header.header-style-3 .btn_quote .quote-button:hover{
			background:<?php echo esc_attr($khelo_option['btn_bg_hover_color']); ?>;
			
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['container_size'])) : ?>
		@media screen and (min-width: 1400px){
			.container{
				max-width:<?php echo esc_attr($khelo_option['container_size']); ?>;
			}
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['menu_item_gap'])) : ?>
		.menu-area .navbar ul li a{
			padding-left:<?php echo esc_attr($khelo_option['menu_item_gap']); ?>;
			padding-right:<?php echo esc_attr($khelo_option['menu_item_gap']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['menu_item_gap2'])) : ?>
		.menu-area .navbar ul > li,
		#rs-header.header-style1 .btn_quote,
		#rs-header .menu-cart-area,
		#rs-header .menu-responsive .sidebarmenu-area,
		#rs-header.header-transparent .btn_quote,
		#rs-header .menu-responsive .sidebarmenu-search .sticky_search{
			padding-top:<?php echo esc_attr($khelo_option['menu_item_gap2']); ?>;
			padding-bottom:<?php echo esc_attr($khelo_option['menu_item_gap2']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['dropdown_menu_item_gap'])) : ?>
		.menu-area .navbar ul li ul.sub-menu li a{
			padding-left:<?php echo esc_attr($khelo_option['dropdown_menu_item_gap']); ?>;
			padding-right:<?php echo esc_attr($khelo_option['dropdown_menu_item_gap']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['dropdown_menu_item_gap2'])) : ?>
		.menu-area .navbar ul li ul.sub-menu{
			padding-top:<?php echo esc_attr($khelo_option['dropdown_menu_item_gap2']); ?>;
			padding-bottom:<?php echo esc_attr($khelo_option['dropdown_menu_item_gap2']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['dropdown_menu_item_separate'])) : ?>
		.menu-area .navbar ul li ul.sub-menu li a{
			padding-top:<?php echo esc_attr($khelo_option['dropdown_menu_item_separate']); ?>;
			padding-bottom:<?php echo esc_attr($khelo_option['dropdown_menu_item_separate']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['meaga_menu_item_gap'])) : ?>
		#rs-header .menu-area .navbar ul > li.mega > ul{
			padding-left:<?php echo esc_attr($khelo_option['meaga_menu_item_gap']); ?>;
			padding-right:<?php echo esc_attr($khelo_option['meaga_menu_item_gap']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['mega_menu_item_gap2'])) : ?>
		#rs-header .menu-area .navbar ul > li.mega > ul{
			padding-top:<?php echo esc_attr($khelo_option['mega_menu_item_gap2']); ?>;
			padding-bottom:<?php echo esc_attr($khelo_option['mega_menu_item_gap2']); ?>;
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['mega_menu_item_separate'])) : ?>
		#rs-header .menu-area .navbar ul li.mega ul.sub-menu li a{
			padding-top:<?php echo esc_attr($khelo_option['mega_menu_item_separate']); ?>;
			padding-bottom:<?php echo esc_attr($khelo_option['mega_menu_item_separate']); ?>;
		}
	<?php endif; ?>


	<?php if(!empty($khelo_option['breadcrumb_bg_color'])) : ?>
		.rs-breadcrumbs{
			background:<?php echo esc_attr($khelo_option['breadcrumb_bg_color']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['breadcrumb_text_color'])) : ?>
		.rs-breadcrumbs .page-title,
		.rs-breadcrumbs ul li *,
		.rs-breadcrumbs ul li.trail-begin a:before,
		.rs-breadcrumbs ul li{
			color:<?php echo esc_attr($khelo_option['breadcrumb_text_color']); ?> !important;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['breadcrumb_gap_top']) || !empty($khelo_option['breadcrumb_gap_bottom'])) : ?>
		.rs-breadcrumbs .breadcrumbs-inner,
		.transparent_head .rs-breadcrumbs .breadcrumbs-inner{
			padding-top:<?php echo esc_attr($khelo_option['breadcrumb_gap_top']); ?>;			
			padding-bottom:<?php echo esc_attr($khelo_option['breadcrumb_gap_bottom']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['even_row_bg_color'])) : ?>
		.match-statistics table tr:nth-child(even){
			background:<?php echo esc_attr($khelo_option['even_row_bg_color']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['odd_row_bg_color'])) : ?>
		.match-statistics table tr:nth-child(odd){
			background:<?php echo esc_attr($khelo_option['odd_row_bg_color']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['table_text_color'])) : ?>
		.match-statistics table tr td{
			color:<?php echo esc_attr($khelo_option['table_text_color']); ?>;			
		}
	<?php endif; ?>

	<?php if(!empty($khelo_option['team_text_color'])) : ?>
		.match-statistics table tr th{
			color:<?php echo esc_attr($khelo_option['team_text_color']); ?>;			
		}
	<?php endif; ?>
	<?php if(!empty($khelo_option['result_text_color'])) : ?>
		.match-statistics table th.goal{
			color:<?php echo esc_attr($khelo_option['result_text_color']); ?>;			
		}
	<?php endif; ?>

	<?php 
	$output = '';
	if(isset($khelo_option['custom-css'])){
   		$output = $khelo_option['custom-css'];
		echo esc_attr($output);
	}
	?>

</style>

<?php
	} 
}
  	if(is_page() || is_single()){
		$padding_top    = get_post_meta(get_the_ID(), 'content_top', true);
		$padding_bottom = get_post_meta(get_the_ID(), 'content_bottom', true);

		$header_padding = get_post_meta(get_the_ID(), 'header_custom_padding', true);

		$menu_top    = get_post_meta(get_the_ID(), 'menu_top', true);
		$menu_bottom = get_post_meta(get_the_ID(), 'menu_bottom', true);

	  	if($padding_top != '' || $padding_bottom != ''){
		  	?>
		  	  <style>
		  	  	.main-contain #content{
		  	  		<?php if(!empty($padding_top)): ?>padding-top:<?php echo esc_attr($padding_top); endif;?> !important;
		  	  		<?php if(!empty($padding_bottom)): ?>padding-bottom:<?php echo esc_attr($padding_bottom); endif;?> !important;
		  	  	}
		  	  	
		  	  </style>	
		  	<?php
		}

		if($header_padding != ''){
		  	?>
		  	  <style>		  	  	
		  	  	#rs-header .container-fluid{
		  	  		padding-left:<?php echo esc_attr($header_padding);?> !important;
		  	  		padding-right:<?php echo esc_attr($header_padding);?> !important;
		  	  	}
		  	  </style>	
		  	<?php
		}

		if($menu_top != '' || $menu_bottom != ''){
		  	?>
		  	  <style>
		  	  	.menu-area .navbar  ul > li, #rs-header.header-style1 .btn_quote, #rs-header .menu-cart-area, #rs-header .menu-responsive .sidebarmenu-area, #rs-header.header-transparent .btn_quote, #rs-header .menu-responsive .sidebarmenu-search .sticky_search{
		  	  		<?php if(!empty($menu_top)): ?>padding-top:<?php echo esc_attr($menu_top); endif;?>;
		  	  		<?php if(!empty($menu_bottom)): ?>padding-bottom:<?php echo esc_attr($menu_bottom); endif;?>;
		  	  	}
		  	  </style>	
		  	<?php
		}
  	}
}