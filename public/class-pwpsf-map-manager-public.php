<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    pwpsf_map_manager
 * @subpackage pwpsf_map_manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    pwpsf_map_manager
 * @subpackage pwpsf_map_manager/public
 * @author     Juan Carlos Quevedo Lussón <juankql@gmail.com>
 */
class pwpsf_map_manager_Public {

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
	 * @param      string    $pwpsf_map_manager       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $pwpsf_map_manager, $version ) {

		$this->pwpsf_map_manager = $pwpsf_map_manager;
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
		 * defined in cupids_events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The cupids_events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->pwpsf_map_manager, plugin_dir_url( __FILE__ ) . 'css/pwpsf-map-manager-public.css',array(),$this->version, 'all' );
		wp_enqueue_style( $this->pwpsf_map_manager.'-fa531', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css', array(), '5.3.1', 'all' );
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
		 * defined in cupids_events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The cupids_events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	     $API_KEY = get_option('google_maps_api_key');
		//wp_enqueue_script( $this->pwpsf_map_manager.'-twbs413', plugin_dir_url( __FILE__ ) . 'bootstrap-4.1.3-dist/js/bootstrap.min.js', array(), '4.1.3', false );
		wp_enqueue_script( 'google-maps-native', "https://maps.googleapis.com/maps/api/js?key=".$API_KEY, array(), $this->version, true);  
		wp_enqueue_script( $this->pwpsf_map_manager, plugin_dir_url( __FILE__ ) . 'js/pwpsf-map-manager-public.js', array( 'jquery', 'google-maps-native' ), $this->version, true );
		
		$default_color = ( get_option( 'default_pin_color' ) !== '' ) ? get_option( 'default_pin_color' ) : '#FFFFFF'; 
		
		$helper = array(
	    	'ajax_url'   => admin_url('admin-ajax.php'),
    		'pin_color' => $default_color,
    		'pin_location' => plugins_url( '../assets/map_pin.png', __FILE__ )
		);
		wp_localize_script($this->pwpsf_map_manager,'helper',$helper);

	}

	/**
	 *  Add the shortcode for front-end display
	 *
	 * @since	1.0.0
	 */
	public function shortcodes(){
		
		function pluging_shortcode_callback(){
			$project_sectors = $terms = get_terms( array( 'taxonomy' => 'project_sectors', 'hide_empty' => false, ) );
			$project_types = $terms = get_terms( array( 'taxonomy' => 'project_types', 'hide_empty' => false, ) );
        ?>

        <div class="map_row">
            <div class="row clearfix d-flex justify-content-center">

                <div class="filter_dropdown column col-xs-12 col-sm-4 col-lg-4 col-md-4 col-sm-offset-2 col-lg-offset-2 col-md-offset-2">
                    <select id="project-sector" class="event-filter">
                        <option value="0">SECTOR</option>
                        <?php
	                        foreach ($project_sectors as $sector){
	                            echo '<option value="'.$sector->term_id.'">'.$sector->name.'</option>';
	                        }
                        ?>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>

                <div class="filter_dropdown column col-xs-12 col-sm-4 col-lg-4 col-md-4 ">
                    <select id="project-type" class="event-filter">
                        <option value="0">TYPE</option>
                        <?php
	                        foreach ($project_types as $type){
	                            echo '<option value="'.$type->term_id.'">'.$type->name.'</option>';
	                        }
                        ?>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div id="pwpsf_map_manager_public" class="maparea column col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	
                </div>

            </div>
            
            
        </div>

		<?php 

		} 

		add_shortcode('psf_map', 'pluging_shortcode_callback');

	}
	
	public function wp_ajax_get_project_locations () {
		$sector_to_filter = sanitize_text_field( $_POST['sector'] ) ;  
        $type_to_filter = sanitize_text_field( $_POST['type']) ;
        
        
        $tax_query = array( 'relation' => 'AND');
        if($type_to_filter !== '0') {
       		$tax_query[]= array(
            	'taxonomy' => 'project_types',
            	'field'    => 'term_id',
            	'terms'    => $type_to_filter,
        	);	
        }
        
        if( $sector_to_filter !== '0') {
       		$tax_query[]= array(
            	'taxonomy' => 'project_sectors',
            	'field'    => 'term_id',
            	'terms'    => $sector_to_filter,
        	);	  	
        }
        // WP_Query arguments
		$args = array (
			'post_type'         => array( 'financial_project' ),
			'post_status'       => array( 'Publish' ),
			'posts_per_page'    => -1 ,
			'tax_query'  		=> $tax_query 
		);
        
		$financial_projects = get_posts( $args );

		foreach ($financial_projects as $project) {
			$project->color_pin = get_post_meta( $project->ID, 'pin_color', true );
			$project->lat = get_post_meta( $project->ID, 'lat', true );
			$project->lng = get_post_meta( $project->ID, 'lng', true );
			$project->address = get_post_meta( $project->ID, 'address', true ); 
			$sectors = wp_get_post_terms( $project->ID, 'project_sectors', array("fields" => "all") );
			$types = wp_get_post_terms( $project->ID, 'project_types', array("fields" => "all") );    
			$project_sector = "";
			$qty = 0;
			foreach( $sectors as $sector ) {
				$project_sector.= $sector->name;
				$qty++;
				if( $qty !== count( $sectors ) ) {
					$project_sector.=", ";	
				}	
			} 
			
			$project_type = "";
			$qty = 0;
			foreach( $types as $type ) {
				$project_type.= $type->name;
				$qty++;
				if( $qty !== count( $types ) ) {
					$project_type.=", ";	
				}	
			}
			 
			$project->sector = $project_sector;   
			$project->type = $project_type;       	
		}
		
		header('Content-Type: application/json');
		$response['locations'] = $financial_projects;   
		echo json_encode( $response );
		wp_die();
        
	}

}
