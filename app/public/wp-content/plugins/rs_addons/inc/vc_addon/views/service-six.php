<?php
	$has_more_btn = ($attributes) ? 'has-more-btn' : '';
	
	$icon_css = $title_css = $title_spacing = $padding_icon = '';

	if ( $icon_color != '' ) {    
	        $icon_css  .= "color: {$icon_color};";  
	}

	if ( $size != '' ) {
	    $size       = (int) $size;
	    $icon_css  .= "font-size: {$size}px;";
	    
	}

	if ( $icon_padding != '' ) {    
	    $icon_padding = (int) $icon_padding;
	    $padding_icon    .= "padding: {$icon_padding}px;";
	}

	if ( $service_icon_bg != '' ) { 
	    $icon_css  .= "background-color: {$service_icon_bg};";  
	}

	if ( $title_color != '' ) {    
	     $title_css  .= "color: {$title_color};";  
	}

	if ( $spacing_top != '' ) {  
	    $title_spacing .= "padding-top: {$spacing_top}px;";  
	}

	if ( $spacing_bottom != '' ) {
	    $title_spacing .= "margin-bottom: {$spacing_bottom}px;";
	}

	if ( $title_size != '' ) {
	    $title_size   = (int) $title_size;
	    $title_css   .= "font-size: {$title_size}px;";
	}
	if( $icon_style_2 == 'square' ){
		if( $icon_radiussize != '' ){
			$icon_css .= "border-radius: {$icon_radiussize}px;";
		}	
	}
	elseif($icon_style_2 == 'circle'){	
		if( $icon_radiussize != '' ){		
			$icon_css .= "border-radius: {$icon_radiussize}%;";
		}
	}
	

	$html = '
	<div class="services-main rs-services-style6  '.$has_more_btn.' services-'.$align.' '.$css_class.' '.$css_class_custom.'" data-icon-hover="'.$icon_hover_color.'" data-icon-hoverbg="'.$icon_hover_bg.'" data-icon-bg="'.$service_icon_bg.'" data-icon-color="'.$icon_color_normal.'">';
		$html .= '<div class="services-item">
		    <div class="services-icon">
		        <i class="vc_icon_element-icon '.$services_icon.'" style="'.$icon_css.'""></i>
		    </div>
		    <div class="services-desc" '.$desc_bg.'>
		        <h4 class="services-title"><a data-onhovercolor="'.$title_hovercolor.'" data-onleavecolor="'.$title_color.'" '. $attributes.' style="'.$title_css.'" >'.$title.'</a></h4>
		        <p '.$desc_color.'>'.$main_content.' </p>
		    </div>';
		    
		    if ($attributes) {
		    	$html .= '<a '. $attributes.' class="btn-more fa fa-long-arrow-right" ></a>';
		    }
		?>

		<?php if( !empty($service_icon_bg) ):
			$html .='
			<style type="text/css">
				.rs-services-style6.item'.$rand.' .services-icon i{
					background: '.$service_icon_bg.' !important;
					border-color: '.$service_icon_bg.' !important;
				}
			</style>';
		endif; ?>

		
		<?php
		$html .='</div>
	</div>';   	
	echo $html;	
?>