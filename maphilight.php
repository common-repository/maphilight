<?php
/*
Plugin Name: MapHilight
Plugin URI: http://wordpress.org/extend/plugins/maphilight/
Description: MapHilight makes it easy to integrate the javascript needed to make your maps or images interactive.

Version: 0.2
Requires at least: 3.3
Tested up to: 3.4.2

Author: Xavier Roussel
Author URI: http://www.xavrsl.fr

Text Domain: maphilight
Domain Path: /languages/

License: GPLv2
*/

if(function_exists('spl_autoload_register')):

	function map_hilight_autoload($name) {
		$name = str_replace('\\', DIRECTORY_SEPARATOR, $name);

		$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $name . '.php';

		if(is_file($file)) {
			require_once $file;
		}
	}

	spl_autoload_register('map_hilight_autoload');

	Map_Hilight::bootstrap(__FILE__);

endif;
