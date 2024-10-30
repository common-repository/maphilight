<?php
/**
 * Title: Map Hilight
 * Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive
 * @author Xavier Roussel
 * @version 0.2
 */
class Map_Hilight {
	/**
	 * The slug 
	 *
	 * @var string
	 */
	const SLUG = 'map-hilight';

	//////////////////////////////////////////////////

	/**
	 * The name of the option
	 *
	 * @var string
	 */
	const OPTION_NAME = 'Map_Hilight';

	//////////////////////////////////////////////////

	/**
	 * The nonce name
	 *
	 * @var string
	 */
	const NONCE_NAME = 'Map_Hilight_Protection';

	//////////////////////////////////////////////////

	/**
	 * The plugin file
	 *
	 * @var string
	 */
	public static $file;

	//////////////////////////////////////////////////

	/**
	 * Bootstrap this plugin
	 *
	 * @param string $file
	 */
	public static function bootstrap($file) {
		self::$file = $file;

		Map_Hilight_Plugin::bootstrap();
		Map_Hilight_Shortcodes::bootstrap();

		// Actions and hooks
		add_action( 'init', array( __CLASS__, 'initialize' ) );

	}

	//////////////////////////////////////////////////

	/**
	 * Initialize the plugin
	 */
	public static function initialize() {
		$options = self::getOptions();
		if($options === false) {
			self::setDefaultOptions();
		}

		// Load plugin text domain
		$relPath = dirname(plugin_basename(self::$file)) . '/languages';

		// .po / .mo files same as slug
		load_plugin_textdomain('map-hilight', false, $relPath);

		// Other
		if(is_admin()) {
			Map_Hilight_Admin::bootstrap();
		} else {
			Map_Hilight_Site::bootstrap();
		}
	}

	//////////////////////////////////////////////////

	/**
	 * Get the options for this plugin
	 *
	 * @return array
	 */
	public static function getOptions() {
		return get_option(self::OPTION_NAME);
	}

	/**
	 * Set the default options
	 *
	 * @return array the default options
	 */
	public static function setDefaultOptions() {
		// Use underscores to be javascript compatible
		$options = array(
			'map_url' => '' ,
			'map_area_code' => '' ,
			'border_color' => '' ,
			'background_color' => '',
			'background_opacity' => ''
		);

		update_option(self::OPTION_NAME, $options);

		return $options;
	}

	//////////////////////////////////////////////////

	/**
	 * Render the image, the map and areas
	 *
	 * @param mixed $arguments
	 */
	public static function render($arguments = array()) {

		$options = Map_Hilight::getOptions();
		// What left to do :
		// echo img tag with corresponding src, usemap, name
		// echo map tag with corresponding name
		// echo the given areas (stripslashes as wordpress \ when saving)
		$html = '<img src="'.$options['map_url'].'" usemap="#map-area" id="map" />';
		$html .= '<map name="map-area">';
		$html .= stripslashes($options['map_area_code']);
		$html .= '</map>';

		Map_Hilight_Site::requireSiteScript();

		if($arguments['echo']) {
			echo $html;
		} else {
			return $html;
		}
	}
}
