<?php
/**
 * @author  RS Theme
 * @since   1.0
 * @version 1.0
 */
?>


<?php 

	$titlecolor = ($titlecolor) ? ' style="color: '.$titlecolor.';"' : '';
	$dsignation_color = ($dsignation_color) ? ' style="color: '.$dsignation_color.';"' : '';
	$quote_color = ($quote_color) ? ' style="color: '.$quote_color.';"' : '';
	$content_color = ($content_color) ? ' style="color: '.$content_color.';"' : '';

	if($dsignation_bg_color) : ?>
		
		<style type="text/css">
			.slider5 .image img {
			    border-color: <?php echo $dsignation_bg_color; ?>;
			}
			.slider5 .image:before, 
			.slider5 .image:after {
			    background: <?php echo $dsignation_bg_color; ?>;
			}
		</style>
		
	<?php endif; ?>

<div id="cl-testimonial" class="cl-testimonial testimonial-slide5 slider5 owl-carousel testi-carousels cl-testimonial2 <?php echo esc_attr($css_class); echo esc_attr($css_class_custom);?>" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
			<?php	


			 	while($best_wp->have_posts()): $best_wp->the_post();
					$post_title= get_the_title($best_wp->ID);
					$post_content= get_the_content($best_wp->ID);
							
					$post_img_url = get_the_post_thumbnail_url($best_wp->ID,'full');
									
					$designation = get_post_meta( get_the_ID(), 'designation', true );
					
					if($atts['d_ratings_show'] != 'hide') {
						$url = plugin_dir_url( __FILE__ );	
						$ratings = get_post_meta( get_the_ID(), 'ratings', true );
					}

				$no_author = "has-avatar";
				if( empty($post_img_url) || ($show_avatar=="hide") ){
					$no_author = "no-avatar";
				}
						
			?>		
					

					<div class="cl-author">
					    <div class="testimonial-content <?php echo esc_attr($no_author); ?>">
					    	<?php if(!empty($post_img_url) && ($show_avatar=="show")):?>
						        <div class="author-image">
						            <div class="image"><img src="<?php echo esc_url($post_img_url);?>" alt="<?php echo esc_attr($post_title);?>"></div>
						        </div>
					        <?php endif; ?>
					        <div class="testi-desc">
					            <div class="content">
					                <p<?php echo $content_color;?>><i class="<?php echo esc_attr($icon_fontawesome);?>"<?php echo $quote_color; ?>></i> <?php echo esc_attr($post_content);?></p>

					                <?php if($show_title !='hide' || $show_designation !='hide' || $d_ratings_show !='hide') : ?>
					                <ul class="cl-author-info">

					                	<?php if($show_title !='hide') : ?>
					                		<li<?php echo $titlecolor; ?>><?php echo esc_attr($post_title); ?></li>
					                	<?php endif; ?>

					                	<?php if($show_designation !='hide') : ?>
					                		<li<?php echo $dsignation_color; ?>><?php echo esc_attr($designation); ?></li>
					                	<?php endif; ?>

					                	<?php if($ratings==1 ||$ratings==1.5||$ratings==2||$ratings==2.5||$ratings==3||$ratings==3.5||$ratings==4 || $ratings==4.5 || $ratings==5){
					                		?>
					                		<li class="ratings"><img src="<?php echo $url; ?>/img/<?php echo $ratings; ?>.png" /></li>
					                	<?php } ?>
					                </ul>
					                <?php endif; ?>

					            </div>
					        </div>
					    </div>
					</div>

				<?php endwhile;
					wp_reset_query();
				?>
</div>