<?php
/**
 * Title: Map Hilight
 * Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive
 * @author Xavier Roussel
 * @version 0.2
 */
class Map_Hilight_Admin {
	/**
	 * Bootstrap the MapHilight admin
	 */
	public static function bootstrap() {
		// Actions and hooks
		add_action('admin_init', array(__CLASS__, 'initialize'));

		add_action('admin_menu', array(__CLASS__, 'menu'));

		add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueueScripts'));

		// Scripts
		wp_register_script( 
			'map-hilight-upload', 
			plugins_url('javascript/map-hilight-upload.js', Map_Hilight::$file), 
			array('jquery','media-upload','thickbox') 
		);
	}

	//////////////////////////////////////////////////

	/**
	 * Enqueue scripts
	 */
	public static function enqueueScripts($hook) {
		$enqueue = false;
		
		if(in_array($hook, array('toplevel_page_map-hilight'))) {
			$enqueue = true;
		}

		if($enqueue) {
			wp_enqueue_script('jquery');
			
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			
			wp_enqueue_script('media-upload');
			wp_enqueue_script('map-hilight-upload');
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Initialize the admin
	 */
	public static function initialize() {
		// Try to save the options if they are posted
		self::saveOptions();
	}

	//////////////////////////////////////////////////

	/**
	 * Admin menu
	 */
	public static function menu() {
		add_menu_page(
			$pageTitle = __('Map Hilight', 'map_hilight') ,
			$menuTitle = __('Map Hilight', 'map_hilight') ,
			$capability = 'manage_options' , 
			$menuSlug = Map_Hilight::SLUG , 
			$function = array(__CLASS__, 'pageGeneral') , 
			$iconUrl = plugins_url('images/icon-16x16.png', Map_Hilight::$file)
		);

		global $submenu;

		if(isset($submenu[Map_Hilight::SLUG])) {
			$submenu[Map_Hilight::SLUG][0][0] = __('General', 'map_hilight');
		}
	}

	/**
	 * Render general page
	 */
	public static function pageGeneral() {
		include plugin_dir_path(Map_Hilight::$file) . 'views/page-general.php';
	}

	//////////////////////////////////////////////////

	/**
	 * Save the options
	 */
	public static function saveOptions() {
		$action = filter_input(INPUT_POST, 'map_hilight_action', FILTER_SANITIZE_STRING);

		if($action == 'update' && check_admin_referer('map_hilight_update_options', Map_Hilight::NONCE_NAME)) {
			$options = Map_Hilight::getOptions();

			$map_options = filter_input(INPUT_POST, 'map_hilight_options', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
			if (isset($map_options['reset'])) {
				update_option(Map_Hilight::OPTION_NAME, array());
			} else {
				// stripslashes to avoid multiple \
				$map_options['map_area_code'] = stripslashes($_POST['map_hilight_options_textarea']);

				update_option(Map_Hilight::OPTION_NAME, $map_options);
			}
		}
	}
}
