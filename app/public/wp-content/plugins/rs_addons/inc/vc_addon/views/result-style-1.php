<div class="rs-result-style-1 row-data-info">
	<div class="<?php echo $css_class;?>">      		
        <table>
		        <?php 	
		        
		         //******************//
		        // query post
		        //******************//
		    		$cat;
		            $arr_cats = array();
		            $arr= explode(',', $cat);
						for ($i=0; $i < count($arr) ; $i++) { 		               	
		               	$arr_cats[]= $arr[$i];		               	
		            }

		      		if(empty($cat)){
			        	$best_wp = new wp_Query(array(
						'post_type' => 'fixture-results',
						'meta_key' => 'total_goal',
						'posts_per_page' => $result_per_page													
								
						));	  
			        }

			        else{
		            
				    $best_wp = new wp_Query(array(
						'post_type' => 'fixture-results',
						'meta_key' => 'total_goal',	
						'posts_per_page' => $result_per_page,									
						'tax_query' => array(
					        array(
					            'taxonomy' => 'league-category',
					            'field' => 'slug', //can be set to ID
					            'terms' => $arr_cats//if field is ID you can reference by cat/term number
					        	),
					    	)
						));
					}	
					
		       		if( $best_wp->have_posts() ): while( $best_wp->have_posts() ) : $best_wp->the_post(); //start while loop
						
						$team1      = get_post_meta( get_the_ID(), 'team1',true );						
						$team2      = get_post_meta( get_the_ID(), 'team2',true );
						$total_goal = get_post_meta( get_the_ID(), 'total_goal', true);
						$total_date = get_post_meta( get_the_ID(), 'total_goal', true);
						$date       = get_post_meta( get_the_ID(), 'match_date', true );
						$team_home  = get_post_meta( get_the_ID(), 'team_home', true );
						$match_date = date_i18n('F d Y', $date );						

					   ?>
					   <tr>
					   	  <td class="logo"><span  <?php echo wp_kses_post($team_color);?>><?php echo result_find_club($team1);?></span></td>
					   	  <td><span class="total-goal" <?php echo wp_kses_post($result_color);?>><?php echo esc_html( $total_goal );?></span></td>
					   	  <td class="logo" <?php echo wp_kses_post($team_color);?>><?php echo result_find_club($team2);?></td>					   	  
					   	  <td <?php echo wp_kses_post($date_color);?>>
					   	  	<?php echo $match_date; ?>					   	  	
					   	  </td>
					   	    <?php if(!empty($btn_text)) { ?>				 			   	 

						   	  <td>
						   	  	<a class="view-result" href="<?php the_permalink(); ?>">
						   	  		<?php echo esc_html( $btn_text ); ?>						   	  			
						   	  	</a>
						   	  </td>	
						  
						  <?php 	}  ?>					   		
					   </tr>
					   <?php		
						
				endwhile; 
			wp_reset_query();
			endif;
			?>
		</table>
	</div>
</div>