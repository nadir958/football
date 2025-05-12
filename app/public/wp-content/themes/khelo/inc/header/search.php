<?php
global $khelo_option;
$rs_top_search = get_post_meta(get_the_ID(), 'select-search', true);
//search page here
if(!empty($khelo_option['off_search'])):
     $sticky_search = $khelo_option['off_search'];
else:
    $sticky_search ='';
endif;

 if(($sticky_search == '1') || ($rs_top_search == 'show') ):
 ?>
	<div class="sticky_search"> 
	  <i class="glyph-icon flaticon-search"></i> 
	</div>
	<div class="sticky_form">
	  <?php get_search_form(); ?>
	</div>
<?php endif; ?>

