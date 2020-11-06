<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp10Test
 * @subpackage Wp10Test/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp10Test
 * @subpackage Wp10Test/public
 * @author     Your Name <email@example.com>
 */
class Wp10Test_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp10test    The ID of this plugin.
	 */
	private $wp10test;

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
	 * @param      string    $wp10test       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp10test, $version ) {

		$this->wp10test = $wp10test;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp10Test_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp10Test_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wp10test, plugin_dir_url( __FILE__ ) . 'css/wp10test-public.css', array(), $this->version, 'all' );
        
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp10Test_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp10Test_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wp10test, plugin_dir_url( __FILE__ ) . 'js/wp10test-public.js', array( 'jquery' ), $this->version, false );
        
	}

    public function wp10shortyexample() {

}

//output video shortcode function
public function wp10viddisplay(){
	//output the videos
	
}


}
