<?php
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $atts ); 

?>

<div class="rs-products-slider <?php echo esc_attr($css_class);?>">
    <div class="team-carousel owl-carousel owl-navigation-yes" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">

        <?php $cat;
        $arr_cats=array();
        $arr= explode(',', $cat);  

        for ($i=0; $i < count($arr) ; $i++) {             
            $arr_cats[]= $arr[$i];            
        }  

        if(empty($cat)){
            $latest_product = new WP_Query( array(
            'post_type'      => 'product', //post of page of my post type
            'posts_per_page' => $product_per                                    
            ));   
        }   
        else{
            $latest_product = new WP_Query( array(
                    'post_type' => 'product',
                    'posts_per_page' =>$product_per,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug', //can be set to ID
                            'terms' => $arr_cats//if field is ID you can reference by cat/term number
                        ),
                    )
            ));   
        }  
               
        if ( $latest_product->have_posts() ) :
        while ( $latest_product->have_posts() ) :
            $latest_product->the_post();
            global $product;
            $product = wc_get_product( get_the_ID() ); //set the global product object?>

            <div class="product-item">
                <div class="product-img">
                    <a href="<?php the_permalink() ?>">
                        <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                            echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
                        } else {
                            echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
                        } ?>
                    </a>
                </div>
                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                <div class="product-btn">
                    <?php woocommerce_template_loop_add_to_cart();?>
                </div>
            </div>

        <?php endwhile; wp_reset_query(); endif; ?>
    </div>    
</div>
