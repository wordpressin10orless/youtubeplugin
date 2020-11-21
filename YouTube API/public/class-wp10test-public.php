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
	$thepostcount = get_option( 'ypostcount' ); //gathered post count from settings

	$allWPVidPosts = get_posts( array('post_type' => 'wp10yvids', 'numberposts' => $thepostcount) );
	//loop through and delete all the posts
	echo ('<div class="grid-container">');
	foreach ($allWPVidPosts as $eachpost){
		echo ('<div class="grid-item">');
		//print_r($eachpost->videoID->videoId);
		echo ('<p style="font-size: 18px;">' . $eachpost->ytitle . '</p>');
		echo ('<a target="_blank" href="http://localhost/seolocal/watch/?vid=' . $eachpost->videoID->videoId . '&oid=' . $eachpost->ID . '"><img src="' . $eachpost->imageresmed . '" /></a>');
		echo ('</div>');
	}
	echo('</div>');
}

//display requested video in large box
public function wp10displaybox(){
	
	//set vid variable
	$thevid = '';
	$thepostid = '';

	//check for video set
	if (isset($_GET['vid'])){
		$thevid = $_GET['vid'];
		$thepostid = $_GET['oid'];
	}

	//check if the vid is equal to something
	if ($thevid == ''){
		?>
		<h1>No Video to Display</h1>
		<?php
	} else {
		//display the video in a box
		$thetitle = get_post_meta( $thepostid, 'ytitle', true );
		?>
		<h3><?php echo($thetitle); ?></h3>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo($thevid); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

		<?php
	}

}

}
