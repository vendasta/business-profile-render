<?php


defined( 'ABSPATH' ) || exit;
require( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-bpr-plaintext-short-code.php' );
require( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-bpr-plaintext-reusable-block.php' );


/**
 * Class BPR_Field
 *
 * Provides the basic structure to register the settings/short codes/reusable blocks
 * Inherit from this class and override the unimplemented static methods
 */
abstract class BPR_Field {

	/**
	 * @var BPR_Renderer[] - register during init
	 */
	protected $renderers;

	/**
	 * BPR_Field constructor.
	 *
	 * Build the renderers and add registration actions.
	 *
	 * @param BPR_DataStorage - the storage object
	 *
	 * @throws Exception - when the abstract methods have not been overridden
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
	 * @return BPR_Renderer[] - the renderers that need to run while initializing WP in general
	 * @throws Exception
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		return array(
			new BPR_PlaintextShortCode( $code_name, $readable_name, $value ),
			new BPR_PlaintextReusableBlock( $code_name, $readable_name, $value )
		);
	}

	/**
	 * @return string the name of this datum as read by a person
	 */
	abstract protected static function readable_profile_option(): string;

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
