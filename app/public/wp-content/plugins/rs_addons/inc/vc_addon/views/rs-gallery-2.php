<div class="rs-galleys <?php echo $css_class_custom; ?> <?php echo $css_class; ?>">  

<?php 

if($show_filter !='No'): ?>
	<div class="portfolio-filter  filter-<?php echo strtolower($filter_align);?>">
	    <button class="active" data-filter="*"><?php echo $filter_title ; ?></button>   

	    <?php
	     $arr= explode(',', $gallery_title);
	     for ($i=0; $i < count($arr) ; $i++) { 
	       	 $gtitle = get_the_title ($arr[$i]);?>
	       	 <button data-filter=".filter_<?php echo $arr[$i];?>"><?php echo $gtitle; ?></button>    	
       	<?php }	?>
	   

	      	
 	</div>	
 <?php endif; ?>

	<div id="rs-galleys" class="row grid gallery-grid file-list-wrap ">
		<?php for ($i=0; $i < count($arr) ; $i++) { 
			       $termsString = 'filter_'.$arr[$i].' '; //create a string that has all the slugs 
	
		$best_wp = new wp_Query(array(
		        'post_type' => 'gallery',
		        'p' => $gallery_title
	    
			));		
		while($best_wp->have_posts()): $best_wp->the_post();
		 $arr= explode(',', $gallery_title);    
	 
		
		$gallery_info = get_post_meta( get_the_ID(), 'gallery_info', true );

		if(is_array($gallery_info)){    	

	   		// Loop through them and output an image
		    foreach ( $gallery_info as $gallery_infos ) {
		    	$gallery_image = $gallery_infos['gallery_image'];
		        echo '<div class="grid-item col-md-'.$col_group.' '.$termsString.'"><div class="file-list-image">';
		        ?>
		        <img src="<?php echo esc_url( $gallery_image );?>" alt="" />
		        <?php 
		        if( $show_zoom_yes == 'yes'):
		        	echo '<a class="image-popup p-zoom" href="'.$gallery_image.'"><i class="fa fa-search"></i></a>';
		    	endif;
		        echo '</div></div>';
		    }
		}
		
	    endwhile;	

	
		     }	
		?>
	</div>
</div>
