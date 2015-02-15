<?php
/*
Plugin Name: wpMandrill Multisite
Description: Automatically propagates the wpMandrill settings from the main site to all subsites, still allowing each subsite to manually override them.
Version: 1.0.0
Author: tyxla
Author URI: https://github.com/tyxla
License: GPL2
Requires at least: 3.0
Tested up to: 4.1
*/

/**
 * Main plugin class.
 */
class WP_Mandrill_Multisite {

	/**
	 * Constructor.
	 *	
	 * Initializes and hooks the plugin functionality.
	 *
	 * @access public
	 *
	 * @return WP_Mandrill_Multisite 
	 */
	public function __construct() {
		add_action('wp_loaded', array($this, 'distribute_settings'));
	}

	/**	
	 * Distribute wpMandrill's settings throughout the entire network.
	 *
	 * Called on each of the subsites, populates the wpMandrill settings 
	 * if they are not configured. This allows wpMandrill to work on the
	 * entire network without having to set it up manually on each subsite.
	 *
	 * @access public
	 */
	public function distribute_settings() {
		// bail if wpMandrill plugin is not active
		if( !class_exists('wpMandrill') ) {
			return;
		}

		// get mandrill settings from main site 
		$mainsite_mandrill_settings = get_blog_option(BLOG_ID_CURRENT_SITE, 'wpmandrill'); 
		if (!$mainsite_mandrill_settings) { 
			// we should not continue if wpMandrill is not setup in the main site 
			return; 
		}
		
		// get mandrill settings from subsite 
		$mandrill_settings = get_option('wpmandrill'); 

		// if the settings are not setup in the subsite, set them up 
		if (!$mandrill_settings) { 
			$mandrill_settings = $mainsite_mandrill_settings; 

			// use the from name and email from the subsite
			$mandrill_settings['from_name'] = get_bloginfo('name'); 
			$mandrill_settings['from_username'] = get_bloginfo('admin_email'); 

			// save wpMandrill options for the subsite
			update_option('wpmandrill', $mandrill_settings); 
		} 
	} 

}

// initialize wpMandrill Multisite
global $wp_mandrill_multisite;
$wp_mandrill_multisite = new WP_Mandrill_Multisite();