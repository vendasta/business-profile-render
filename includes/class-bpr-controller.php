<?php

defined( 'ABSPATH' ) || exit;
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'class-bpr-data-storage.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-bpr-company-name.php' );

/**
 * Class BPR_Controller
 *
 * Create and register necessary components
 */
class BPR_Controller {

	const ACTIVATION_OPTION_KEY = "business_profile_render_version";

	/**
	 * @var BPR_Controller the instance of this class
	 */
	private static $singleton = null;

	/**
	 * @var BPR_DataStorage provides the interface to the data storage
	 */
	private $storage = null;

	/**
	 * @var array|BPR_Field[]
	 */
	private $profile_fields;

	/**
	 * @var bool
	 */
	private $registered;

	/**
	 * BPR_Controller constructor.
	 */
	public function __construct() {
		$this->storage        = BPR_DataStorage::instance();
		$this->registered     = false;
		$this->profile_fields = array(
			new BPR_CompanyName( $this->storage ),
			// TODO: add all the other business data classes and put them here
		);
	}

	/**
	 * return the instance of this class
	 *
	 * @return BPR_Controller
	 */
	public static function instance() {
		if ( is_null( self::$singleton ) ) {
			self::$singleton = new self();
		}

		return self::$singleton;
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
