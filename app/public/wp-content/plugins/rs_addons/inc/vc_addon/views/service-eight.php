<?php 
	$title_css = $title_spacing = '';

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
	$html = '<div class="888 rs-services"><div class="service-inner services-style-8 '.$css_class.' '.$css_class_custom.'">
				<div class="services-wrap"> 
			        <div class="services-item">
			            <div class="services-icon">
			                '.$imageClass.'
			            </div>
			        
						<div class="services-desc"  '.$desc_bg.'>	
							<h2 class="services-title services-title2" style="'.$title_spacing.'"><a data-onhovercolor="'.$title_hovercolor.'" data-onleavecolor="'.$title_color.'" '. $attributes.' style="'.$title_css.'">'.$title.'</a></h2>		
							<p '.$desc_color.'>'.$main_content.'</p>
						</div>		
					</div>	
				</div>
			</div>
		</div>';
	echo $html;
?>