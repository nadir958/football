<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function khelo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'khelo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'khelo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

   if (class_exists( 'ReduxFramework' )){
		register_sidebar( array(
			'name'          => esc_html__( 'Language Widget', 'khelo' ),
			'id'            => 'language-widget',
			'description'   => esc_html__( 'Add widgets here.', 'khelo' ),
			'before_widget' => '<li id="%1$s" class="top language-widget-sec widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'khelo' ),
			'id'            => 'sidebar_shop',
			'description'   => esc_html__( 'Sidebar Shop', 'khelo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	if (class_exists( 'ReduxFramework' )){
		register_sidebar( array(
			'name'          => esc_html__( 'Off Canvas Sidebar', 'khelo' ),
			'id'            => 'sidebarcanvas-1',
			'description'   => esc_html__( 'Add widgets here.', 'khelo' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if (class_exists( 'ReduxFramework' )){
		register_sidebar( array(
			'name'          => esc_html__( 'Single Course Sidebar', 'khelo' ),
			'id'            => 'single-course',
			'description'   => esc_html__( 'Add widgets here.', 'khelo' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	register_sidebar( array(
			'name' => esc_html__( 'Newsletter Widget Area', 'khelo' ),
			'id' => 'newsletter',
			'description' => esc_html__( 'Newsletter widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 	

    register_sidebar( array(
			'name' => esc_html__( 'Sponsor Widget Area', 'khelo' ),
			'id' => 'sponsor',
			'description' => esc_html__( 'Sponsor widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 	

	register_sidebar( array(
			'name' => esc_html__( 'Footer One Widget Area', 'khelo' ),
			'id' => 'footer1',
			'description' => esc_html__( 'Add Text widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 		 				

	 register_sidebar( array(
			'name' => esc_html__( 'Footer Two Widget Area', 'khelo' ),
			'id' => 'footer2',
			'description' => esc_html__( 'Add text box widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
	 register_sidebar( array(
			'name' => esc_html__( 'Footer Three Widget Area', 'khelo' ),
			'id' => 'footer3',
			'description' => esc_html__( 'Add text box widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer Four Widget Area', 'khelo' ),
			'id' => 'footer4',
			'description' => esc_html__( 'Add text box widgets area', 'khelo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 

			
}
add_action( 'widgets_init', 'khelo_widgets_init' );