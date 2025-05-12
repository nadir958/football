<div class="rs-result-style-2 row-data-info">
	<div class="<?php echo $css_class;?>">      		
      
		        <?php 	
		        
		         //******************//
		        // query post
		        //******************//
		    		$cat;
		            $arr_cats = array();
		            $arr= explode(',', $cat);
						for ($i=0; $i < count($arr) ; $i++) { 
		               	//$cats = get_term_by('slug', $arr[$i], $taxonomy);
		               	// if(is_object($cats)):
		               	$arr_cats[]= $arr[$i];
		               	//endif;
		            }
		      		if(empty($cat)){
			        	$best_wp = new wp_Query(array(
							'post_type'      => 'fixture-results',
							'meta_key'       => 'total_goal',
							'posts_per_page' => $result_per_page													
								
						));	  
			        }
			        else{		            
				    $best_wp = new wp_Query(array(
						'post_type'      => 'fixture-results',
						'meta_key'       => 'total_goal',	
						'posts_per_page' => $result_per_page,									
						'tax_query' => array(
					        array(
								'taxonomy' => 'league-category',
								'field'    => 'slug', //can be set to ID
								'terms'    => $arr_cats//if field is ID you can reference by cat/term number
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
						$match_date = date_i18n('F d Y', $date );	
						 $team_home   = get_post_meta( get_the_ID(), 'team_home', true );	
						 $team_one =  '';
						 $team_logo = ''; 
						if(!empty($team1)){
		                $team_one_query = new WP_Query( array(
		                    'post_type' => 'club',
		                    'post_status' => 'publish',
		                    'p' => $team1,
		                ));

		                if ( $team_one_query->have_posts() ) :
		                    while ( $team_one_query->have_posts() ) :
		                        $team_one_query->the_post();
		                        	$team_one =  get_the_title();
		                        	$team_logo = get_the_post_thumbnail($best_wp->ID);   
		                    endwhile;
		                    wp_reset_query();
		                endif;
		            }
					$team_two =  '';
					$team_logo2 = '';
		            if(!empty($team2)){
		                $team_two_query = new WP_Query( array(
		                    'post_type' => 'club',
		                    'post_status' => 'publish',
		                    'p' => $team2,
		                ));

		                if ( $team_two_query->have_posts() ) :
		                    while ( $team_two_query->have_posts() ) :
		                        $team_two_query->the_post();
		                        	$team_two =  get_the_title();
		                        	$team_logo2 = get_the_post_thumbnail($best_wp->ID);    
		                    endwhile;
		                    wp_reset_query();
		                endif;
		            }	

					$vanue = '';

		            if(!empty($team_home)){
		       			$team_home_query = new WP_Query( array(
		       				'post_type' => 'club',
		       				'post_status' => 'publish',
		       				'p' => $team_home,
		       			));

		       			if ( $team_home_query->have_posts() ) :
		       				while ( $team_home_query->have_posts() ) :
		       					$team_home_query->the_post();                        	
		       					$vanue = get_post_meta( get_the_ID(), 'club_stadium', true );   
		       				endwhile;
		       				wp_reset_query();
		       			endif;
		       		}				
					   ?>
					   <div class="sidebar-result">
					   	<div class="list-1-team">
					   		<span  <?php echo wp_kses_post($team_color);?>> <?php echo $team_one; ?></span>
					   	</div>
					   	<div class="list-result">
					   		<table>
					   			<tr>
					   				<td>
					   					<?php echo $team_logo; ?>
					   				</td>
					   				
					   				<td>
					   					<span <?php echo  wp_kses_post($date_color);?>><?php echo $match_date; ?></span>
					   					<span class="total-goal" <?php echo wp_kses_post($result_color);?>><?php echo esc_html( $total_goal );?></span>
					   					<span><?php echo $vanue;?></span>
					   				
					   				<td><?php echo $team_logo2; ?></td>
					   			</tr>
					   		</table>
					   		
					   	</div>
					   	<div class="list-2-team">
					   		<span  <?php echo wp_kses_post($team_color);?>> <?php echo $team_two; ?></span>
					   	</div>
						   
						</div>

					   <?php		
						
				endwhile; 
			wp_reset_query();
			endif;
			 if(!empty($btn_text)) : ?> 
				
				<div class="link-border">
					<a href="<?php the_permalink($best_wp->ID);?>"><?php echo wp_kses_post($btn_text);?></a> 
				</div>
			<?php endif; 
			?>
		
	</div>
</div>