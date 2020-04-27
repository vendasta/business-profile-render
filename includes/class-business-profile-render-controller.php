<?php

defined( 'ABSPATH' ) || exit;
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'class-business-profile-storage.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-company-name.php' );

/**
 * Class BusinessProfileRenderController
 *
 * Create and register necessary components
 */
class BusinessProfileRenderController {

	const ACTIVATION_OPTION_KEY = "business_profile_render_version";

	/**
	 * @var BusinessProfileRenderController the instance of this class
	 */
	private static $_singleton = null;

	/**
	 * @var BusinessDataStorage provides the interface to the data storage
	 */
	private $storage = null;

	/**
	 * @var array|AbstractBusinessProfileField[]
	 */
	private $profile_fields;

	/**
	 * @var boolean
	 */
	private $registered;

	/**
	 * BusinessProfileRenderController constructor.
	 */
	public function __construct() {
		$this->storage        = BusinessDataStorage::instance();
		$this->registered     = false;
		$this->profile_fields = array(
			new CompanyName( $this->storage ),
			// TODO: add all the other business data classes and put them here
		);
	}

	/**
	 * return the instance of this class
	 *
	 * @return BusinessProfileRenderController
	 */
	public static function instance() {
		if ( is_null( self::$_singleton ) ) {
			self::$_singleton = new self();
		}

		return self::$_singleton;
	}

	/**
	 * Run on activation - save the name/version to the settings
	 */
	public function activate() {
		update_option( static::ACTIVATION_OPTION_KEY, BUSINESS_PROFILE_RENDER_VERSION );
	}

	/**
	 * register the activation and deactivation hook with WordPress
	 */
	public function register_hooks() {
		if ( ! $this->registered ) {
			register_activation_hook( BUSINESS_PROFILE_RENDER_FILE, array( $this, 'activate' ) );
			register_deactivation_hook( BUSINESS_PROFILE_RENDER_FILE, array( $this, 'deactivate' ) );
			$this->registered = true;
		}
	}

	/**
	 * Run on deactivate - remove the name/version to the settings
	 */
	public function deactivate() {
		delete_option( static::ACTIVATION_OPTION_KEY );
	}
}
