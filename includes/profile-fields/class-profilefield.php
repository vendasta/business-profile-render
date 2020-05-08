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
		$value           = $this->get_value( $storage );
		$this->renderers = $this->construct_renderers( static::profile_option_name(), static::readable_profile_option(), $value );
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * @param DataStorage - the storage object
	 *
	 * @return string|mixed - return the value from the storage class
	 */
	protected function get_value( $storage ) {
		return $storage->get( static::profile_option_name() );
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

	public function admin_instruction_html() {
		$heading           = $this->admin_html_heading();
		$field_description = $this->admin_html_description();
		$field_options     = $this->admin_html_options();

		return "
<div class='bpr-profile-field-instruction'>
	$heading
	<div class='bpr-profile-field-body'>
		$field_description
		$field_options
	</div>
</div>";
	}

	protected function admin_html_heading() {
		return "<h2 class='bpr-profile-field-heading'>" . static::readable_profile_option() . "</h2>";
	}

	protected function admin_html_description() {
		return "<p class='bpr-profile-field-description'>" . static::readable_description() . "</p>";
	}

	/**
	 * @return string the meaningful description of this datum as read by a person
	 */
	abstract protected static function readable_description(): string;

	protected function admin_html_options() {
		$usages = array();
		foreach ( $this->renderers as $renderer ) {
			array_push( $usages, $renderer->get_usage_html() );
		}
		$usage = implode( "\n", $usages );

		return "<div class='bpr-profile-field-option-container'>$usage</div>";
	}

}
