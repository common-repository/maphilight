<?php
/**
 * Title: Map Hilight
 * Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive
 * @author Xavier Roussel
 * @version 0.2
 */
class Map_Hilight_Shortcodes {
	/**
	 * The name of the shortcode
	 * 
	 * @var string
	 */
	const SHORTCODE_MAP = 'maphilight';

	//////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public static function bootstrap() {
		add_shortcode(self::SHORTCODE_MAP, array(__CLASS__, 'shortcodeMap'));
	}

	//////////////////////////////////////////////////

	/**
	 * Shortcode map
	 */
	public static function shortcodeMap($atts) {
		$atts['echo'] = false;

		return Map_Hilight::render($atts);
	}
}
