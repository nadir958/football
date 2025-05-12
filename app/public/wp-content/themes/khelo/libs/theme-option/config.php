<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "khelo_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'khelo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Khelo Options', 'khelo' ),
        'page_title'           => esc_html__( 'Khelo Options', 'khelo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        'forced_dev_mode_off' => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        'compiler' => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        'force_output' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_html__( 'khelo Theme', 'khelo' ), $v );
    } else {
        $args['intro_text'] = esc_html__( 'khelo Theme', 'khelo' );
    }

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTSkhelo
     */
    /*
     *
     * ---> START SECTIONS
     *
     */     
   // -> START General Settings
   Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Sections', 'khelo' ),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'container_size',
                'title'    => esc_html__( 'Container Size', 'khelo' ),
                'subtitle' => esc_html__( 'Container Size example(1200px)', 'khelo' ),
                'type'     => 'text',
                'default'  => '1370px'
                
            ),
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Default Logo', 'khelo' ),
                'subtitle' => esc_html__( 'Upload your logo', 'khelo' ),
                'url'=> true
                
            ),

            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Light', 'khelo' ),
                'subtitle' => esc_html__( 'Upload your light logo', 'khelo' ),
                'url'=> true
                
            ),

            array(
                    'id'       => 'logo-height',                               
                    'title'    => esc_html__( 'Logo Height', 'khelo' ),
                    'subtitle' => esc_html__( 'Logo max height example(50px)', 'khelo' ),
                    'type'     => 'text',
                    'default'  => '65px'
                    
            ),

            array(
                'id'       => 'rswplogo_sticky',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Sticky Logo', 'khelo' ),
                'subtitle' => esc_html__( 'Upload your sticky logo', 'khelo' ),
                'url'=> true                
            ),

            array(
                'id'       => 'sticky_logo_height',                               
                'title'    => esc_html__( 'Sticky Logo Height', 'khelo' ),
                'subtitle' => esc_html__( 'Sticky Logo max height example(20px)', 'khelo' ),
                'type'     => 'text',
                'default'  => '46px'
                    
            ),

            
            array(
            'id'       => 'rs_favicon',
            'type'     => 'media',
            'title'    => esc_html__( 'Upload Favicon', 'khelo' ),
            'subtitle' => esc_html__( 'Upload your faviocn here', 'khelo' ),
            'url'=> true            
            ),
            
            array(
                'id'       => 'off_sticky',
                'type'     => 'switch', 
                'title'    => esc_html__('Sticky Menu', 'khelo'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'khelo'),
                'default'  => false,
            ),
               
             array(
                'id'       => 'off_search',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Search', 'khelo'),
                'subtitle' => esc_html__('You can show or hide search icon at menu area', 'khelo'),
                'default'  => false,
            ),
            
            array(
                'id'       => 'off_canvas',
                'type'     => 'switch', 
                'title'    => esc_html__('Show off Canvas', 'khelo'),
                'subtitle' => esc_html__('You can show or hide off canvas here', 'khelo'),
                'default'  => false,
            ), 
                
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Go to Top', 'khelo'),
                'subtitle' => esc_html__('You can show or hide here', 'khelo'),
                'default'  => false,
            ),            
        )
    ) );
    
    
    // -> START Header Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'khelo' ),
        'id'               => 'header',
        'customizer_width' => '450px',
        'icon' => 'el el-certificate',       
         
        'fields'           => array(
        array(
            'id'     => 'notice_critical',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Top Area', 'khelo')            
        ),
        
        array(
                'id'       => 'show-top',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Top Bar', 'khelo'),
                'subtitle' => esc_html__('You can select top bar show or hide', 'khelo'),
                'default'  => false,
            ), 

         array(
                    'id'       => 'welcome-text',                               
                    'title'    => esc_html__( 'Top Bar Welcome Text', 'khelo' ),
                    'subtitle' => esc_html__( 'Top Bar Welcome Text Add Here', 'khelo' ),
                    'type'     => 'text',
                    
            ),

         
      
        array(
                'id'       => 'show-social',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Social Icons at Header', 'khelo'),
                'subtitle' => esc_html__('You can select Social Icons show or hide', 'khelo'),
                'default'  => true,
            ),  
                    
          array(
            'id'     => 'notice_critical2',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Area', 'khelo')            
        ),

        array(
                'id'               => 'header-grid',
                'type'             => 'select',
                'title'            => esc_html__('Header Area Width', 'khelo'),                  
               
                //Must provide key => value pairs for select options
                'options'          => array(                                     
                
                    'container'    => esc_html__('Container', 'khelo'),
                    'full'         => esc_html__('Container Fluid', 'khelo'),
                ),

                'default'          => 'container',            
            ),

          array(
                    'id'       => 'phone-pretext',                               
                    'title'    => esc_html__( ' Phone Number Pre Text', 'khelo' ),
                    'subtitle' => esc_html__( 'Enter Phone Number Pre Text', 'khelo' ),
                    'type'     => 'text',
                    
            ),
        
         array(
                    'id'       => 'phone',                               
                    'title'    => esc_html__( ' Phone Number', 'khelo' ),
                    'subtitle' => esc_html__( 'Enter Phone Number', 'khelo' ),
                    'type'     => 'text',
                    
            ),

           array(
                    'id'       => 'email-pretext',                               
                    'title'    => esc_html__( ' E-mail Pre Text', 'khelo' ),
                    'subtitle' => esc_html__( 'Enter E-mail Pre Text', 'khelo' ),
                    'type'     => 'text',
                    
            ),
       
        array(
                    'id'       => 'top-email',                               
                    'title'    => esc_html__( 'Email Address', 'khelo' ),
                    'subtitle' => esc_html__( 'Enter Email Address', 'khelo' ),
                    'type'     => 'text',
                    'validate' => 'email',
                    'msg'      => esc_html__('Email Address Not Valid','khelo'),
                    
            ),  



            array(
                'id'       => 'login_text',                               
                'title'    => esc_html__( 'Login Button Text', 'khelo' ),
                'subtitle' => esc_html__( 'Enter Login Text Link Here', 'khelo' ),
                'type'     => 'text',   
            ), 
             
            array(
                'id'       => 'login_link',                               
                'title'    => esc_html__( 'Login Button Link', 'khelo' ),
                'subtitle' => esc_html__( 'Enter Login Button Link Here', 'khelo' ),
                'type'     => 'text',   
            ),

         array(
                    'id'       => 'location-pretext',                               
                    'title'    => esc_html__( 'Location Title', 'khelo' ),
                    'subtitle' => esc_html__( 'Pre Text', 'khelo' ),
                    'type'     => 'text',
                    
            ),
       
        array(
                    'id'       => 'top-location',                               
                    'title'    => esc_html__( 'Add Location', 'khelo' ),
                    'subtitle' => esc_html__( 'Enter Address Here', 'khelo' ),
                    'type'     => 'text',                   
                    
            ),

        array(
                    'id'       => 'opening-pretext',                               
                    'title'    => esc_html__( 'Opening Hours Title', 'khelo' ),
                    'subtitle' => esc_html__( 'Pre Text', 'khelo' ),
                    'type'     => 'text',                    
            ),  

        array(
                'id'       => 'top-opening',                               
                'title'    => esc_html__( 'Opening Hours', 'khelo' ),
                'subtitle' => esc_html__( 'Enter Opening Hours Here', 'khelo' ),
                'type'     => 'text',                          
            ),  
            
        array(
                'id'       => 'quote',                               
                'title'    => esc_html__( 'Quote Button Text', 'khelo' ),                  
                'type'     => 'text',
                
        ),  
        
        array(
                'id'       => 'quote_link',                               
                'title'    => esc_html__( 'Quote Button Link', 'khelo' ),
                'subtitle' => esc_html__( 'Enter Quote Button Link Here', 'khelo' ),
                'type'     => 'text',
                
            ),      
        )
    ) 

);  
   

