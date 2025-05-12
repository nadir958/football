<?php
$icon_css = $title_css = $title_spacing = $icon_spancing = $padding_icon = $btn_style = '';
if ( $icon_color != '' ) {    
        $icon_css  .= "color: {$icon_color};";  
}

if ( $size != '' ) {
    $size       = (int) $size;
    $icon_css  .= "font-size: {$size}px;";
    
}
if ( $wrapper_size != '' ) {
    $icon_spancing .= "width: {$wrapper_size}px;";
    $icon_spancing .= "height: {$wrapper_size}px;";
    $icon_spancing .= "line-height: {$wrapper_size}px;";
    
}

if ( $service_icon_bg != '' ) { 
	$icon_spancing .= "background-color: {$service_icon_bg};";    
}

if( $btn_bg != '' ){
	$btn_style .= "background-color: {$btn_bg};";  
	$btn_style .= "border-color: {$btn_bg};";
}
if( $btn_color != '' ){
	$btn_style .= "color: {$btn_color};";  
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
		$icon_spancing .= "border-radius: {$icon_radiussize}px;";
	}	
}
elseif($icon_style_2 == 'circle'){	
	if( $icon_radiussize != '' ){		
		$icon_spancing .= "border-radius: {$icon_radiussize}%;";
	}
}
$randid = rand();

if(!empty($use_link))
	{
		$readmore = '<a class="readon" style="'.$btn_style.'" '. $attributes.'>'.$readmoretext.'</a>';
	}
	else{
		$readmore = '';
	}

?>
<div class="rs-services-style3  services-<?php echo $align; ?> <?php echo $css_class; ?> <?php echo $css_class_custom; ?>" data-overlay="<?php echo $overlay_color; ?>" data-opacity="<?php echo $overlay_opacity; ?>" <?php echo $border_color; ?> >
	<?php if ($imgSrc) { ?>
		<div class="bg-img" id="service_<?php echo $randid; ?>" style="background-image: url(<?php echo $imgSrc; ?>);"><?php echo $readmore; ?></div>
	<?php } ?>

	<div class="services-item">
		<div class="services-icon" <?php echo $border_color;?>>
			<span style="<?php echo $icon_spancing; ?>"><i class="vc_icon_element-icon <?php echo $services_icon; ?>" style="<?php echo $icon_css; ?>"></i></span>
		</div>
		<div class="services-desc" <?php echo $desc_bg; ?>>
			<h3 class="services-title" style="<?php echo $title_spacing; ?>"><a <?php echo $attributes; ?> style="<?php echo $title_css; ?>" > <?php echo $title; ?> </a></h3>
			<p <?php echo $desc_color; ?>><?php echo $main_content; ?></p>
		</div>
	</div>	
</div>