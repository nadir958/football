<?php
/*
Element Description: Point Table
*/
    
    function find_club($clubname){
		$args =new wp_Query(array(
		    'post_type' => 'club',  
		    'p' => $clubname       
		));		
  	
		if ( $args->have_posts() ) {		
		  $team = get_the_title($clubname);
		  return $team;		 
		  wp_reset_query();                           
		}
	}

    function vc_Portfolio_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        
        $category_dropdown = array( __( 'All Categories', 'rsaddon' ) => '0' );	
        $args = array(
            'taxonomy' => array('league-category'),//ur taxonomy
            'hide_empty' => true,                  
        );

		$terms_= new WP_Term_Query( $args );
		foreach ( (array)$terms_->terms as $term ) {
			$category_dropdown[$term->name] = $term->slug;		
		}

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Point Table Box', 'rsaddon'),
                'base' => 'vc_pointtable',
                'description' => __('Point Table Information', 'rsaddon'), 
                'category' => __('by RS Theme', 'rsaddon'),   
                'icon' => get_template_directory_uri().'/framework/assets/img/vc-icon.png',           
                'params' => array(

                    array(
                    	"type" => "dropdown",
                    	"heading" => __("Point Table Style", "rsaddon"),
                    	"param_name" => "pointtable",
                    	"value" => array(	                    	
                    		__("Default Style", "rsaddon") => "1",
                    		__("Sidebar Style", "rsaddon") => "2"
                    		
                    	),
                    	"description" => __("Select your style here", "rsaddon"),                    	
                    ),

                    
                    array(
						"type" => "dropdown_multi",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Select Categories", 'rsaddon' ),
						"param_name" => "cat",
						'value' => $category_dropdown,
					),

					 array(
                    	"type" => "textfield",
                    	"heading" => __("Result Per Page", "rsaddon"),
                    	"param_name" => "pointtable_result",                    	               	
                    ),

					array(
						"type"               => "dropdown",
						"heading"            => __("Show Team Logo", "rsaddon"),
						"param_name"         => "show_tem_logo",
						"value"              => array(	                    	
						__("No", "rsaddon")  => "no",
						__("Yes", "rsaddon") => "yes"
						
						),
						"dependency"         => Array('element' => 'pointtable', 'value' => array('2')),                	
						),
						
							
					array(
						"type"        => "colorpicker",
						"class"       => "",
						"heading"     => __( "Heading Bg Color", "rsaddon" ),
						"param_name"  => "head_bg_colors",
						"value"       => '',
						"description" => __( "Choose Heading Bg Color", "rsaddon" ),
						'group'       => 'Styles',
					),


             		array(
						"type"        => "colorpicker",
						"class"       => "",
						"heading"     => __( "Heading Text color", "rsaddon" ),
						"param_name"  => "head_text_color",
						"value"       => '',
						"description" => __( "Choose Heading Text color", "rsaddon" ),
						'group'       => 'Styles',
					),

					array(
						"type"       => "colorpicker",
						"class"      => "",
						"heading"    => __( "Even Row Bg Color", "rsaddon" ),
						"param_name" => "even_row",
						"value"      => '',						
						'group'      => 'Styles',
					),
					

					array(
						"type"       => "colorpicker",
						"class"      => "",
						"heading"    => __( "Odd Row Bg Color", "rsaddon" ),
						"param_name" => "odd_row",
						"value"      => '',						
						'group'      => 'Styles',
					),				


             		array(
						"type"        => "colorpicker",
						"class"       => "",
						"heading"     => __( "Even Row Text color", "rsaddon" ),
						"param_name"  => "text_color",
						"value"       => 'fff',
						"description" => __( "Choose text color", "rsaddon" ),
						'group'       => 'Styles',
					),

					array(
						"type"        => "colorpicker",
						"class"       => "",
						"heading"     => __( "Odd Row Text color", "rsaddon" ),
						"param_name"  => "odd_text_color",
						"value"       => 'fff',
						"description" => __( "Choose text color", "rsaddon" ),
						'group'       => 'Styles',
					),

					array(
						'type'        => 'textfield',
						'heading'     => __( 'Extra class name', 'js_composer' ),
						'param_name'  => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'rsaddon' ),
					),
					
					array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'rsaddon' ),
					'param_name' => 'css',
					'group'      => __( 'Design Options', 'rsaddon' ),
				),            
                        
                ),				
					
            )
        );                                
        
    }
     add_action( 'vc_before_init', 'vc_Portfolio_mapping' );
     
    // Element HTML
	function vc_pointtable_shortcode($atts) {
		$atts = shortcode_atts([
			'league' => '', // slug de la catégorie
		], $atts);
	
		ob_start();
	
		if (!empty($atts['league'])) {
			$category = get_category_by_slug($atts['league']);
			if ($category) {
				$term_id = $category->term_id;
				$ranking_data = get_term_meta($term_id, 'league_ranking_data', true);
	
				if (!empty($ranking_data)) {
					?>
					<div class="rs-portfolio-style pointable">
					<table class="point-table">
						<thead>
							<tr class="bg-colors">
								<th>Team</th>
								<th>MJ</th>
								<?php if (!is_front_page()) : ?>
									<th>G</th>
									<th>N</th>
									<th>P</th>
									<th>BP</th>
									<th>BC</th>
								<?php endif; ?>
								<th>Diff</th>
								<th>Pts</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($ranking_data as $club) : ?>
								<?php
								$club_name = $club['team']['name'];
								$club_post = get_page_by_title($club_name, OBJECT, 'club');
								$club_logo = '';
	
								if ($club_post) {
									$club_logo_id = get_post_thumbnail_id($club_post->ID);
									if ($club_logo_id) {
										$club_logo = wp_get_attachment_image($club_logo_id, 'thumbnail', false, ['class' => 'club-logo','style' => 'width: 30px; margin-right: 6px;']);
									}
								}
								?>
								<tr>
									<td>
										<?php if ($club_logo) echo $club_logo; ?>
										<?php echo esc_html($club_name); ?>
									</td>
									<td><?php echo esc_html($club['all']['played']); ?></td>
									<?php if (!is_front_page()) : ?>
										<td><?php echo esc_html($club['all']['win']); ?></td>
										<td><?php echo esc_html($club['all']['draw']); ?></td>
										<td><?php echo esc_html($club['all']['lose']); ?></td>
										<td><?php echo esc_html($club['all']['goals']['for']); ?></td>
										<td><?php echo esc_html($club['all']['goals']['against']); ?></td>
									<?php endif; ?>
									<td><?php echo esc_html($club['goalsDiff']); ?></td>
									<td><?php echo esc_html($club['points']); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
					<?php
				} else {
					echo '<p>Aucune donnée de classement disponible.</p>';
				}
			} else {
				echo '<p>Catégorie non trouvée.</p>';
			}
		} else {
			echo '<p>Veuillez spécifier une ligue.</p>';
		}
	
		return ob_get_clean();
	}
	add_shortcode('vc_pointtable', 'vc_pointtable_shortcode');
	
	