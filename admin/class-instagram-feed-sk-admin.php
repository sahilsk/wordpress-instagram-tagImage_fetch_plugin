<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sahilsk.github.io
 * @since      1.0.0
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Instagram_Feed_Sk
 * @subpackage Instagram_Feed_Sk/admin
 * @author     Sonu K. Meena <sonukr666@gmail.com>
 */
class Instagram_Feed_Sk_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Instagram_Feed_Sk_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instagram_Feed_Sk_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/instagram-feed-sk-admin.css', array(), $this->version, 'all' );

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
		 * defined in Instagram_Feed_Sk_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instagram_Feed_Sk_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/instagram-feed-sk-admin.js', array( 'jquery' ), $this->version, false );

	}
    /**
     * Add options page
     */
    public function add_plugin_page()
    {

        // This page will sit under "Settings"
        add_options_page(
            'Settings Instagram Feed', 
            'Instagram Feed', 
            'manage_options', 
            'instagram_feed_sk-setting-admin', 
            array( $this, 'instagram_feed_sk_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function instagram_feed_sk_admin_page()
    {    	

		$this->options = get_option( 'instagram_feed_sk_option_name' );
		include( plugin_dir_path( __FILE__ ) . 'partials/instagram-feed-sk-admin-display.php' );
    }

   /**
     * Register and add settings
     * @TODO clean up comments
     * @TODO add a title option
     * @TODO add a css overide option,
     *   check priorty loading and css specificity 
     *   the theme might override naturally 
     */
    public function page_init()
    {        
        register_setting(
            'instagram_feed_sk_option_group', // Option group
            'instagram_feed_sk_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'API settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'instagram_feed_sk-setting-admin' // Page
        );  

        add_settings_field(
            'insta_apiKey', // ID
            'CLIENT ID', // Title 
            array( $this, 'insta_apiKey_callback' ), // Callback
            'instagram_feed_sk-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'insta_apiSecret', // ID
            'CLIENT SECRET', // Title 
            array( $this, 'insta_apiSecret_callback' ), // Callback
            'instagram_feed_sk-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'insta_apiCallback', // ID
            'WEBSITE URL', // Title 
            array( $this, 'insta_apiCallback_callback' ), // Callback
            'instagram_feed_sk-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_section(
            'instgram_setting_section_id', // ID
            'Instagram Feed Settings', // Title
            array( $this, 'print_instagram_section_info' ), // Callback
            'instagram_feed_sk-setting-admin' // Page
        );      

        add_settings_field(
            'insta_count', // ID
            'How Many Images to pull (numeric)', // Title 
            array( $this, 'insta_count_callback' ), // Callback
            'instagram_feed_sk-setting-admin', // Page
            'instgram_setting_section_id' // Section           
        );      

    }
       /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['insta_apiKey'] ) )
            $new_input['insta_apiKey'] = strip_tags( $input['insta_apiKey'] );

        if( isset( $input['insta_apiSecret'] ) )
            $new_input['insta_apiSecret'] = strip_tags( $input['insta_apiSecret'] );

        if( isset( $input['insta_apiCallback'] ) )
            $new_input['insta_apiCallback'] = esc_url_raw( $input['insta_apiCallback'] );

        if( isset( $input['insta_count'] ) )
            $new_input['insta_count'] = absint( $input['insta_count'] );


        return $new_input;
    }
 

  /** 
     * Print the Section text
     */
    public function print_instagram_section_info()
    {
        print 'Enter the Instagram Hashtag and number of images:';
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter all your Instagram Client settings here inorder to make requests to the Instagram API:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function insta_apiKey_callback()
    {
        printf(
            '<input type="text" id="insta_apiKey" name="instagram_feed_sk_option_name[insta_apiKey]" value="%s" />',
            isset( $this->options['insta_apiKey'] ) ? esc_attr( $this->options['insta_apiKey']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function insta_apiSecret_callback()
    {
        printf(
            '<input type="text" id="insta_apiSecret" name="instagram_feed_sk_option_name[insta_apiSecret]" value="%s" />',
            isset( $this->options['insta_apiSecret'] ) ? esc_attr( $this->options['insta_apiSecret']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function insta_apiCallback_callback()
    {
        printf(
            '<input type="text" id="insta_apiCallback" name="instagram_feed_sk_option_name[insta_apiCallback]" value="%s" />',
            isset( $this->options['insta_apiCallback'] ) ? esc_attr( $this->options['insta_apiCallback']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function insta_count_callback()
    {
        printf(
            '<input type="text" id="insta_count" name="instagram_feed_sk_option_name[insta_count]" value="%s" />',
            isset( $this->options['insta_count'] ) ? esc_attr( $this->options['insta_count']) : ''
        );
    }
}
