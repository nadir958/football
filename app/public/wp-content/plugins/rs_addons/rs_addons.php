<?php
/**
* Plugin Name: Rs Addons
* Plugin URI: https://codecanyon.net/user/rs-theme
* Description: by Rs Addons plugin
* Version: 1.1.5
* Author: RS Theme
* Author URI: http://www.rstheme.com
*Text Domain: rsaddon
*Domain Path: /languages/
*/


add_action( 'init', 'rsaddon_load_textdomain' );
  
/**
 * Load plugin textdomain.
 */
function rsaddon_load_textdomain() {
  load_plugin_textdomain( 'rsaddon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You shouldnt be here' );
}

/**
* Function when plugin is activated
*
* @param void
*
*/

function check_visual_composer_plugin() {
  if ( is_plugin_active('js_composer/js_composer.php') ) {
        
      // Create multi dropdown param type
        vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
        function dropdown_multi_settings_field( $param, $value ) {
           $param_line = '';
           $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';

           if(is_array($param['value']) || is_object($param['value'])) {
           foreach ( $param['value'] as $text_val => $val ) {
               if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                            $text_val = $val;
                        }
                        $text_val = __($text_val, "js_composer");
                        $selected = '';

                        if(!is_array($value)) {
                            $param_value_arr = explode(',',$value);
                        } else {
                            $param_value_arr = $value;
                        }

                        if ($value!=='' && in_array($val, $param_value_arr)) {
                            $selected = ' selected="selected"';
                        }
                        $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
                    }
           $param_line .= '</select>';

           return  $param_line;
        } 
    }

  }
}
add_action( 'admin_init', 'check_visual_composer_plugin' );


//Including file that manages all template

//All Post type include here

$dir = plugin_dir_path( __FILE__ );
require_once $dir .'/inc/vc_addon/inc/abstruct.php';
//For team
require_once $dir .'/post-type/team/team.php';

//For club
require_once $dir .'/post-type/club/club.php';
require_once $dir .'/post-type/fixture/fixture.php';
require_once $dir .'/post-type/fixture/point-table.php';

require_once $dir .'/post-type/countdown/countdown.php';
require_once $dir .'/post-type/countdown/template.php';

//For Screenshoot
require_once $dir .'/post-type/screenshoot/client.php';
//For Client
require_once $dir .'/post-type/rsclient/rsclient.php';

//shordcode 
require_once $dir .'/inc/vc_addon/rs_result.php';
require_once $dir .'/inc/vc_addon/latest_product_slider.php';
require_once $dir .'/inc/vc_addon/rs_gallery.php';
require_once $dir .'/inc/vc_addon/rs_filter_post.php';
require_once $dir .'/inc/vc_addon/rs_gallery_slider.php';
require_once $dir .'/inc/vc_addon/rs_client.php';
require_once $dir .'/inc/vc_addon/rs_contact.php';
require_once $dir .'/inc/vc_addon/rs_heading.php';
require_once $dir .'/inc/vc_addon/rs_button.php';
require_once $dir .'/inc/vc_addon/rs_services.php';
require_once $dir .'/inc/vc_addon/rs_team.php';
require_once $dir .'/inc/vc_addon/rs_blog.php';
require_once $dir .'/inc/vc_addon/rs_posts_slider.php';
require_once $dir .'/inc/vc_addon/rs_video.php';
require_once $dir .'/inc/vc_addon/rs_point_table.php';
require_once $dir .'/inc/vc_addon/rs_breaking_news.php';
require_once $dir .'/inc/vc_addon/rs_staff.php';
require_once $dir .'/inc/vc_addon/rs_counter.php';
require_once $dir .'/inc/vc_addon/rs_banner.php';
require_once $dir .'/inc/vc_addon/top_player.php';
require_once $dir .'/inc/vc_addon/rs_countdown_slider.php';
require_once $dir .'/inc/vc_addon/rs_upcoming_match.php';
require_once $dir .'/inc/vc_addon/rs_match_fixture.php';
require_once $dir .'/inc/vc_addon/rs_recent_result.php';
require_once $dir .'/inc/vc_addon/latest_blog_grid.php';
require_once $dir .'/inc/vc_addon/rs_award.php';
require_once $dir .'/inc/vc_addon/rs_club_list.php';
?>