<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header(); ?>

<div id="rs-blog" class="rs-blog blog-page">
   <?php
    //checking blog layout form option  
    $col='';
    $blog_layout=''; 
    $column=''; 
    $blog_grid='';

    if(!empty($khelo_option['blog-layout']) || !is_active_sidebar( 'sidebar-1' ))
      {

        $blog_layout = !empty($khelo_option['blog-layout']) ? $khelo_option['blog-layout'] : '';
        $blog_grid   = !empty($khelo_option['blog-grid']) ? $khelo_option['blog-grid'] : '';
        $blog_grid   = !empty($blog_grid) ? $blog_grid : '12';
        if($blog_layout == 'full' || !is_active_sidebar( 'sidebar-1' ))
            {
                $layout ='full-layout';
                $col = '-full';
                $column = 'sidebar-none';  
            } 
          
        elseif($blog_layout == '2left')
            {
                $layout = 'full-layout-left';  
            }
    
            elseif($blog_layout == '2right')
            {
                $layout = 'full-layout-right'; 
            } 
            else{
            $col = '';
            $blog_layout = ''; 
            }
        }
        else{
            $col='';
            $blog_layout=''; 
            $layout='';
            $blog_grid='12';
        }
    ?>
    <div class="container">
        <div id="content">
            <div class="row padding-<?php echo esc_attr( $layout) ?>">       
                <div class="col-md-12 col-lg-9<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>"> 
                   
                    <div class="row">            
                        <?php
                        if ( have_posts() ) :           
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                            $post_id = get_the_id();
                        ?>
                        
                        <?php 
                             $no_thumb = "";
                             $no_redux = "";
                            if ( !has_post_thumbnail() ) {
                              $no_thumb = "no-thumbs";
                            }
                            if(!class_exists( 'ReduxFrameworkPlugin' )){
                              $no_redux = "default-meta";
                            }
                        ?>
                        <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
                            <article <?php post_class();?>>
                                <div class="blog-item <?php echo esc_attr($no_thumb); ?> <?php echo esc_attr($no_redux); ?>">
                                    <div class="blog-img">
                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <a href="<?php the_permalink();?>">
                                             <?php
                                               the_post_thumbnail();
                                             ?>
                                        <?php } ?>
                                      </a>
                                      <div class="blog-img-content">

                                        <!-- Start date meta value -->
                                        <?php 
                                             if(!empty($khelo_option['blog-date'])):                                 
                                                  if ($khelo_option['blog-date'] == 1):
                                                       if ( has_post_thumbnail() ) { ?>
                                                            <div class="meta meta-date">
                                                                 <span class="month-day"><?php echo get_the_date( 'd' ); ?></span>
                                                                 <span class="month-name"><?php echo get_the_date( 'M' ); ?></span>
                                                            </div>
                                                       <?php }else{ ?>
                                                            <div class="default-date meta">
                                                                <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                                            </div>
                                                       <?php }
                                                  endif;
                                             else:
                                                  if(!class_exists( 'ReduxFrameworkPlugin' )){ ?>
                                                       <div class="default-date meta">
                                                          <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                                        </div>
                                                  <?php } 
                                             endif; 
                                        ?>
                                        <!-- End date meta value -->

                                        <!-- Start author meta value -->
                                        <?php if(!empty($khelo_option['blog-author-post'])){
                                           if ($khelo_option['blog-author-post'] == 'show'): ?>
                                              <div class="author meta">
                                                <i class="glyph-icon flaticon-user-1"></i> <?php echo get_the_author(); ?>
                                              </div>
                                            <?php endif; }
                                            else{ ?>
                                              <div class="author meta">
                                                <i class="glyph-icon flaticon-user-1"></i> <?php echo get_the_author(); ?>
                                              </div>
                                          <?php }; ?>
                                          <!-- End author meta value -->

                                          <!-- Start category meta value -->
                                          <?php
                                              if(!empty($khelo_option['blog-category'])){
                                                if($khelo_option['blog-category'] == 'show'){
                                                 if(get_the_category()){?>                                           
                                                  <div class="meta">
                                                      <div class="category-name">
                                                        <i class="glyph-icon flaticon-folder" aria-hidden="true"></i>
                                                        <?php the_category(', '); ?>
                                                         <?php  if(has_tag()): ?>
                                                        <?php endif;?>
                                                      </div>
                                                   </div> 
                                                <?php }
                                             }
                                            }
                                             else{
                                               if(get_the_category()){?>
                                                <div class="meta">
                                                      <div class="category-name">
                                                        <i class="glyph-icon flaticon-folder" aria-hidden="true"></i>
                                                      <?php the_category(', '); ?>
                                                      </div>
                                                 </div> 
                                                <?php 
                                              }
                                             } ?>
                                          <!-- End category meta value -->

                                      </div>
                                      
                                  </div><!-- .blog-img -->

                                  <div class="full-blog-content">
                                        <div class="title-wrap">                                                                      
                                          <h3 class="blog-title">
                                              <a href="<?php the_permalink();?>">
                                                  <?php the_title();?>
                                              </a>
                                          </h3>
                                      </div>

                                        <div class="blog-desc">   
                                          <p>
                                             <?php the_excerpt();?>
                          
                                         </p>    
                                        </div>

                                      <?php 
                                        $no_view = "";
                                        if(!empty($khelo_option['blog_readmore'])):?>
                                          <div class="blog-button <?php echo esc_attr($no_view); ?>">
                                            <a href="<?php the_permalink();?>">
                                                <?php echo esc_html($khelo_option['blog_readmore']); ?>
                                              </a>
                                          </div>
                                      <?php endif; ?>

                                      <?php if(empty($khelo_option['blog_readmore'])):?>
                                          <div class="blog-button <?php echo esc_attr($no_view); ?>">
                                            <a href="<?php the_permalink();?>"><?php esc_html_e('Continue Reading', 'khelo');?></a>
                                          </div>
                                      <?php endif; ?>
                                      <div class="clear"></div>
                                </div>
                              </div>
                            </article>
                        </div>
                        
                        <?php  
                        endwhile; 
                           wp_reset_postdata();
                        ?>
                    </div>
                    <div class="pagination-area">
                        <?php
                            the_posts_pagination();
                        ?>
                    </div>
                    <?php
                    else :
                    get_template_part( 'template-parts/content', 'none' );
                    endif; ?> 
                </div>
            <?php if( $layout != 'full-layout' ):     
               get_sidebar();    
             endif;
            ?>
          </div>
        </div>
    </div>
</div>

<?php
get_footer();