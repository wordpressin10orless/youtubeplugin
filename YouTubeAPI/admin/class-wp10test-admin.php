<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp10Test
 * @subpackage Wp10Test/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp10Test
 * @subpackage Wp10Test/admin
 * @author     Your Name <email@example.com>
 */
class Wp10Test_Admin {

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
	 * @param      string    $wp10test       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp10test, $version ) {

		$this->wp10test = $wp10test;
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
		 * defined in Wp10Test_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp10Test_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wp10test, plugin_dir_url( __FILE__ ) . 'css/wp10test-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'bootstrap.min', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

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
		 * defined in Wp10Test_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp10Test_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->wp10test, plugin_dir_url( __FILE__ ) . 'js/wp10test-admin.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'bootstrap.min', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the menu and sub menu items for the admin area
	 *
	 * @since    1.0.0
	 */
	public function my_admin_menu() {

add_menu_page( 'WP10 General Settings', 'WP10 Settings', 'manage_options', 'wp10test/wp10settingsgeneral.php', array( $this , 'wp10settingscallback') , 'dashicons-heart', 250  );

add_submenu_page( 'wp10test/wp10settingsgeneral.php', 'Sub 1', 'WP10 Importer', 'manage_options', 'wp10test/wp10importer.php', array( $this , 'wp10importercall' ));

}

public function wp10settingscallback(){
//return views
require_once 'partials/wp10settingscallback.php';
}

public function wp10importercall(){
//return views
require_once 'partials/wp10importercall.php';
}

public function wp10customfooter() {

}

	/**
	 * Register the menu and sub menu items for the admin area
	 *
	 * @since    1.0.0
	 */

	public function register_wp10_general_settings(){
		//registers all settings for general settings page
		register_setting( 'wp10customsettings', 'youtubeAPIKey' );
		register_setting( 'wp10customsettings', 'youtubeChannelID' );
	}

	public function register_wp10_shortcode_settings(){
		//register the shortcode settings
		register_setting( 'wp10shortcodesettings', 'ypostcount' );
		register_setting( 'wp10shortcodesettings', 'yvidstyletype' );
	}	


//this function creates our custom post type for videos
public function custom_youtube_api(){
		/*
		* Creating a function to create our CPT
	*/
    $labels = array(
        'name'                => _x( 'YouTube Videos', 'Post Type General Name'),
        'singular_name'       => _x( 'YouTube Video', 'Post Type Singular Name'),
        'menu_name'           => __( 'YouTube Video'),
        'parent_item_colon'   => __( 'Parent Video'),
        'all_items'           => __( 'All Videos'),
        'view_item'           => __( 'View Videos'),
        'add_new_item'        => __( 'Add New YouTube Video'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit'),
        'update_item'         => __( 'Update'),
        'search_items'        => __( 'Search'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash'),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'wp10yvids'),
        'description'         => __( 'YouTube Videos from our Channel'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => false,
        'show_in_menu'        => false,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => false,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'wp10yvids', $args );
}

}