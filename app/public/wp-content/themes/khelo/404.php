<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
wp_head(); 
global $khelo_option;
if(!empty( $khelo_option['404_page_banner']['url'])):
    $post_meta_data = $khelo_option['404_page_banner']['url'];
    ?>
    <div class="page-error" style="background-image: url('<?php echo esc_url($post_meta_data); ?>')">
    <?php 
else: ?>
    <div class="page-error">
<?php endif;?>
        <div class="container">
            <div id="content">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">    
                        <section class="error-404 not-found">    
                            <div class="page-content">
                                <h3>  
                                    <span>                                            
                                        <?php
                                            if(!empty($khelo_option['title_404'])){
                                                echo wp_kses_post($khelo_option['title_404']);
                                            }
                                            else{
                                                echo esc_html( '404', 'khelo' ); 
                                            }
                                        ?>
                                    </span>                      
                                    <?php
                                        if(!empty($khelo_option['text_404'])){
                                            echo wp_kses_post($khelo_option['text_404']);
                                        }
                                        else{
                                          echo esc_html( 'Page Not Found', 'khelo' ); 
                                        }
                                    ?>
                                </h3>

                                <div class="bs-sidebar">
                                    <?php get_search_form(); ?>
                                </div><!-- .bs-sidebar -->
                                <a class="readon" href="<?php echo esc_url( home_url('/') ); ?>">
                                    <?php
                                        if(!empty($khelo_option['back_home'])){
                                            echo esc_html($khelo_option['back_home']);
                                        }
                                        else{
                                            esc_html_e('OR BACK TO HOMEPAGE', 'khelo'); 
                                        }
                                    ?>
                                </a>
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->    
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div>   
    </div> <!-- .page-error -->
<?php
wp_footer(); ?>