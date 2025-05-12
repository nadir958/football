<?php

$icon_css = $title_css = $title_spacing = '';

if ( $icon_color != '' ) {    
        $icon_css  .= "color: {$icon_color};";  
}

if ( $size != '' ) {
    $size       = (int) $size;
    $icon_css  .= "font-size: {$size}px;";
}

if ( $icon_padding != '' ) {    
    $icon_padding = (int) $icon_padding;
    $icon_css    .= "padding: {$icon_padding}px;";
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
$iconshow = '';
if( $show_icon != 'no'){
	$iconshow ='<div class="services-icon '.$icon_style_2.'">
                <i class="rs-custom-icon '.$custom_icons.'" aria-hidden="true" style ="'.esc_attr($icon_css).'"></i>
             </div>';
}
$sub_title = '';
if( $subtilte != ''){
	$sub_title ='<h4 style="color:'.$subtitle_color.'">'.$subtilte.'</h4>';
}



	$html = '
		<div class="services-main rs-services-default  services-'.$align.'"  data-icon-hover="'.$icon_hover_color.'"  data-icon-bg="'.$service_icon_bg.'" data-icon-color="'.$icon_color_normal.'">

		<div class="services-wrap '.$css_class.' '.$css_class_custom.'"> 
         <div class="services-item">

			'.$iconshow.'
           
        
			<div class="services-desc" '.$desc_bg.'>
				'.$sub_title.'
				<h3 style ="'.esc_attr($title_spacing).'" class="services-title"><a data-onhovercolor="'.$title_hovercolor.'" data-onleavecolor="'.$title_color.'" '. $attributes.' style="'.esc_attr($title_css).'">'.$title.'</a></h3>
				<p '.$desc_color.'>'.$main_content.' </p>
				</div>
			</div>	
		</div></div>';
		
  	echo $html;
?>