Redux::setSection( $opt_name, array(
'title'            => esc_html__( 'Header Layout', 'khelo' ),
'id'               => 'header-style',
'customizer_width' => '450px',
'subsection' =>true,      
'fields'           => array(    
                    
                    array(
                            'id'       => 'header_layout',
                            'type'     => 'image_select',
                            'title'    => esc_html__('Header Layout', 'khelo'), 
                            'subtitle' => esc_html__('Select header layout. Choose between 1, 2 or 3 layout.', 'khelo'),
                            'options'  => array(
                            'style1'   => array(
                            'alt'      => 'Header Style 1', 
                            'img'      => get_template_directory_uri().'/libs/img/style_1.png'
                            
                            ),
                            'style2' => array(
                            'alt'    => 'Header Style 2', 
                            'img'    => get_template_directory_uri().'/libs/img/style_2.png'
                            ),
                            'style3' => array(
                            'alt'    => 'Header Style 3', 
                            'img'    => get_template_directory_uri().'/libs/img/style_3.png'
                            ),
                            
                            ),
                            'default' => 'style2'
                    ),                           
                    
            )
        ) 
);
                                   
//Topbar settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Toolbar area', 'khelo' ),
        'desc'   => esc_html__( 'Toolbar area Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 
                        
                array(
                    'id'        => 'toolbar_bg_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar background Color','khelo'),
                    'subtitle'  => esc_html__('Pick color', 'khelo'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ),    

                array(
                    'id'        => 'toolbar_text_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Text Color','khelo'),
                    'subtitle'  => esc_html__('Pick color', 'khelo'),    
                    'default'   => '#111111',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_link_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Color','khelo'),
                    'subtitle'  => esc_html__('Pick color', 'khelo'),    
                    'default'   => '#111111',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_link_hover_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Hover Color','khelo'),
                    'subtitle'  => esc_html__('Pick color', 'khelo'),    
                    'default'   => '#fbc02d',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'toolbar_text_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Toolbar Font Size','khelo'),
                    'subtitle'  => esc_html__('Font Size', 'khelo'),    
                    'default'   => '14px',                                            
                ), 
                
        )
    )
);
    // -> START Style Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Style', 'khelo' ),
        'id'               => 'stle',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        ));
    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Global Style', 'khelo' ),
        'desc'   => esc_html__( 'Style your theme', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 
                        
                        array(
                            'id'        => 'body_bg_color',
                            'type'      => 'color',                           
                            'title'     => esc_html__('Body Backgroud Color','khelo'),
                            'subtitle'  => esc_html__('Pick body background color', 'khelo'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'body_text_color',
                            'type'      => 'color',            
                            'title'     => esc_html__('Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick text color', 'khelo'),
                            'default'   => '#555555',
                            'validate'  => 'color',                        
                        ),     
        
                        array(
                        'id'        => 'primary_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Primary Color','khelo'),
                        'subtitle'  => esc_html__('Select Primary Color.', 'khelo'),
                        'default'   => '#fbc02d',
                        'validate'  => 'color',                        
                        ), 

                        array(
                        'id'        => 'secondary_color',
                        'type'      => 'color', 
                        'title'     => esc_html__('Secondary Color','khelo'),
                        'subtitle'  => esc_html__('Select Secondary Color.', 'khelo'),
                        'default'   => '#214790',
                        'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'link_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Link Color','khelo'),
                            'subtitle'  => esc_html__('Pick Link color', 'khelo'),
                            'default'   => '#214790',
                            'validate'  => 'color',                        
                        ),
                        
                        array(
                            'id'        => 'link_hover_text_color',
                            'type'      => 'color',                 
                            'title'     => esc_html__('Link Hover Color','khelo'),
                            'subtitle'  => esc_html__('Pick link hover color', 'khelo'),
                            'default'   => '#555',
                            'validate'  => 'color',                        
                        ),    
                       
                 ) 
            ) 
    ); 

       
    
    //Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Main Menu', 'khelo' ),
        'desc'   => esc_html__( 'Main Menu Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 
                        

                        array(
                            'id'        => 'menu_area_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Background Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#ffffff',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'transparent_menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'transparent_menu_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Hover Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#fbc02d',                        
                            'validate'  => 'color',                        
                        ),  

                        array(
                            'id'        => 'transparent_menu_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Tranparent Menu Active Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#fbc02d',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Hover Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),           
                            'default'   => '#fbc02d',                 
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Active Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),
                            'default'   => '#fbc02d',
                            'validate'  => 'color',                        
                        ),
                                               
                        array(
                            'id'        => 'drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Background Color','khelo'),
                            'subtitle'  => esc_html__('Pick bg color', 'khelo'),
                            'default'   => '#fbc02d',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'drop_text_color',
                            'type'      => 'color',                     
                            'title'     => esc_html__('Dropdown Menu Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick text color', 'khelo'),
                            'default'   => '#101010',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick text color', 'khelo'),
                            'default'   => '#214790',
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'drop_bg_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Bg Color','khelo'),
                            'subtitle'  => esc_html__('Pick Background Color', 'khelo'),
                            'default'   => '',
                            'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'drop_border_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Border Color','khelo'),
                            'subtitle'  => esc_html__('Pick Border Color', 'khelo'),
                            'default'   => '#e0b13a',
                            'validate'  => 'color',                        
                        ),       
                                
                        array(
                            'id'       => 'menu_text_trasform',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Menu Text Uppercase', 'khelo' ),
                            'on'       => esc_html__( 'Enabled', 'khelo' ),
                            'off'      => esc_html__( 'Disabled', 'khelo' ),
                            'default'  => false,
                        ), 
                        array(
                            'id'        => 'menu_item_gap',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Item Left Right Gap','khelo'),   
                            'default'   => '15px',                             
                        ), 
                        array(
                            'id'        => 'menu_item_gap2',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Item Top Bottom Gap','khelo'),   
                            'default'   => '40px',                             
                        ),
                        
                )
            )
        );
    
    //Mobile Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Mobile Menu', 'khelo' ),
        'desc'   => esc_html__( 'Mobile Menu Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 
                    array(
                        'id'        => 'mobile_menu_icon_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Menu Burger Icon Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),           
                        'default'   => '#ffffff',                 
                        'validate'  => 'color',                        
                    ),

                    array(
                        'id'        => 'mobile_menu_container_bg',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Menu Background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),           
                        'default'   => '#fafafa',                 
                        'validate'  => 'color',               
                    ),
                    
                    
                    array(
                        'id'        => 'mobile_menu_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Main Menu Text Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#101010',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    
                    array(
                        'id'        => 'mobile_menu_text_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Main Menu Text Hover Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),           
                        'default'   => '#fbc02d',                 
                        'validate'  => 'color',                        
                    ), 
                    array(
                        'id'        => 'mobile_menu_text_active_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Main Menu Text Active Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),
                        'default'   => '#fbc02d',
                        'validate'  => 'color',                        
                    ), 
                  
                 
                    array(
                        'id'        => 'mobile_drop_text_border_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Dropdown Menu item Seperate Border Color','khelo'),
                        'subtitle'  => esc_html__('Pick a color', 'khelo'),             
                        'default'   => '#f0f0f0',               
                        'validate'  => 'color',                        
                    ),              
                    
                    
            )
        )
    );

     //Sticky Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Sticky Menu', 'khelo' ),
        'desc'   => esc_html__( 'Sticky Menu Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array(                       

                        array(
                            'id'        => 'stiky_menu_area_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Sticky Menu Area Background Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#214790',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'stikcy_menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Menu Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#ffffff',                        
                            'validate'  => 'color',                        
                        ), 
                       

                        array(
                            'id'        => 'sticky_menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Menu Text Hover Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),           
                            'default'   => '#fbc02d',                 
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'stikcy_menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Active Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),
                            'default'   => '#fbc02d',
                            'validate'  => 'color',                        
                        ),
                                               
                        array(
                            'id'        => 'sticky_drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Background Color','khelo'),
                            'subtitle'  => esc_html__('Pick bg color', 'khelo'),
                            'default'   => '#fbc02d',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'stikcy_drop_text_color',
                            'type'      => 'color',                     
                            'title'     => esc_html__('Dropdown Menu Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick text color', 'khelo'),
                            'default'   => '#101010',
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'drop_bg_hover_color1',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Bg Color','khelo'),
                            'subtitle'  => esc_html__('Pick Background Color', 'khelo'),
                            'default'   => '#fbc02d',
                            'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'drop_border_color2',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Border Color','khelo'),
                            'subtitle'  => esc_html__('Pick Border Color', 'khelo'),
                            'default'   => '#e0b13a',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'sticky_drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Text Color','khelo'),
                            'subtitle'  => esc_html__('Pick text color', 'khelo'),
                            'default'   => '#214790',
                            'validate'  => 'color',                        
                        ), 

                       
                        
                )
            )
        ); 

    //Breadcrumb settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Breadcrumb Style', 'khelo' ),      
        'subsection' =>true,  
        'fields' => array( 

                    array(
                        'id'        => 'breadcrumb_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#214790',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'breadcrumb_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Text Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#ffffff',                        
                        'validate'  => 'color',                        
                    ), 
                    
                  
                    array(
                        'id'        => 'breadcrumb_gap_top',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Top Gap','khelo'),                          
                        'default'   => '260px',                        
                                            
                    ), 

                    array(
                        'id'        => 'breadcrumb_gap_bottom',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Bottom Gap','khelo'),                          
                        'default'   => '50px',                        
                                            
                    ),     
                        
                )
            )
        );

    //Button settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Button Style', 'khelo' ),
        'desc'   => esc_html__( 'Button Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 

                    array(
                        'id'        => 'btn_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Primary background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#fbc02d',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Text Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#101010',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_txt_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Hover Text Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#111111',                        
                        'validate'  => 'color',                        
                    ), 

                    array(
                        'id'        => 'btn_bg_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Button Secondary background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color', 'khelo'),    
                        'default'   => '#ea950b',                        
                        'validate'  => 'color',                        
                    ),     
                        
                )
            )
        );

    //Preloader settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Preloader Style', 'khelo' ),
        'desc'   => esc_html__( 'Preloader Style Here', 'khelo' ),        
        'subsection' =>true,  
        'fields' => array( 
                        array(
                            'id'       => 'show_preloader',
                            'type'     => 'switch', 
                            'title'    => esc_html__('Show Preloader', 'khelo'),
                            'subtitle' => esc_html__('You can show or hide preloader', 'khelo'),
                            'default'  => false,
                        ), 

                        array(
                            'id'        => 'preloader_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Preloader Background Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#214790',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'preloader_text_color',
                            'type'      => 'color',
                            'title'     => esc_html__('Preloader Color','khelo'),
                            'subtitle'  => esc_html__('Pick color', 'khelo'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'               => 'preloader_img', 
                            'url'              => true,     
                            'title'            => esc_html__( 'Preloader Image', 'khelo' ),                 
                            'type'             => 'media',                                  
                        ),       
                    )
                )
            );    
    //End Preloader settings
    
    //-> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'khelo' ),
        'id'     => 'typography',
        'desc'   => esc_html__( 'You can specify your body and heading font here','khelo'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'khelo' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'khelo' ),
                'google'   => true, 
                'font-style' =>false,           
                'default'  => array(                    
                    'font-size'   => '15px',
                    'font-family' => 'Fira Sans',
                    'font-weight' => '400',
                ),
            ),
             array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__( 'Navigation Font', 'khelo' ),
                'subtitle' => esc_html__( 'Specify the menu font properties.', 'khelo' ),
                'google'   => true,
                'font-backup' => true,                
                'all_styles'  => true,              
                'default'  => array(
                    'color'       => '#101010',                    
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '15px',                    
                    'font-weight' => 'Normal',                    
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H1', 'khelo' ),
                'font-backup' => true,                
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '700',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '45px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H2', 'khelo' ),
                'font-backup' => true,                
                'all_styles'  => true,                 
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '700',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '36px',
                    
                ),
                ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H3', 'khelo' ),             
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '500',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '25px',
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H4', 'khelo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,               
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '600',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '22px',
                    'line-height' => '28px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H5', 'khelo' ),
                //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                //'google'      => false,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '500',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '19px',
                    'line-height' => '25px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H6', 'khelo' ),
             
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'khelo' ),
                'default'     => array(
                    'color'       => '#101010',
                    'font-style'  => '500',
                    'font-family' => 'Fira Sans',
                    'google'      => true,
                    'font-size'   => '17x',
                    'line-height' => '20px'
                ),
                ),
                
                )
            )
                    
   
    );

    /*Blog Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog', 'khelo' ),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
        )
        );
        
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog Settings', 'khelo' ),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(
        
                                array(
                                    'id'               => 'blog_banner_main', 
                                    'url'              => true,     
                                    'title'            => esc_html__( 'Blog Page Banner', 'khelo' ),                 
                                    'type'             => 'media',                                  
                                ),  

                                array(
                                    'id'        => 'blog_bg_color',
                                    'type'      => 'color',                           
                                    'title'     => esc_html__('Body Backgroud Color','khelo'),
                                    'subtitle'  => esc_html__('Pick body background color', 'khelo'),
                                    'default'   => '#eff4fd',
                                    'validate'  => 'color',                        
                                ),
                                
                                array(
                                    'id'               => 'blog_title',                               
                                    'title'            => esc_html__( 'Blog  Title', 'khelo' ),
                                    'subtitle'         => esc_html__( 'Enter Blog  Title Here', 'khelo' ),
                                    'type'             => 'text',                                   
                                ),
                                
                                array(
                                    'id'               => 'blog-layout',
                                    'type'             => 'image_select',
                                    'title'            => esc_html__('Select Blog Layout', 'khelo'), 
                                    'subtitle'         => esc_html__('Select your blog layout', 'khelo'),
                                    'options'          => array(
                                    'full'             => array(
                                    'alt'              => 'Blog Style 1', 
                                    'img'              => get_template_directory_uri().'/libs/img/1c.png'                                      
                                ),
                                    '2right'           => array(
                                    'alt'              => 'Blog Style 2', 
                                    'img'              => get_template_directory_uri().'/libs/img/2cr.png'
                                ),
                                '2left'            => array(
                                'alt'              => 'Blog Style 3', 
                                'img'              => get_template_directory_uri().'/libs/img/2cl.png'
                                ),                                  
                                ),
                                'default'          => '2right'
                                ),                      
                                
                                array(
                                    'id'               => 'blog-grid',
                                    'type'             => 'select',
                                    'title'            => esc_html__('Select Blog Gird', 'khelo'),                   
                                    'desc'             => esc_html__('Select your blog gird layout', 'khelo'),
                                //Must provide key => value pairs for select options
                                'options'          => array(
                                    '12'               => esc_html__('1 Column','khelo'),                                   
                                    '6'                => esc_html__('2 Column','khelo'),                                          
                                    '4'                => esc_html__('3 Column', 'khelo'),
                                    '3'                => esc_html__('4 Column', 'khelo')
                                    ),
                                    'default'          => '12',                                  
                                ),  
                                
                                array(
                                'id'               => 'blog-author-post',
                                'type'             => 'select',
                                'title'            => esc_html__('Show Author Info ', 'khelo'),                   
                                'desc'             => esc_html__('Select author info show or hide', 'khelo'),
                                //Must provide key => value pairs for select options
                                'options'          => array(                                            
                                'show'             => esc_html__('Show', 'khelo'),
                                'hide'             => esc_html__('Hide', 'khelo')
                                ),
                                'default'          => 'show',
                                
                                ), 

                                

                                array(
                                'id'               => 'blog-category',
                                'type'             => 'select',
                                'title'            => esc_html__('Show Category', 'khelo'),                   
                               
                                //Must provide key => value pairs for select options
                                'options'          => array(                                            
                                'show'             => esc_html__('Show', 'khelo'),
                                'hide'             => esc_html__('Hide', 'khelo')
                                ),
                                'default'          => 'show',
                                
                                ), 
                                
                                array(
                                    'id'               => 'blog-date',
                                    'type'             => 'switch',
                                    'title'            => esc_html__('Show Date', 'khelo'),                   
                                    'desc'             => esc_html__('You can show/hide date at blog page', 'khelo'),
                                    
                                    'default'          => true,
                                ), 
                                array(
                                    'id'               => 'blog_readmore',                               
                                    'title'            => esc_html__( 'Blog  ReadMore Text', 'khelo' ),
                                    'subtitle'         => esc_html__( 'Enter Blog  ReadMore Here', 'khelo' ),
                                    'type'             => 'text',                                   
                                ),
                                
                            )
                        ) 
                                
                    );
    
    
    /*Single Post Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single Post', 'khelo' ),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(                            
        
                            array(
                                    'id'       => 'blog_banner', 
                                    'url'      => true,     
                                    'title'    => esc_html__( 'Blog Single page banner', 'khelo' ),                  
                                    'type'     => 'media',
                                    
                            ),  
                           
                            array(
                                    'id'       => 'blog-comments',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Comment', 'khelo'),                   
                                    'desc'     => esc_html__('Select comments show or hide', 'khelo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show'    => esc_html__('Show', 'khelo'),
                                            'hide'    => esc_html__('Hide', 'khelo')
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-author',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Ahthor Info', 'khelo'),                   
                                    'desc'     => esc_html__('Select author info show or hide', 'khelo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show'             => esc_html__('Show', 'khelo'),
                                            'hide'             => esc_html__('Hide', 'khelo')
                                        ),
                                        'default'  => 'show',
                                        
                            ),  
                            
                            array(
                                    'id'       => 'blog-post',
                                    'type'     => 'select',
                                    'title'    => esc_html__('Show Related Post', 'khelo'),                  
                                    'desc'     => esc_html__('Choose related product show or hide', 'khelo'),
                                     //Must provide key => value pairs for select options
                                    'options'  => array(                                            
                                            'show'             => esc_html__('Show', 'khelo'),
                                            'hide'             => esc_html__('Hide', 'khelo')
                                            ),
                                        'default'  => 'show',
                                        
                            ),  
                        )
                ) 
    
    
    );

    /*Club Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Club Section', 'khelo' ),
        'id'               => 'club',
        'customizer_width' => '450px',
        'icon' => 'el el-record',
        'fields'           => array(

        		array(
                    'id'       => 'show_club_tab',
                    'type'     => 'switch', 
                    'title'    => esc_html__('Enable Club Tab', 'khelo'),
                    'subtitle' => esc_html__('You can show or hide here', 'khelo'),
                    'default'  => true,
                ),  
              
                array(
                    'id'       => 'club_history_text',                               
                    'title'    => esc_html__( 'Club History Tab Title', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Club History','khelo'),
                    'required' => array(
                       array(
                           'show_club_tab',
                           'equals',
                           true,
                       ),
                   ),                   
                ), 

                array(
                    'id'       => 'players_text',                               
                    'title'    => esc_html__( 'Player Tab Title', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Players','khelo'),
                     'required' => array(
                        array(
                            'show_club_tab',
                            'equals',
                            true,
                        ),
                    ),                    
                ), 

                array(
                    'id'       => 'champion_text',                               
                    'title'    => esc_html__( 'Champion Tab Title', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Champion','khelo'),
                     'required' => array(
                        array(
                            'show_club_tab',
                            'equals',
                            true,
                        ),
                    ),                   
                ), 

                array(
                    'id'       => 'gallery_text',                               
                    'title'    => esc_html__( 'Gallery Tab Title', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Gallery','khelo'),
                     'required' => array(
                        array(
                            'show_club_tab',
                            'equals',
                            true,
                        ),
                    ),                    
                ), 

                array(
                    'id'       => 'jersey_text',                               
                    'title'    => esc_html__( 'Jersey Tab Title', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Jersey','khelo'),
                    'required' => array(
                       array(
                           'show_club_tab',
                           'equals',
                           true,
                       ),
                   ),                  
                ), 

                array(
                    'id'       => 'club_video_text',                               
                    'title'    => esc_html__( 'Club Video Heading', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Club Videos','khelo')                    
                ), 

                 array(
                    'id'       => 'club_news_text',                               
                    'title'    => esc_html__( 'Club News  Heading', 'khelo' ),               
                    'type'     => 'text',
                    'default'  => esc_html__('Club News','khelo')                    
                ),                     
             )
         ) 
    );


   /*Team Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Player Section', 'khelo' ),
        'id'               => 'team',
        'customizer_width' => '450px',
        'icon' => 'el el-user',
        'fields'           => array(
        
            array(
                'id'       => 'team_single_image', 
                'url'      => true,     
                'title'    => esc_html__( 'Player Single page banner image', 'khelo' ),                    
                'type'     => 'media',
                    
            ),  
            
            array(
                'id'       => 'team_slug',                               
                'title'    => esc_html__( 'Player Slug', 'khelo' ),
                'subtitle' => esc_html__( 'Enter Player Slug Here', 'khelo' ),
                'type'     => 'text',
                'default'  => esc_html__('players','khelo')                    
            ), 

            array(
                'id'       => 'player_profile_title',                               
                'title'    => esc_html__( 'Player Profile Title', 'khelo' ),               
                'type'     => 'text',
                'default'  => esc_html__('Player Profile','khelo')                    
            ), 

            array(
                'id'       => 'player_career_title',                               
                'title'    => esc_html__( 'Career Information Title', 'khelo' ),               
                'type'     => 'text',
                'default'  => esc_html__('Career Information','khelo')                    
            ), 

            array(
                    'id'       => 'show_team_tab',
                    'type'     => 'switch', 
                    'title'    => esc_html__('Enable Team Tab', 'khelo'),
                    'subtitle' => esc_html__('You can show or hide here', 'khelo'),
                    'default'  => true,
                ),

            array(
                'id'     => 'notice_critical2',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'success',
                'title'  => esc_html__('Player Tab Title', 'khelo'),
                'required' => array(
                    array(
                        'show_team_tab',
                        'equals',
                        true,
                    ),
                ),               
            ),


            array(
                'id'       => 'overview_text',                               
                'title'    => esc_html__( 'Overview Tab Title', 'khelo' ),               
                'type'     => 'text',
                'default'  => esc_html__('Player Overview','khelo'),
                'required' => array(
                    array(
                        'show_team_tab',
                        'equals',
                        true,
                    ),
                ),                       
            ), 

            array(
                'id'       => 'player_gallery_text',                               
                'title'    => esc_html__( 'Player Gallery Tab Title', 'khelo' ),               
                'type'     => 'text',
                'default'  => esc_html__('Player Gallery','khelo'),
                'required' => array(
                    array(
                        'show_team_tab',
                        'equals',
                        true,
                    ),
                ),                      
            ), 

            array(
                'id'       => 'player_video_text',                               
                'title'    => esc_html__( 'Player Video Tab Title', 'khelo' ),               
                'type'     => 'text',
                'default'  => esc_html__('Player Videos','khelo'),
                'required' => array(
                    array(
                        'show_team_tab',
                        'equals',
                        true,
                    ),
                ),                      
            ),                           
                     
        )
    ) 
);

    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Icons', 'khelo' ),
        'desc'   => esc_html__( 'Add your social icon here', 'khelo' ),
        'icon'   => 'el el-share',
         'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields' => array(
                    array(
                        'id'       => 'facebook',                               
                        'title'    => esc_html__( 'Facebook Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Facebook Link', 'khelo' ),
                        'type'     => 'text',                     
                    ),
                        
                     array(
                        'id'       => 'twitter',                               
                        'title'    => esc_html__( 'Twitter Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Twitter Link', 'khelo' ),
                        'type'     => 'text'
                    ),
                    
                        array(
                        'id'       => 'rss',                               
                        'title'    => esc_html__( 'Rss Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Rss Link', 'khelo' ),
                        'type'     => 'text'
                    ),
                    
                     array(
                        'id'       => 'pinterest',                               
                        'title'    => esc_html__( 'Pinterest Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Pinterest Link', 'khelo' ),
                        'type'     => 'text'
                    ),
                     array(
                        'id'       => 'linkedin',                               
                        'title'    => esc_html__( 'Linkedin Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Linkedin Link', 'khelo' ),
                        'type'     => 'text',
                        
                    ),
                     array(
                        'id'       => 'google',                               
                        'title'    => esc_html__( 'Google Plus Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Google Plus  Link', 'khelo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'instagram',                               
                        'title'    => esc_html__( 'Instagram Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Instagram Link', 'khelo' ),
                        'type'     => 'text',                       
                    ),

                     array(
                        'id'       => 'youtube',                               
                        'title'    => esc_html__( 'Youtube Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Youtube Link', 'khelo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'tumblr',                               
                        'title'    => esc_html__( 'Tumblr Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Tumblr Link', 'khelo' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'vimeo',                               
                        'title'    => esc_html__( 'Vimeo Link', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter Vimeo Link', 'khelo' ),
                        'type'     => 'text',                       
                    ),         
            ) 
        ) 
    );
    
    
   
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer Option', 'khelo' ),
    'desc'   => esc_html__( 'Footer style here', 'khelo' ),
    'icon'   => 'el el-th-large',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(


                array(
                        'id'       => 'footer_bg_image', 
                        'url'      => true,     
                        'title'    => esc_html__( 'Footer Background Image', 'khelo' ),                 
                        'type'     => 'media',                                  
                ),

                array(
                        'id'        => 'footer_bg_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Bg Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#214790',
                        'validate'  => 'color',                        
                    ),  

                 array(
                    'id'               => 'header_grid2',
                    'type'             => 'select',
                    'title'            => esc_html__('Footer Area Width', 'khelo'),                  
               
                    //Must provide key => value pairs for select options
                    'options'          => array(                                     
                    
                        'container'     => esc_html__('Container', 'khelo'),
                        'full'          => esc_html__('Container Fluid', 'khelo'),
                    ),

                    'default'          => 'container',            
                ),

                array(
                    'id'       => 'show_footer_icon',
                    'type'     => 'switch', 
                    'title'    => esc_html__('Show Footer Social Icon', 'khelo'),
                    'subtitle' => esc_html__('You can show or hide here', 'khelo'),
                    'default'  => false,
                ),  

                array(
                        'id'       => 'footer_logo',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Footer Logo', 'khelo' ),
                        'subtitle' => esc_html__( 'Upload your footer logo', 'khelo' ),                  
                    ), 

                array(
                        'id'       => 'footer_dark_logo',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Footer Dark Logo', 'khelo' ),
                        'subtitle' => esc_html__( 'Upload your footer dark logo', 'khelo' ),                  
                    ),   

                array(
                        'id'        => 'footer_text_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Font Size','khelo'),
                        'subtitle'  => esc_html__('Font Size', 'khelo'),    
                        'default'   => '14px',                                            
                    ),  

                array(
                        'id'        => 'footer_h3_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Title Font Size','khelo'),
                        'subtitle'  => esc_html__('Font Size', 'khelo'),    
                        'default'   => '18px',                                            
                    ),  

                array(
                        'id'        => 'footer_link_size',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Footer Link Font Size','khelo'),
                        'subtitle'  => esc_html__('Font Size', 'khelo'),    
                        'default'   => '14px',                                            
                    ),  

                array(
                        'id'        => 'footer_text_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Text Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#fff',
                        'validate'  => 'color',                        
                    ),  

                array(
                        'id'        => 'footer_link_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Link Hover Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#fff',
                        'validate'  => 'color',                        
                    ),   

                array(
                        'id'        => 'footer_input_bg_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Button Background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#437ff9',
                        'validate'  => 'color',                        
                    ), 

                array(
                        'id'        => 'footer_input_hover_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Button Hover Background Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#2d6ff4',
                        'validate'  => 'color',                        
                    ),

                array(
                        'id'        => 'footer_input_border_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer input Border Color','khelo'),
                        'subtitle'  => esc_html__('Pick color.', 'khelo'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',                        
                    ),  

                array(
                    'id'        => 'footer_input_text_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Button Text Color','khelo'),
                    'subtitle'  => esc_html__('Pick color.', 'khelo'),
                    'default'   => '#111',
                    'validate'  => 'color',                        
                ),                  
                       
                
                array(
                    'id'       => 'copyright',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Footer CopyRight', 'khelo' ),
                    'subtitle' => esc_html__( 'Change your footer copyright text ?', 'khelo' ),
                    'default'  => esc_html__('&copy; 2019 All Rights Reserved', 'khelo')
                ),  

                array(
                    'id'       => 'copyright_bg',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Copyright Background', 'khelo' ),
                    'subtitle' => esc_html__( 'Copyright Background Color', 'khelo' ),      
                    'default'  => '#20458a',            
                ),
                array(
                    'id'       => 'copyright_text_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Copyright Text Color', 'khelo' ),
                    'subtitle' => esc_html__( 'Copyright Text Color', 'khelo' ),      
                    'default'  => '',            
                ), 
            ) 
        ) 
    ); 


 Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Woocommerce', 'khelo' ),    
    'icon'   => 'el el-shopping-cart',    
        ) 
    ); 

    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Shop', 'khelo' ),
    'id'               => 'shop_layout',
    'customizer_width' => '450px',
    'subsection' =>'true',      
    'fields'           => array(                      
            array(
                'id'       => 'shop_banner', 
                'url'      => true,     
                'title'    => esc_html__( 'Shop page banner', 'khelo' ),                    
                'type'     => 'media',
            ), 
            array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Select Shop Layout', 'khelo'), 
                    'subtitle' => esc_html__('Select your shop layout', 'khelo'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => 'Shop Style 1', 
                            'img'   => get_template_directory_uri().'/libs/img/1c.png'                                      
                        ),
                        'right-col'      => array(
                            'alt'   => 'Shop Style 2', 
                            'img'   => get_template_directory_uri().'/libs/img/2cr.png'
                        ),
                        'left-col'      => array(
                            'alt'   => 'Shop Style 3', 
                            'img'  => get_template_directory_uri().'/libs/img/2cl.png'
                        ),                                  
                    ),
                    'default' => 'full'
                ),

                array(
                    'id'       => 'wc_num_product',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Page', 'khelo' ),
                    'default'  => '9',
                ),

                array(
                    'id'       => 'wc_num_product_per_row',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Row', 'khelo' ),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Cart Icon Show At Menu Area', 'khelo' ),
                    'on'       => esc_html__( 'Enabled', 'khelo' ),
                    'off'      => esc_html__( 'Disabled', 'khelo' ),
                    'default'  => true,
                ), 

                 array(
                'id'       => 'disable-sidebar',
                'type'     => 'switch', 
                'title'    => esc_html__('Sidebar Disable For Single Product Page', 'khelo'),                
                'default'  => true,
            ), 
               
            )
        ) 
    );


    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Newsletter', 'khelo' ),
    'desc'   => esc_html__( 'Newsletter Option Here', 'khelo' ),
    'icon'   => 'el el-website',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(

                array(
                    'id'               => 'newsletter_bg_image', 
                    'url'              => true,     
                    'title'            => esc_html__( 'Newsletter Background Image', 'khelo' ),                 
                    'type'             => 'media',                                  
                ), 

                array(
                        'id'       => 'news_title',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Title', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter title font size', 'khelo' ),            
                    ),                      
                        
        
                
                array(
                        'id'       => 'news_subtitle',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Subtitle', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter subtitle font size', 'khelo' ),             
                    ),                      
                                     
            
                                  
            ) 
        ) 
    );
    
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( '404 Error Page', 'khelo' ),
    'desc'   => esc_html__( '404 details  here', 'khelo' ),
    'icon'   => 'el el-error-alt',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(

                 array(
                        'id'               => '404_page_banner', 
                        'url'              => true,     
                        'title'            => esc_html__( '404 Page Banner', 'khelo' ),                 
                        'type'             => 'media',                                  
                    ), 

                array(
                        'id'       => 'title_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Title', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter title for 404 page', 'khelo' ), 
                        'default'  => '404',                
                    ),  
                
                array(
                        'id'       => 'text_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Text', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter text for 404 page', 'khelo' ),  
                        'default'  => esc_html__('Page Not Found','khelo')             
                    ),                      
                       
                
                array(
                        'id'       => 'back_home',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Back to Home Button Label', 'khelo' ),
                        'subtitle' => esc_html__( 'Enter label for "Back to Home" button', 'khelo' ),
                        'default'  => esc_html__('Back to Homepage', 'khelo')
                                    
                    ),                
            
                                  
            ) 
        ) 
    );

     /**********************************
            ********* Custom CSS and JS Setting ***********
            ***********************************/
            Redux::setSection( $opt_name, array(
                'title'     => esc_html__('Custom CSS', 'khelo'),
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large',
                'fields'    => array(

                    array(
                        'id'        => 'custom-css',
                        'type'      => 'ace_editor',
                        'mode'      => 'css',
                        'title'     => esc_html__('Custom CSS', 'khelo'),
                        'subtitle' => esc_html__('Add some custom CSS', 'khelo'),
                        'default'   => '',
                    ),                                                                      

                ) 
             ) 
    ); 
    


    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );
    
    //add_filter('redux/options/' . $this->args['opt_name'] . '/compiler', array( $this, 'compiler_action' ), 10, 3);

    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri()() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'khelo' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'khelo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_action( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

