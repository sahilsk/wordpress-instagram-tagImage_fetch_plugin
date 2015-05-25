<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sahilsk.github.io
 * @since      1.0.0
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/public
 * @author     Sonu K. Meena <sonukr666@gmail.com>
 */
class Instagram_Feed_Sk_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Instagram_Feed_Sk_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instagram_Feed_Sk_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/instagram-feed-sk-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Instagram_Feed_Sk_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instagram_Feed_Sk_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'masonry', plugin_dir_url( __FILE__ ) . 'js/masonry.pkgd.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/instagram-feed-sk-public.js', array( 'jquery', 'masonry'), $this->version, true );
	}


	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'instalivit', array( $this, 'shortcode' ) );

	} // register_shortcodes()

	/**
	 * Processes shortcode
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode( $atts, $content ) {

		ob_start();

		$defaults['hashtag'] 		= 'pet';
		$defaults['user'] 	= '';
		$args	= shortcode_atts( $defaults, $atts, 'instalivit' );

		$option =  get_option( 'instagram_feed_sk_option_name' );
		$images  = $this->get_insta_images($args);
		$media_count = $option['insta_count'];
		$count = 0;

		if ( empty($images) ){
			echo 'sorry No image found';		
		} else {
				include( plugin_dir_path( __FILE__ ) . 'partials/instagram-feed-sk-public-display.php' );
		}

		//get hashtagged /userid images
		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

	public function get_insta_images($args){

		require_once plugin_dir_path( dirname(__FILE__) ) . 'includes\class-instagram-api.php';

		$result = [];
		$hashtag_arr = explode(",", $args['hashtag']);
		$user_arr = explode(",", $args['user']);

		$instasetup = get_option( 'instagram_feed_sk_option_name' );

		if (!empty($instasetup)  && !empty($hashtag_arr) ) {

			foreach ($hashtag_arr as $tag) {
				$tag = trim($tag);
				if( !empty($tag) ){
					$instagram = new Instagram_API( $tag , $user_arr[0] );
			    	$resObj = $instagram->getImages(false);
			    	if ($resObj->meta->code == '200'){
		    			array_push($result,  $resObj );
			    	}
			    }
			}
		}

		$images = [];
		foreach( $result as $imgObj){
			foreach ($imgObj->data as $media) {
				array_push($images, $media->images->standard_resolution->url );
			}
		}
		shuffle( $images);
		return $images;
	}

}
