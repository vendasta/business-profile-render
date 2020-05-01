<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-plaintext-short-code.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-plaintext-reusable-block.php' );


/**
 * Class ProfileField
 *
 * Provides the basic structure to register the settings/short codes/reusable blocks
 * Inherit from this class and override the unimplemented static methods
 */
abstract class ProfileField {

	/**
	 * @var Renderer[] - register during init
	 */
	protected $renderers;

	/**
	 * ProfileField constructor.
	 *
	 * Build the renderers and add registration actions.
	 *
	 * @param DataStorage - the storage object
	 */
	public function __construct( $storage ) {
		$value           = $storage->get( static::profile_option_name() );
		$this->renderers = $this->construct_renderers( static::profile_option_name(), static::readable_profile_option(), $value );
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * @return string the name of the datum containing relevant data
	 */
	abstract protected static function profile_option_name(): string;

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - the renderers that need to run while initializing WP in general
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		return array(
			new PlaintextShortCode( $code_name, $readable_name, $value ),
			new PlaintextReusableBlock( $code_name, $readable_name, $value )
		);
	}

	/**
	 * @return string the name of this datum as read by a person
	 */
	abstract protected static function readable_profile_option(): string;

	/**
	 * register each regular renderer
	 */
	public function register() {
		foreach ( $this->renderers as $renderer ) {
			$renderer->register();
		}
	}
}
