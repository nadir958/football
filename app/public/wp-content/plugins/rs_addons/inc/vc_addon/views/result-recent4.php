<div class="today-match-teams results-style4 result-slider-styles  <?php echo $css_class;?> <?php echo $css_class_custom;?>">
	<?php if(!empty($recent_title)){ ?>
		<div class="title-head">
			<?php echo wp_kses_post( $recent_title );?>
		</div>  
	<?php } ?>    		
	<div class="recent-result-carousel team-carousel owl-carousel owl-navigation-yes" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php 	//******************//
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
				'meta_key' => 'total_goal',											
				
			));	  
		}

		else{
			
			$best_wp = new wp_Query(array(
				'post_type' => 'fixture-results',
				'meta_key' => 'total_goal',										
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
	       		
	       		$links      = get_the_permalink( get_the_ID());						
	       		$team1      = get_post_meta( get_the_ID(), 'team1',true );						
	       		$team2      = get_post_meta( get_the_ID(), 'team2',true );
	       		$total_goal = get_post_meta( get_the_ID(), 'total_goal', true);
	       		$total_date = get_post_meta( get_the_ID(), 'total_goal', true);
	       		$date        = get_post_meta( get_the_ID(), 'match_date', true );
	       		$team_home   = get_post_meta( get_the_ID(), 'team_home', true );
	       		$match_date  = date_i18n('F d, Y', $date );	
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
	       		<a href="<?php echo esc_html($links); ?>">
	       			<div class="full-result result-item" style="background-image: url(<?php echo $imgSrc; ?>); background-color: <?php echo $item_bg; ?>">
	       				<div class="title-head">	       											
	       					<span class="date" <?php echo $date_color; ?>><?php echo esc_html( $match_date );?></span>	       					
	       				</div>
	       				<div class="today-score">
	       					<div class="today-match-team" <?php echo $desc_color; ?>>
	       						<?php echo result_find_club($team1);?>
	       					</div>
	       					<div class="today-final-score" <?php echo $score_color; ?>>
	       						<?php echo esc_html( $total_goal );?>
	       					</div>
	       					<div class="today-match-team" <?php echo $desc_color; ?>>
	       						<?php echo result_find_club($team2);?>
	       					</div>
	       				</div>
	       				<div class="rs-vanues"><span class="vanue" <?php echo $title_color; ?>><?php echo esc_html($vanue);?></span></div>
	       			</div>
	       		</a>
	       		<?php
	       		
	       	endwhile; 
	       	wp_reset_query();
	       endif;
	       ?>
	   </div>
	</div>