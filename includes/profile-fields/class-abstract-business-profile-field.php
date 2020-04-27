<?php


defined( 'ABSPATH' ) || exit;
require( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-plaintext-short-code-renderer.php' );


/**
 * Class AbstractBusinessProfileField
 *
 * Provides the basic structure to register the settings/short codes/reusable blocks
 * Inherit from this class and override the unimplemented static methods
 */
class AbstractBusinessProfileField {

	/**
	 * @var AbstractRenderer[] - register during init
	 */
	protected $renderers;

	/**
	 * BusinessProfileField constructor.
	 *
	 * Build the renderers and add registration actions.
	 *
	 * @param BusinessDataStorage - the storage object
	 *
	 * @throws Exception - when the abstract methods have not been overridden
	 */
	public function __construct( $storage ) {
		$profile_data_exists = $storage->business_profile_found();
		$value               = $storage->get( static::profile_option_name() );
		$this->renderers     = $this->construct_renderers( static::profile_option_name(), static::readable_profile_option(), $value, $profile_data_exists );
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * @return string the name of the datum containing relevant data
	 * @throws Exception - when unimplemented
	 */
	protected static function profile_option_name() {
		throw new Exception( "unimplemented" );
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string $value - the value to render
	 * @param boolean $profile_data_exists - true if the business profile data was set
	 *
	 * @return AbstractRenderer[] - the renderers that need to run while initializing WP in general
	 * @throws Exception
	 */
	protected function construct_renderers( $code_name, $readable_name, $value, $profile_data_exists ) {
		return array(
			new PlaintextShortCodeRenderer( $code_name, $readable_name, $value, $profile_data_exists ),
		);
	}

	/**
	 * @return string the name of this datum as read by a person
	 * @throws Exception - when unimplemented
	 */
	protected static function readable_profile_option() {
		throw new Exception( "unimplemented" );
	}

	/**
	 * register each regular renderer
	 * @throws Exception
	 */
	public function register() {
		foreach ( $this->renderers as $renderer ) {
			$renderer->register();
		}
	}
}
