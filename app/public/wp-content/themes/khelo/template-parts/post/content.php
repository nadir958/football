<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
global $khelo_option;
?>

<?php if(has_post_thumbnail()){ ?>
<div class="bs-img">
  <?php the_post_thumbnail()?>
</div>
<?php }
 
$post_id = get_the_id();
$no_thumb = "";
$no_redux = "";
if ( !has_post_thumbnail() ) {
  $no_thumb = "no-thumbs";
}
if(!class_exists( 'ReduxFrameworkPlugin' )){
  $no_redux = "default-meta";
}
?>


<div class="single-content-full <?php echo esc_attr($no_thumb); ?> <?php echo esc_attr($no_redux); ?>">
    <div class="bs-desc">
      <?php
          the_content( sprintf(
            wp_kses(
              /* translators: %s: Name of current post. Only visible to screen readers */
              __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'khelo' ),
              array(
                'span' => array(
                  'class' => array(),
                ),
              )
            ),
            get_the_title()
          ) );

          wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'khelo' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
          ) );
        ?>


        <div class="bs-info single-page-info">
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

            <!-- Start date meta value -->
            <?php 
               if(!empty($khelo_option['blog-date'])):                                 
                    if ($khelo_option['blog-date'] == 1):
                        if ( has_post_thumbnail() ) { ?>
                            <div class="meta meta-date">
                               <span class="month-day"> <i class="glyph-icon flaticon-clock"></i> <?php echo get_the_date( 'F j, Y' ); ?></span>
                            </div>
                        <?php }else{ ?>
                            <div class="default-date meta">
                               <span class="month-day"> <i class="glyph-icon flaticon-clock"></i> <?php echo get_the_date( 'F j, Y' ); ?></span>
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


            <!-- Start Tag meta value -->
            <?php 
            if(has_tag()){ ?>
                <span class="tag-single">
                <i class="glyph-icon flaticon-price-tag"></i>
                    <?php
                        //tag add
                        $seperator = ' ,'; // blank instead of comma
                        $after = '';
                        esc_html_e( 'Tags: ', 'khelo' );
                        the_tags( '', $seperator, $after ); 
                    ?>
                </span>
            <?php } ?> 
            <!-- End Tag meta value -->
        </div>
    </div>
</div>
