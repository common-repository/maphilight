<?php
/**
 * Title: Map Hilight
 * Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive
 * @author Xavier Roussel
 * @version 0.2
 */
class Map_Hilight_Site {
	/**
	 * Flag for printing the scripts or not
	 * 
	 * @deprecated
	 * @var boolean
	 */
	public static $printScripts = false;

	//////////////////////////////////////////////////

	/**
	 * Constructs and initliaze an Google Maps admin
	 */
	public static function bootstrap() {
		global $wp_version;

		// Actions and hooks
		if(version_compare($wp_version, '3.3', '<')) {
			add_action('wp_footer', array(__CLASS__, 'printScripts'));
		}

		// Scripts
		wp_register_script(
			'imagemapster' , 
			plugins_url('javascript/jquery.imagemapster.min.js', Map_Hilight::$file),
			array('jquery')
		);

		// Scripts
		wp_register_script(
			'map-hilight-app' , 
			plugins_url('javascript/app.js', Map_Hilight::$file) ,
			array('jquery', 'imagemapster')
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Require app script
	 */
	public static function requireSiteScript() {
		self::$printScripts = true;

		// As of WordPress 3.3 wp_enqueue_script() can be called mid-page (in the HTML body). 
		// This will load the script in the footer. 
		wp_enqueue_script('imagemapster');
		wp_enqueue_script('map-hilight-app');
		wp_localize_script('map-hilight-app', 'map_hilight_args', Map_Hilight::getOptions());
	}

	//////////////////////////////////////////////////
	
	/**
	 * Print scripts
	 * 
	 * @deprecated
	 */
	public static function printScripts() {
		if(self::$printScripts) {
			wp_print_scripts(array('imagemapster', 'map-hilight-app'));
		}
	}
}
