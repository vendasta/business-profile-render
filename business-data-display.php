<?php
/**
 * Plugin Name: Business Profile Data
 * Plugin URI: /wp-admin/tools.php?page=businessprofiledata
 * Description: Tool to provide utilities for displaying synchronized Business Data
 * Version:     1.0.0
 * Author:
 * Author URI:
 * License:
 * License URI:
 * Text Domain:
 * Domain Path:
 */

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define( 'BUSINESS_PROFILE_RENDER_FILE', __FILE__ );
$plugin_data = get_plugin_data( BUSINESS_PROFILE_RENDER_FILE );
define( 'BUSINESS_PROFILE_RENDER_VERSION', $plugin_data['Version'] );
define( 'BUSINESS_PROFILE_RENDER_NAME', $plugin_data['Name'] );
define( 'BUSINESS_PROFILE_RENDER_PLUGIN_FILE', plugin_basename( BUSINESS_PROFILE_RENDER_FILE ) );
define( 'BUSINESS_PROFILE_RENDER_PATH', plugin_dir_path( BUSINESS_PROFILE_RENDER_FILE ) );
define( 'BUSINESS_PROFILE_RENDER_INCLUDE_PATH', BUSINESS_PROFILE_RENDER_PATH . 'includes/' );

define( 'BUSINESS_PROFILE_RENDER_WEB_PATH', plugins_url( $plugin_data['TextDomain'] ) . '/' );
define( 'BUSINESS_PROFILE_RENDER_WEB_PATH_PUBLIC', BUSINESS_PROFILE_RENDER_WEB_PATH . 'public/' );

// Must come after constant definitions
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'class-controller.php' );

/**
 * Run the controller's registration
 * @return Controller
 */
function business_profile_render_plugin() {
	$instance = Controller::instance();
	$instance->register_hooks();
	if ( is_admin() ) {
		$instance->add_admin_tab_action();
	}

	return $instance;
}

business_profile_render_plugin();
