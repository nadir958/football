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
		</style>
		
	<?php endif; ?>

<?php if ($source == "Dynamic") : ?>
<div id="cl-testimonial" class="cl-testimonial2 <?php echo esc_attr($css_class); echo esc_attr($css_class_custom);?>">
		   		<div class="clt-container">                
					<ul class="slider5 list-4">
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
							if(empty($post_img_url)){
								$no_author = "no-avatar";
							}
								
					?>

					<li class="testimonial-item">

					    <div class="cl-author">
					        <div class="testimonial-content <?php echo esc_attr($no_author); ?>">
					        	<?php if(!empty($post_img_url)):?>
						            <div class="cl-col-2">
						                <div class="image"><img src="<?php echo esc_url($post_img_url); ?>" alt="<?php echo esc_attr($post_title); ?>"></div>
						            </div>
					            <?php endif; ?>
					            <?php if(!empty($post_img_url)):?><div class="cl-col-10"><?php endif; ?>
					            <?php if(empty($post_img_url)):?><div class="cl-col-12"><?php endif; ?>
					                <div class="content">
					                    <p<?php echo $content_color; ?>><i class="<?php echo esc_attr($icon_fontawesome);?>"<?php echo $quote_color; ?>></i> <?php echo esc_attr($post_content); ?></p>
					                    
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
					</li>

				<?php endwhile;
					wp_reset_query();
				?>
			</ul>
		</div>
	</div>
<?php endif; ?>

<?php if ($source == "Manual") : ?>
	<div id="cl-testimonial" class="cl-testimonial2 <?php echo esc_attr($css_class); echo esc_attr($css_class_custom);?>">	

		<ul class="slider5 list-4">


			<li class="testimonial-item">

			    <div class="cl-author">
			        <div class="testimonial-content">
			        	<?php if ($imgSrc) : ?>
			            <div class="cl-col-4">
			                <div class="image"><?php echo $imageClass;?></div>
			            </div>
			        	<?php endif; ?>
			            <div class="text cl-col-8">
			                <div class="content">
			                    <p<?php echo $content_color; ?>><i class="<?php echo esc_attr($icon_fontawesome);?>"<?php echo $quote_color; ?>></i> <?php echo esc_attr($content);?></p>
			                    
			                    <?php if($customer_name !='' || $customer_degination !='' || $ratings_show !='hide') : ?>
			                    <ul class="cl-author-info">

			                    	<?php if($customer_name !='') : ?>
			                    		<li<?php echo $titlecolor; ?>><?php echo esc_attr($customer_name); ?></li>
			                    	<?php endif; ?>

			                    	<?php if($customer_degination !='') : ?>
			                    		<li<?php echo $dsignation_color; ?>><?php echo esc_attr($customer_degination); ?></li>
			                    	<?php endif; ?>

			                    	<?php if($ratings_show !='hide') : ?>
			                    		<?php if($set_ratings==1 ||$set_ratings==1.5||$set_ratings==2||$set_ratings==2.5||$set_ratings==3||$set_ratings==3.5||$set_ratings==4 || $set_ratings==4.5 || $set_ratings==5){
			                    			?>
			                    			<li class="ratings"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/<?php echo $set_ratings; ?>.png" /></li>
			                    		<?php } ?>
			                    	<?php endif; ?>

			                    </ul>
			                    <?php endif; ?>

			                </div>
			            </div>
			        </div>
			    </div>
			</li>

		</ul>

	</div>
<?php endif; ?>

