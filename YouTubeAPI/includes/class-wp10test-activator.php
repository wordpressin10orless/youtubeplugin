<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp10Test
 * @subpackage Wp10Test/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp10Test
 * @subpackage Wp10Test/includes
 * @author     Your Name <email@example.com>
 */
class Wp10Test_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		//create a new cronjob
		if (! wp_next_scheduled('wp10vidupdater')){
			wp_schedule_event( time(), 'daily', 'wp10vidupdater');
		}

	}

}