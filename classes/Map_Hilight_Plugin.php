<?php
/**
 * Title: Map Hilight
 * Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive
 * @author Xavier Roussel
 * @version 0.2
 */
class Map_Hilight_Plugin {
	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		$plugin = plugin_basename(Map_Hilight::$file);

		add_filter('plugin_action_links_' . $plugin, array(__CLASS__, 'actionLinks'));
		
		register_uninstall_hook(Map_Hilight::$file, 'uninstall');
	}

	//////////////////////////////////////////////////

	/**
	 * Render the option page
	 */
	public static function actionLinks($links) {
		$url = admin_url('options-general.php?page=' . Map_Hilight::SLUG);

		$link = '<a href="' . $url . '">' . __('Settings') . '</a>';

		array_unshift($links, $link);

		return $links;
	}

	//////////////////////////////////////////////////

	/**
	 * Uninstall
	 */
	public static function uninstall() {
		//global $wpdb;

		// // Delete meta
		// $metaKeys = "'" . implode("', '", array(
		// 	Pronamic_Google_Maps_Post::META_KEY_ACTIVE ,
		// 	Pronamic_Google_Maps_Post::META_KEY_ADDRESS , 
		// 	Pronamic_Google_Maps_Post::META_KEY_DESCRIPTION , 
		// 	Pronamic_Google_Maps_Post::META_KEY_GEOCODE_STATUS ,
		// 	Pronamic_Google_Maps_Post::META_KEY_LATITUDE , 
		// 	Pronamic_Google_Maps_Post::META_KEY_LONGITUDE , 
		// 	Pronamic_Google_Maps_Post::META_KEY_MAP_TYPE , 
		// 	Pronamic_Google_Maps_Post::META_KEY_TITLE , 
		// 	Pronamic_Google_Maps_Post::META_KEY_ZOOM 
		// )) . "'";

		// $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ($metaKeys)");

		// Delete options
		delete_option(Map_Hilight::OPTION_NAME);
	}
}
