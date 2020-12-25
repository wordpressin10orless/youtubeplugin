<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    TheTagMixer
 * @subpackage TheTagMixer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    TheTagMixer
 * @subpackage TheTagMixer/admin
 * @author     Your Name <email@example.com>
 */
class TheTagMixer_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $thetagmixer    The ID of this plugin.
	 */
	private $thetagmixer;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $thetagmixer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $thetagmixer, $version ) {

		$this->thetagmixer = $thetagmixer;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TheTagMixer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TheTagMixer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->thetagmixer, plugin_dir_url( __FILE__ ) . 'css/thetagmixer-admin.css', array(), $this->version, 'all' );
        
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in TheTagMixer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The TheTagMixer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->thetagmixer, plugin_dir_url( __FILE__ ) . 'js/thetagmixer-admin.js', array( 'jquery' ), $this->version, false );
        
	}


	/**
	 * Register the menu and sub menu items for the admin area
	 *
	 * @since    1.0.0
	 */
	public function my_admin_menu() {

add_menu_page( 'The Tag Mixer', 'Tag Mixer Settings', 'manage_options', 'thetagmixer/thetagmixersettings.php', array( $this , 'thetagmixgensetpage') , 'dashicons-laptop', 5000  );

add_submenu_page( 'thetagmixer/thetagmixersettings.php', 'Tag Mixer Packages', 'Tag Mixer Packages', 'manage_options', 'thetagmixer/tagmixerpackages.php', array( $this , 'tagmixerpackagespage' ));

}

public function thetagmixgensetpage(){
//return views
require_once 'partials/thetagmixgensetpage.php';
}

public function tagmixerpackagespage(){
//return views
require_once 'partials/tagmixerpackagespage.php';
}



}