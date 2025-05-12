<?php
global $khelo_option;
$top_social = $khelo_option['show-social']; ?>
<div class="header-share">
	<ul class="clearfix">

	<?php 
		if($top_social == '1'){              
		if(!empty($khelo_option['facebook'])) { ?>
			<li> <a href="<?php echo esc_url($khelo_option['facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a> </li>
			<?php 
		}

		if(!empty($khelo_option['twitter'])) { ?>
			<li> <a href="<?php echo esc_url($khelo_option['twitter']);?> " target="_blank"><i class="fa fa-twitter"></i></a> </li>
			<?php
		}

		if(!empty($khelo_option['rss'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['rss']);?> " target="_blank"><i class="fa fa-rss"></i></a> </li>
		<?php
		}

		if (!empty($khelo_option['pinterest'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p"></i></a> </li>
		<?php }

		if (!empty($khelo_option['linkedin'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin"></i></a> </li>
		<?php }

		if (!empty($khelo_option['google'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square"></i></a> </li>
		<?php }

		if (!empty($khelo_option['instagram'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['instagram']);?> " target="_blank"><i class="fa fa-instagram"></i></a> </li>
		<?php }

		if(!empty($khelo_option['vimeo'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo"></i></a> </li>
		<?php }

		if (!empty($khelo_option['tumblr'])) { ?>
			<li> <a href="<?php  echo esc_url($khelo_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr"></i></a> </li>
		<?php }

		if (!empty($khelo_option['youtube'])) { ?>
		<li> <a href="<?php  echo esc_url($khelo_option['youtube']);?> " target="_blank"><i class="fa fa-youtube"></i></a> </li>
		<?php } 
	} ?>
	</ul>
</div>