<div class="rs-galleys <?php echo $css_class_custom; ?> <?php echo $css_class; ?>">           
	<div id="rs-galleys" class="row gallery-grid">
		<?php 
		$best_wp = new wp_Query(array(
		        'post_type' => 'gallery',
		        'p' => $gallery_title
	    
			));
		while($best_wp->have_posts()): $best_wp->the_post();

		$gallery_info = get_post_meta( get_the_ID(), 'gallery_info', true ); 

		if(is_array($gallery_info)){			

	    	echo '<div class="file-list-wrap row">';

	   		// Loop through them and output an image
		    foreach ( $gallery_info as $gallery_infos ) {
		    	$gallery_image = $gallery_infos['gallery_image'];
		        echo '<div class="col-md-'.$col_group.'"><div class="file-list-image">';
		        ?>
		        	<img src="<?php echo esc_url( $gallery_image );?>" alt="" />
		        <?php 
		        if( $show_zoom_yes == 'yes'):
		        	echo '<a class="image-popup p-zoom" href="'.$gallery_image.'"><i class="fa fa-search"></i></a>';
		    	endif;
		        echo '</div></div>';
		    }
		    echo '</div>';
		}

	    endwhile;		
		?>
	</div>
</div>
