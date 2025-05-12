<?php 
	if(!empty($use_link))
	{
		$readmore = '<a class="readon" '. $attributes.' '.$title_color.'>Read More</a>';
	}
	
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
	    $title_spacing .= "margin-top: {$spacing_top}px;";  
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
	?>

<div class="services-main rs-services-style5  services-<?php echo $align; ?> <?php echo $css_class; ?> <?php echo $css_class_custom; ?>" <?php echo $border_color; ?> data-icon-hover="<?php echo $icon_hover_color;?>" data-icon-hoverbg="<?php echo $icon_hover_bg;?>" data-icon-bg="<?php echo $service_icon_bg;?>" data-icon-color="<?php echo $icon_color_normal;?>">
	<?php if ($imgSrc) { ?>
		<div class="bg-img" style="background-image: url(<?php echo $imgSrc; ?>);"><?php echo $readmore; ?></div>
	<?php } ?>

	<div class="services-item">
		<div class="services-icon">
			<i class="vc_icon_element-icon <?php echo $services_icon; ?>" style="<?php echo $icon_css; ?>"></i>
		</div>
		<div class="services-desc" <?php echo $desc_bg; ?>>
			<h3 class="services-title" style="<?php echo $title_spacing; ?>"><a <?php echo $attributes; ?> style="<?php echo $title_css; ?>" data-onhovercolor="<?php echo $title_hovercolor;?>" data-onleavecolor="<?php echo $title_color;?>"> <?php echo $title; ?> </a></h3>
			<p <?php echo $desc_color; ?>><?php echo $main_content; ?></p>
		</div>
	</div>
</div>