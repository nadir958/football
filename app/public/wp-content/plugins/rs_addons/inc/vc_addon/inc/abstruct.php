<?php
/**
 * @author  RSTheme
 * @since   1.0
 * @version 1.0
 */
 if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
}
if ( !class_exists( 'RSTheme_VC_Modules' ) ) {

	abstract class RSTheme_VC_Modules {

		public $name;
		public $base;
		public $translate;

		public function __construct() {
			add_action( 'init', array( $this, 'vc_map' ) );
			add_shortcode( $this->base, array( $this, 'shortcode' ) );
		}

		abstract public function fields();
		abstract public function shortcode( $atts, $content );

		public function template( $template, $vars ) {
			extract( $vars );

			$template_name = "/vc-custom-addons/{$template}.php";
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = plugin_dir_path( __DIR__ ). "views/{$template}.php";
			}
			ob_start();
			include $file;
			return ob_get_clean();
		}
		



		public function vc_map() {
			$fields = $this->fields();
			vc_map( 
				array(
					"name"     => $this->name,
					"base"     => $this->base,
					"class"    => "",
					'icon'     => get_template_directory_uri().'/framework/assets/img/vc-icon.png',
					"controls" => "full",
					"category" => __( 'by RS Theme', 'rs-option'),
					"params"   => $fields,
				)
			);
		}
	}	
	
}
