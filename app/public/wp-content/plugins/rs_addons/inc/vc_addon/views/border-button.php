<?php $btn_css= '';
if(!empty($buttoncolor)){
	$btn_css .="color:{$buttoncolor};";
}
if(!empty($bnt_background)){
	$btn_css .="background:{$bnt_background};";
}
if(!empty($bnt_border)){
	$btn_css .="border-color:{$bnt_border};";
}
?> 

<div class="rs-btn2 btn-<?php echo $align .' '. $css_class; ?>">
	<a data-onhovercolor="<?php echo $bnt_hover_text; ?>" data-onhoverbg="<?php echo $bnt_background_hover; ?>" data-onleavebg="<?php echo $bnt_background; ?>" data-onleavecolor="<?php echo $normal_btn; ?>" data-bordercolor="<?php echo $bnt_border; ?>" class="readon rs_button <?php echo $button_style; ?>" href="<?php echo $rs_button_link; ?>" style ="<?php echo esc_attr($btn_css);?>"><?php echo $rs_button; ?></a>
</div>