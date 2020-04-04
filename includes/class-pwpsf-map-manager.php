<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    pwpsf_map_manager
 * @subpackage pwpsf_map_manager/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    pwpsf_map_manager
 * @subpackage pwpsf_map_manager/admin
 * @author     Juan Carlos Quevedo Lussón <juankql@gmail.com>
 */
class pwpsf_map_manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      pwpsf_map_manager_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $cupids_events    The string used to uniquely identify this plugin.
	 */
	protected $pwpsf_map_manager;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'pwpsf_map_manager_VERSION' ) ) {
			$this->version = pwpsf_map_manager_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->pwpsf_map_manager = 'pwpsf-map-manager';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - cupids_events_Loader. Orchestrates the hooks of the plugin.
	 * - cupids_events_i18n. Defines internationalization functionality.
	 * - cupids_events_Admin. Defines all hooks for the admin area.
	 * - cupids_events_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pwpsf-map-manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pwpsf-map-manager-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pwpsf-map-manager-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pwpsf-map-manager-public.php';

		/**
		 *  The class responsible for the integration with Visual Composer page builder
		 *  this will add a new elements to the builder   */ 
		 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/vc-extend.php'; 



		$this->loader = new pwpsf_map_manager_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the cupids_events_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new pwpsf_map_manager_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new pwpsf_map_manager_Admin( $this->get_pwpsf_map_manager(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin, 'custom_post_type' );
        $this->loader->add_action( 'init', $plugin_admin, 'pwpsf_map_manager_categories' );
        $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_embed_gmaps_meta_box' ); 
        $this->loader->add_action( 'save_post', $plugin_admin, 'save_embed_gmap' );
        $this->loader->add_action( 'admin_print_styles-post.php', $plugin_admin, 'custom_js_css' );
		$this->loader->add_action( 'admin_print_styles-post-new.php', $plugin_admin, 'custom_js_css' ); 
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'ft_view_menu' );  
		$this->loader->add_action( 'admin_init', $plugin_admin, 'ft_register_settings' );
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new pwpsf_map_manager_Public( $this->get_pwpsf_map_manager(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'shortcodes' );
		$this->loader->add_action( 'wp_ajax_get_project_locations', $plugin_public, 'wp_ajax_get_project_locations' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_project_locations', $plugin_public, 'wp_ajax_get_project_locations' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_pwpsf_map_manager() {
		return $this->pwpsf_map_manager; 
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    pwpsf_map_manager_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
