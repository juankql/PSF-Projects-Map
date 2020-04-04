<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    pwpsf-map-manager
 * @subpackage pwpsf-map-manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    pwpsf_map_manager
 * @subpackage pwpsf_map_manager/admin
 * @author     Juan Carlos Quevedo Lussón <juankql@gmail.com>
 */
class pwpsf_map_manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $pwpsf_map_manager    The ID of this plugin.
	 */
	private $pwpsf_map_manager;

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
	 * @param      string    $pwpsf_map_manager       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $pwpsf_map_manager, $version ) {

		$this->pwpsf_map_manager = $pwpsf_map_manager;
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
		 * defined in cupids_events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The cupids_events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->pwpsf_map_manager, plugin_dir_url( __FILE__ ) . 'css/pwpsf-map-manager-admin.css', array(), $this->version, 'all' );

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
		 * defined in cupids_events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The cupids_events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		

	}

	/**
	 * Register custom post type in admin area
	 *
	 * @since	1.0.0
	 */
	public function custom_post_type() {

		$labels = array(
			'name'                  => _x( 'Projects', 'Post type general name', 'textdomain' ),
			'singular_name'         => _x( 'Project', 'Post type singular name', 'textdomain' ),
			'menu_name'             => _x( 'Financial Projects', 'Admin Menu text', 'textdomain' ),
			'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'textdomain' ),
			'add_new'               => __( 'Add New', 'textdomain' ),
			'add_new_item'          => __( 'Add New Project', 'textdomain' ),
			'new_item'              => __( 'New Project', 'textdomain' ),
			'edit_item'             => __( 'Edit Project', 'textdomain' ),
			'view_item'             => __( 'View Project', 'textdomain' ),
			'all_items'             => __( 'All Projects', 'textdomain' ),
			'search_items'          => __( 'Search Projects', 'textdomain' ),
			'parent_item_colon'     => __( 'Parent Projects:', 'textdomain' ),
			'not_found'             => __( 'No Projects found.', 'textdomain' ),
			'not_found_in_trash'    => __( 'No Projects found in Trash.', 'textdomain' ),
			'featured_image'        => _x( 'Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'archives'              => _x( 'Projects archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
			'filter_items_list'     => _x( 'Filter Projects list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
			'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
			'items_list'            => _x( 'Projects list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'financial_project' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'menu_icon'			=> 'dashicons-location-alt',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'tag' ),
		);

		register_post_type( 'financial_project', $args );
	}

	public function pwpsf_map_manager_categories(){

        $type_labels = array(
            'name'              => _x( 'Financial Projects Type', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Types', 'textdomain' ),
            'all_items'         => __( 'All Types', 'textdomain' ),
            'parent_item'       => __( 'Parent Type', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Type:', 'textdomain' ),
            'edit_item'         => __( 'Edit Types', 'textdomain' ),
            'update_item'       => __( 'Update Types', 'textdomain' ),
            'add_new_item'      => __( 'Add New Type', 'textdomain' ),
            'new_item_name'     => __( 'New Project Type', 'textdomain' ),
            'menu_name'         => __( 'Project Type', 'textdomain' ),
        );

        $type_args = array(
            'hierarchical'      => true,
            'labels'            => $type_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'project_types' ),
        );

        $sector_labels = array(
            'name'              => _x( 'Financial Projects Sector', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Sector', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Sectors', 'textdomain' ),
            'all_items'         => __( 'All Sectors', 'textdomain' ),
            'parent_item'       => __( 'Parent Sector', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Sector:', 'textdomain' ),
            'edit_item'         => __( 'Edit Sectors', 'textdomain' ),
            'update_item'       => __( 'Update Sectors', 'textdomain' ),
            'add_new_item'      => __( 'Add New Sector', 'textdomain' ),
            'new_item_name'     => __( 'New Project Sector', 'textdomain' ),
            'menu_name'         => __( 'Project Sector', 'textdomain' ),
        );

        $sector_args = array(
            'hierarchical'      => true,
            'labels'            => $sector_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'project_sectors' ),
        );
        register_taxonomy( 'project_types', array( 'financial_project' ), $type_args );
        register_taxonomy( 'project_sectors', array( 'financial_project' ), $sector_args );
        
        $this->add_project_types_terms();
        $this->add_project_sector_terms();
    }
	
    public function add_embed_gmaps_meta_box() {
	    add_meta_box(
	        'gmaps_embed_meta_box', // $id
	        esc_html__( 'Select Project Location', 'pwpsf-map-manager' ), // $title
	        array( $this, 'show_embed_gmaps_meta_box'), // $callback
	        'financial_project', // $page
	        'normal', // $context
	        'high'); // $priority
	    
	    //add_meta_box( 'header-page-metabox-options', 
	    //	esc_html__('Pin Color', 'pwpsf-map-manager' ), 
	    //	 array( $this, 'show_color_meta_box'), 
	    //	'financial_project', 
	    //	'normal', 
	    //	'high'); */
	}

	public function show_embed_gmaps_meta_box() {
	    global $post;  
		$lat = get_post_meta($post->ID, 'lat', true);  
		$lng = get_post_meta($post->ID, 'lng', true);
		$address = get_post_meta($post->ID, 'address', true);  
		$nonce = wp_create_nonce(basename(__FILE__));
		?>
		<div>
			<input type="text" name="address" id="address" class="address"  placeholder="Please enter the address" value="<?php echo $address; ?>">
			<input type="button" name="geocoder" id="geocoder" title="Check" class="geocoder" value="Check address">
		</div>
		<div class="maparea" id="map-canvas"></div>
		<input type="hidden" name="glat" id="latitude" value="<?php echo $lat; ?>">
		<input type="hidden" name="glng" id="longitude" value="<?php echo $lng; ?>">
		<input type="hidden" name="custom_meta_box_nonce" value="<?php echo $nonce; ?>">  
		<?php
	}
	
	public function show_color_meta_box(){
		global $post;
		$default_color = ( get_option( 'default_pin_color' ) !== '' ) ? get_option( 'default_pin_color' ) : '#FFFFFF'; 
		$pin_color = ( get_post_meta( $post->ID, 'pin_color', true ) !== '' ) ? get_post_meta( $post->ID, 'pin_color', true ) : $default_color ;     
		?>
		<script>
			jQuery(function($){
				$('.color_field').each(function(){
        			$(this).wpColorPicker();
    			});
			});
		</script>
		<div class="pagebox">
			<p><?php esc_attr_e('Choosse a color for your project location pin.', 'pwpsf-map-manager' ); ?></p>
			<input class="color_field" type="hidden" name="pin_color" value="<?php esc_attr_e($pin_color); ?>"/>
		</div>
		<?php
	}
	
	public function custom_js_css() {
		global $post;
		
		
		if( ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'financial_project' ) || ( $post->post_type === 'financial_project' ) ) {
			$API_KEY = get_option('google_maps_api_key');
			wp_enqueue_script( 'google-maps-native', "https://maps.googleapis.com/maps/api/js?key=".$API_KEY, $this->version, false);
		    wp_enqueue_style( 'gmaps-meta-box', plugin_dir_url( __FILE__ ) . 'css/pwpsf-map-manager-admin.css');
		    wp_enqueue_script( 'gmaps-meta-box', plugin_dir_url( __FILE__ ) . 'js/pwpsf-map-manager-admin.js', array( 'google-maps-native','jquery' ), $this->version, false );
		    
		    wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker');
		    
		    $default_color = ( get_option( 'default_pin_color' ) !== '' ) ? get_option( 'default_pin_color' ) : '#FFFFFF'; 
			$pin_color = ( get_post_meta( $post->ID, 'pin_color', true ) !== '' ) ? get_post_meta( $post->ID, 'pin_color', true ) : $default_color ; 
			
		    $helper = array(
    			'lat' => get_post_meta($post->ID,'lat',true),
    			'lng' => get_post_meta($post->ID,'lng',true),
    			'pin_color' => $pin_color,
    			'pin_location' => plugins_url( '../assets/map_pin.png', __FILE__ )
		    );
		    wp_localize_script('gmaps-meta-box','helper',$helper);
		}
	}

	public function save_embed_gmap($post_id) {   
	    // check autosave
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	        return $post_id;
	    // verify nonce
	    if(isset($_POST['custom_meta_box_nonce'])){
		    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
		        return $post_id;
		} else {
			return $post_id;
		}    
	    // check permissions
	    if ('financial_project' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id))
	            return $post_id;
	        } elseif (!current_user_can('edit_post', $post_id)) {
	            return $post_id;
	    }  
	    
	    $oldlat = get_post_meta($post_id, "lat", true);
	    
	    $newlat = $_POST["glat"]; 
	    if ($newlat != $oldlat) {
	        update_post_meta($post_id, "lat", $newlat);
	    } 
	    $oldlng = get_post_meta($post_id, "lng", true);
	    
	    $newlng = $_POST["glng"]; 
	    if ($newlng != $oldlng) {
	        update_post_meta($post_id, "lng", $newlng);
	    } 
	    
	    if ( !isset( $_POST['pin_color'] )) {
			return;
		}
		
		$pin_color = (isset($_POST["pin_color"]) && $_POST["pin_color"]!='') ? $_POST["pin_color"] : '';
		$old_pin_color = get_post_meta($post_id, "pin_color", true);
		if ($pin_color != $old_pin_color) {       
			update_post_meta($post_id, "pin_color", $pin_color);
		}
		
		 if ( !isset( $_POST['address'] )) {
			return;
		}
		
		$address = (isset($_POST["address"]) && $_POST["address"]!='') ? $_POST["address"] : '';
		$old_address = get_post_meta($post_id, "address", true);
		if ($address != $old_address) {       
			update_post_meta($post_id, "address", $address);
		}
	}

    public function add_project_types_terms() {
    	/*Terms array */
    	$types = array('Built to Suit', 'Redevelopment', 'Ground Lease', 'Sale Leaseback', 'Ground Up');
    	
    	foreach($types as $type) {
    		wp_insert_term( $type, 'project_types', $args = array() );     	
    	}
    	
    }
    
    public function add_project_sector_terms() {
    	/*Terms array */
    	$sectors = array('Auto', 'Retail', 'QSR', 'Financial', 'Industrial', 'Mixed Use', 'Medical', 'Hotel');
    	
    	foreach($sectors as $sector) {
    		wp_insert_term( $sector, 'project_sectors', $args = array() );     	
    	}
    	
    }
    
    public function ft_view_menu() {
		add_options_page( 'PSF Map Manager Plugin Configuration', 'PSF Map Manager Plugin', 'manage_options', 'pwpsf_map_manager-settings', array($this,'ft_admin_view_settings'));
	}

	/**
	* Register the settings for the plugin
	*/
	public function ft_register_settings() {
		register_setting( 'pwpsf_map_manager-settings', 'google_maps_api_key');
		register_setting( 'pwpsf_map_manager-settings', 'default_pin_color');  
	}
	
	/**
	*  Displays the settings page for the plugin if the logged user has enough privileges
	*/
	public function ft_admin_view_settings(){
		// Checking if the user has privileges for managing options else show a warning.
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		global $wpdb; 
		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
		include('admin_view_settings.php');
		
	}
    
}
