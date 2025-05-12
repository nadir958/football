<?php $btn_css= '';
if(!empty($buttoncolor)){
	$btn_css .="color:{$buttoncolor};";
}
if(!empty($bnt_background) && !empty($bnt_background_hover)){
	$btn_css .="background-image: linear-gradient(to right, {$bnt_background} 0%, {$bnt_background_hover} 51%, {$bnt_background} 100%);";
}
if(!empty($bnt_border)){
	$btn_css .="border-color:{$bnt_border};";
}
?>
<div class="rs-btn btn-<?php echo $align .' '.$css_class; ?>">
	<a data-onhovercolor="<?php echo $bnt_hover_text; ?>" data-bordercolor="<?php echo $bnt_border; ?>" data-onhoverbg="<?php echo $bnt_background_hover; ?>" data-onleavebg="<?php echo $button_leave; ?>" data-onleavecolor="<?php echo $normal_btn; ?>" class="readon rs_button <?php echo $button_style; ?>" href="<?php echo $rs_button_link; ?>" style ="<?php echo esc_attr($btn_css);?>"><?php echo $rs_button; ?></a>
</div>

