<?php
/**
 * Plugin Name: Business Profile Render
 * Plugin URI:
 * Description: Tool to provide utilities for displaying synchronized Business Data
 * Version:     1.0.0
 * Author:
 * Author URI:
 * License:
 * License URI:
 * Text Domain:
 * Domain Path:
 */

defined( 'ABSPATH' ) || exit;

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$plugin_data = get_plugin_data( __FILE__ );
define( 'BUSINESS_PROFILE_RENDER_VERSION', $plugin_data['Version'] );
define( 'BUSINESS_PROFILE_RENDER_NAME', $plugin_data['Name'] );
define( 'BUSINESS_PROFILE_RENDER_NAMESPACE', 'bpr' );
define( 'BUSINESS_PROFILE_RENDER_FILE', __FILE__ );
define( 'BUSINESS_PROFILE_RENDER_PATH', plugin_dir_path( __FILE__ ) );
define( 'BUSINESS_PROFILE_RENDER_PLUGIN', plugin_basename( __FILE__ ) );

require_once 'includes/class-business-profile-render-controller.php';

function business_profile_render_plugin() {
	$instance = BusinessProfileRenderController::instance();
	$instance->register_hooks();

	return $instance;
}

business_profile_render_plugin();
