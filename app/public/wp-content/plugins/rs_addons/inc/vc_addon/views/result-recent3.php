<div class="today-match-teams style3 text-center <?php echo $css_class;?> <?php echo $css_class_custom;?>">
	<div class="title-head">
		<?php echo wp_kses_post( $recent_title );?>
	</div>

	<div class="recent-result-slide owl-carousel owl-navigation-yes" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
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
				'posts_per_page' =>$post_per_slider,
				'meta_key'       => 'total_goal'
			));	  
		}

		else{

			$best_wp = new wp_Query(array(
				'post_type'      => 'fixture-results',
				'posts_per_page' => $post_per_slider,
				'meta_key'       => 'total_goal',
				'orderby'        => 'date',									
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
       		$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
       		$date        = get_post_meta( get_the_ID(), 'match_date', true );
       		$match_link = get_the_permalink(get_the_ID());

       		$match_date  = date_i18n('F d, Y - h:i A', $date );
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
       		<a href="<?php echo esc_attr($match_link); ?>">
	       		<div class="result-item">
	       			<div class="today-score">
	       				<div class="today-match-team" <?php echo wp_kses_post($desc_color); ?>>
	       					<div class="team-single">
	       						<span class="team-logo"><?php echo wp_kses_post($team_logo);?></span>
				       			<span class="team-title" <?php echo wp_kses_post($desc_color); ?>>
				       				<?php esc_html_e($team_one);?>			       				
				       			</span>
	       					</div>
	       				</div>
	       				<div class="today-final-score" <?php echo wp_kses_post($desc_color); ?>>
	       					<div class="goal" <?php echo wp_kses_post($score_color); ?>><?php echo esc_html( $total_goal );?></div>
	       					<span class="date" <?php echo wp_kses_post($desc_color); ?> >
	       						<i class="fa fa-calendar"></i> <?php echo esc_html( $match_date );?>
	       					</span>
	       					<span class="date" <?php echo wp_kses_post($desc_color); ?> >
	       						<i class="fa fa-map"></i> <?php echo esc_html( $vanue );?>
	       					</span>
	       				</div>
	       				<div class="today-match-team" <?php echo wp_kses_post($desc_color); ?>>
	       					<div class="team-single">
		       					<span class="team-logo"><?php echo wp_kses_post($team_logo2);?></span>
				       			<span class="team-title" <?php echo wp_kses_post($desc_color); ?>>
				       				<?php esc_html_e($team_two);?>			       				
				       			</span>
		       				</div>
	       				</div>
	       			</div>
	       		</div>
	       	</a>
       		<?php

       	endwhile; 
       	wp_reset_query();
       endif;
       ?>
   </div>

   		<?php if($grid_result == 'yes'): ?>
		   <div class="recent-match-results">
			   	<div class="title-head">
			        <?php echo wp_kses_post( $pre_result_title );?>
			    </div>
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
							'post_type' => 'fixture-results',
							'posts_per_page' =>$post_per_grid,
							'meta_key'  => 'total_goal',
							'offset'    => $post_per_slider,
						));	  
					}

					else{

						$best_wp = new wp_Query(array(
							'post_type' => 'fixture-results',
							'posts_per_page' =>$post_per_grid,
							'meta_key'  => 'total_goal',	
							'orderby'   => 'date',
							'offset'    => $post_per_slider,						
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
			       		$date        = get_post_meta( get_the_ID(), 'match_date', true );
			       		$match_link = get_the_permalink(get_the_ID());

			       		$match_date  = date('F d, Y', $date );
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
				?>
					<a href="<?php esc_html_e($match_link); ?>" class="result-link">
					    <div class="single-result">
					        <div class="team-result clearfix">
					            <div class="text-left match-result-list single-part team-wrap">
					            	<div class="team-logo"><?php echo wp_kses_post($team_logo);?></div>
			       					<div class="team-title"><?php esc_html_e($team_one);?></div>
					            </div>
					            <div class="text-center match-score single-part">
					                <span class="score">3</span> - <span class="score">2</span>
					            </div> 
					            <div class="text-left match-result-list single-part team-wrap">
					            	<div class="team-logo"><?php echo wp_kses_post($team_logo2);?></div>
			       					<div class="team-title"><?php esc_html_e($team_two);?></div>
					            </div>
					        </div>
					    </div>
					</a>
				<?php
					endwhile; 
					wp_reset_query();
				endif;
				?>
				<?php echo wp_kses_post( $readmore_text );?>
		</div>
	<?php endif; ?>
</div>